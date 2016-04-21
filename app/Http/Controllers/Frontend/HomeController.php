<?php

namespace LogoStore\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use LogoStore\Http\Requests;

use LogoStore\Http\Controllers\Controller;

use LogoStore\Logo;

class HomeController extends Controller
{
    public function index(){

        $logos = Logo::with('category')->with('keywords')->orderBy('date', 'DESC')->paginate(12);
        return view('front.home', compact('logos'));

    }

    public function detail($id)
    {
        $logo = Logo::findOrFail($id);
        return view('front.detail', compact('logo'));
    }

}
