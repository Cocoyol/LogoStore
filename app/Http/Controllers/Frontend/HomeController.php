<?php

namespace LogoStore\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use LogoStore\Category;
use LogoStore\Customer;
use LogoStore\Http\Requests;

use LogoStore\Http\Controllers\Controller;

use LogoStore\Http\Requests\CreateCustomerRequest;
use LogoStore\Http\Requests\CreateRequirementsLogoRequest;
use LogoStore\Http\Requests\ValidateFromContactRequest;
use LogoStore\Logo;
use LogoStore\PendingOrder;
use LogoStore\RequirementsLogo;
use LogoStore\Order;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        // -- Validar Request
        $this->validate($request,[
            'type'   => 'integer|in:1,2',
            'search' => 'string',
            'pp'     => 'integer|in:12,24,36,48',
            'o'      => 'integer|in:1,2,3'
        ]);

        // -- Inicializar valores
        $data = [];
        $perPage = intval($request->exists('pp')?$request->get('pp'):'12');
        $orderBy = ['logos.status', 'ASC'];
        if($request->exists('o')) {
            switch ($request->get('o')) {
                case '2' : $orderBy = ['logos.price', 'DESC']; break;
                case '3' : $orderBy = ['logos.price', 'ASC']; break;
            }
        }

        // -- Hacer consulta
        if($request->exists('type') && $request->exists('search')) {
            if(!empty($request->get('search'))) {
                switch ($request->get('type')) {
                    case 1 :
                        $logos = $this->logosByCategory($request->get('search'), $orderBy[0], $orderBy[1], $perPage);
                        $data = ['category', $request->get('search')];
                        break;
                    case 2:
                        $logos = $this->searchLogos($request->get('search'), $orderBy[0], $orderBy[1], $perPage);
                        $data = ['search', $request->get('search')];
                }
            } else {
                $logos = Logo::orderBy($orderBy[0], $orderBy[1])->paginate($perPage);
            }
        } else {
            $logos = Logo::orderBy($orderBy[0], $orderBy[1])->paginate($perPage);
        }

        return view('front.home', compact('logos', 'data'));
    }

    public function detail($id)
    {
        $logo = Logo::with('category')->findOrFail($id);
        $relatedLogos = $this->getRelatedByCategory($logo);
        return view('front.detail', compact('logo', 'relatedLogos'));
    }

    public function getRelatedByCategory(Logo $logo)
    {
        $relatedLogos = Category::find($logo->category->id)->logos()->where('id','<>',$logo->id)->orderByRaw('RAND()')->take(4)->get();
        return $relatedLogos;
    }

    public function logosByCategory($str, $order, $by, $perPage)
    {
        $logos = Logo::where('category_id', $str)->with('images')->orderBy($order, $by)->paginate($perPage);
        return $logos;
    }

    public function searchLogos($str, $order, $by, $perPage) {
        $logos = Logo::leftJoin('keyword_logos', 'logos.id', '=', 'keyword_logos.logo_id')
            ->join('keywords', 'keyword_logos.keyword_id', '=', 'keywords.id')
            ->where('logos.name', 'LIKE', '%' . $str . '%')->orWhere(function ($query) use ($str) {
                $query->where('logos.description', 'LIKE', '%' . $str . '%')->where('logos.status', 'disponible');
            })->orWhere(function ($query) use ($str) {
                $query->where('keywords.name', 'LIKE', $str)->where('logos.status', 'disponible');
            })->orderBy($order, $by)->groupBy('logos.id')->paginate($perPage);
        return $logos;
    }

    /** Purchase **/
    public function register_customer()
    {
        if (Session::has('logo_id')) {
            $logo = Logo::findOrFail(Session::get('logo_id'));
            if($logo->status == "disponible")
                return view('front.register_customer');

        }
        return redirect()->route('index');
    }

    public function register_customer_preStore(CreateCustomerRequest $request)
    {
        $customer = ['name' => $request->get('name'), 'email' => $request->get('email'), 'phone' => $request->get('phone') ];
        Session::put('customer', $customer);

        return redirect()->route('requirement');
    }

    public function requirement_logo()
    {
        if (Session::has('logo_id') &&
            Session::has('customer')) {
            $logo = Logo::findOrFail(Session::get('logo_id'));
            if($logo->status == "disponible")
                return view('front.requirement_logo');

        }
        return redirect()->route('index');
    }

    public function requirement_logo_preStore(CreateRequirementsLogoRequest $request)
    {
        $requirements = ['company' => $request->get('company'), 'secondaryText' => $request->get('secondaryText')];
        Session::put('requirements', $requirements);

        return redirect()->route('summary');
    }

    public function summary()
    {
        if (Session::has('logo_id') &&
            Session::has('customer') &&
            Session::has('requirements')) {
            $logo = Logo::with(['category', 'keywords', 'images'])->findOrFail(Session::get('logo_id'));
            if($logo->status == "disponible")
                return view('front.summary', compact('logo'));
        }
        return redirect()->route('index');
    }

    public function paymentMessages()
    {
        if (Session::has('logo_id') &&
            Session::has('customer') &&
            Session::has('requirements') &&
            Session::has('paypal')) {
            $logo = Logo::findOrFail(Session::get('logo_id'));

            $customer = new Customer();
            $customer->name = Session::get('customer.name');
            $customer->email = Session::get('customer.email');
            $customer->phone = Session::get('customer.phone');
            $customer->save();

            $order = new Order();
            $order->status = 'pendiente';
            $order->logo_id = Session::get('logo_id');
            $order->customer_id = $customer->id;
            $order->save();

            $requirements = new RequirementsLogo();
            $requirements->company = Session::get('requirements.company');
            $requirements->secondaryText = Session::get('requirements.secondaryText');
            $requirements->order_id = $order->id;
            $requirements->save();

            Mail::send('mails.payment_info', ['logo' => $logo, 'customer' => $customer, 'requirements' => $requirements, 'order' => $order], function ($m) use ($customer) {
                $m->from('logostore@app.com', 'Desde LogoStore para tí');
                $m->to('eli.magana@imaginaestudio.mx')->cc($customer->email, $customer->name)->subject('Your Reminder!');
            });

            Session::flush();
            return view('front.payment_messages');
        }

        return redirect()->route('index');
    }


    public function messageContact(ValidateFromContactRequest $request)
    {
        $user_contact = ['name' => $request->get('name'), 'email' => $request->get('email'), 'phone' => $request->get('phone'), 'message' => $request->get('message')];

        Mail::send('mails.contact', ['user_contact' => $user_contact], function ($m) use ($user_contact) {
            $m->from('logostore@app.com', 'LogoStore');
            $m->to('eli.magana@imaginaestudio.mx')->subject('Contact from web page!');
        });

        return view('front.thankyou_contact');
    }

}
