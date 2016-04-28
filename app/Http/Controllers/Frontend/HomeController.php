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
        $logos = Logo::with(['category', 'keywords', 'images'])->orderBy('date', 'DESC')->paginate(12);
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
        //$category = Category::with('logos')->findOrFail($logo->category->id);
        return $relatedLogos;
    }

    public function register_customer()
    {
        if (!Session::has('logo_id'))
            return redirect()->route('index');
        return view('front.register_customer');
    }

    public function register_customer_preStore(CreateCustomerRequest $request)
    {
        $customer = ['name' => $request->get('name'), 'email' => $request->get('email'), 'phone' => $request->get('phone') ];
        Session::put('customer', $customer);

        return redirect()->route('requirement');
    }

    public function requirement_logo()
    {
        if (!Session::has('logo_id'))
            return redirect()->route('index');
        return view('front.requirement_logo');
    }

    public function requirement_logo_preStore(CreateRequirementsLogoRequest $request)
    {
        $requirements = ['company' => $request->get('company'), 'secondaryText' => $request->get('secondaryText')];
        Session::put('requirements', $requirements);

        return redirect()->route('summary');
    }

    public function summary()
    {
        if (!Session::has('logo_id'))
            return redirect()->route('index');

        $logo = Logo::with(['category', 'keywords', 'images'])->findOrFail(Session::get('logo_id'));

        return view('front.summary', compact('logo'));
    }

    public function paymentMessages()
    {

        if(Session::has('logo_id')) {
            $logo = Logo::findOrFail(Session::get('logo_id'));

            $customer = new Customer();
            if (Session::has('customer')) {
                $customer->name = Session::get('customer.name');
                $customer->email = Session::get('customer.email');
                $customer->phone = Session::get('customer.phone');
                $customer->save();
            }

            $requirements = new RequirementsLogo();
            if (Session::has('requirements')) {
                $requirements->company = Session::get('requirements.company');
                $requirements->secondaryText = Session::get('requirements.secondaryText');
                $requirements->logo_id = Session::get('logo_id');
                $requirements->save();
            }

            $order = new Order();
            if ($customer->id) {
                $order->status = 'pendiente';
                $order->logo_id = Session::get('logo_id');
                $order->customer_id = $customer->id;
                $order->save();
            }

            Mail::send('mails.payment_info', ['logo' => $logo, 'customer' => $customer, 'requirements' => $requirements, 'order' => $order], function ($m) use ($customer) {
                $m->from('logostore@app.com', 'Desde LogoStore para tí');
                $m->to('eli.magana@imaginaestudio.mx')->cc($customer->email, $customer->name)->subject('Your Reminder!');
            });
        }

        return view('front.payment_messages');
    }

}
