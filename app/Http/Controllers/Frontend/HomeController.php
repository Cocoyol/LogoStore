<?php

namespace LogoStore\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use LogoStore\Category;
use LogoStore\Http\Requests;

use LogoStore\Http\Controllers\Controller;

use LogoStore\Logo;

class HomeController extends Controller
{
    public function index(){

        $logos = Logo::with(['category', 'keywords'])->orderBy('date', 'DESC')->paginate(12);
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

    public function register_customer(){

        return view('front.register_customer');

    }

}
