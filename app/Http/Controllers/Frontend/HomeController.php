<?php

namespace LogoStore\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use LogoStore\Http\Requests;

use LogoStore\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){

        return view('front.home');

    }
}
