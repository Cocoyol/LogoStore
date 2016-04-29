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
use LogoStore\Logo;
use LogoStore\PendingOrder;
use LogoStore\RequirementsLogo;
use LogoStore\Order;

class HomeController extends Controller
{
    public function index(){
        $logos = Logo::with('images')->orderBy('date', 'DESC')->paginate(12);
        return view('front.home', compact('logos'));
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

    public function logosByCategory($category_id)
    {
        $category = Category::findOrFail($category_id);
        $data = ['category', $category];
        $logos = Logo::where('category_id', $category->id)->with('images')->orderBy('date', 'DESC')->paginate(12);
        return view('front.home', compact('logos', 'data'));
    }

    public function SearchLogos(Request $request) {
        //dd($request->all());
        $str = $request->get('search');
        $logos = Logo::where(function ($query) use($str) {
                $query->where('name', 'LIKE', '%'.$str.'%')->orWhere('description', 'LIKE', '%'.$str.'%');
            })->orderBy('date', 'DESC')->paginate(12);
        $data = ['search', $request->get('search')];
        //dd($data);
        return view('front.home', compact('logos', 'data'));
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

}
