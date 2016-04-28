<?php

namespace LogoStore\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use LogoStore\Category;
use LogoStore\Http\Requests;

use LogoStore\Http\Controllers\Controller;

use LogoStore\Http\Requests\CreateCustomerRequest;
use LogoStore\Http\Requests\CreateRequirementsLogoRequest;
use LogoStore\Logo;
use LogoStore\PendingOrder;

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
        return view('front.register_customer');
    }

    public function register_customer_preStore(CreateCustomerRequest $request)
    {
        $customer = ['name' => $request->get('name'), 'email' => $request->get('email'), 'phone' => $request->get('phone') ];
        Session::put('customer', $customer);
        //dd(Session::all());
        //$pendingOrder = PendingOrder::create($request->all());

        return redirect()->route('requirement');
    }

    public function requirement_logo()
    {
        return view('front.requirement_logo');
    }

    public function requirement_logo_preStore(CreateRequirementsLogoRequest $request)
    {
        $customer = ['company' => $request->get('company'), 'secondaryText' => $request->get('secondaryText')];
        Session::put('customer', $customer);

        return redirect()->route('summary');
    }

    public function summary()
    {
        return view('front.summary');
    }

}
