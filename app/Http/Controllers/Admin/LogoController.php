<?php

namespace LogoStore\Http\Controllers\Admin;

use LogoStore\Category;
use LogoStore\Http\Controllers\Controller;

use LogoStore\Http\Requests\CreateLogoRequest;

use Illuminate\Http\Request;

use LogoStore\Http\Requests;

use LogoStore\Logo;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logos = Logo::with('category')->with('keywords')->orderBy('date', 'DESC')->paginate();

        return view('admin.logos.index', compact('logos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.logos.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLogoRequest $request)
    {
        $logo = Logo::create($request->all());
        return redirect()->route('admin.logos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::pluck('name', 'id');

        $logo = Logo::findOrFail($id);
        return view('admin.logos.edit', compact('logo', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $logo = Logo::findOrFail($id);

        $logo->fill($request->all());

        $logo->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

        $logo = Logo::findOrFail($id);

        $logo->delete();

        $message ='El logo' .$logo->name. 'fue eliminado de nuestros registros.';

        if($request->ajax())
        {
            return response()->json([
                'id' => $logo->id,
                'message' => $message
            ]);
        }

        Session::flash('message', $message);

        return redirect()->route('admin.logos.index');

    }

}
