<?php

namespace LogoStore\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use LogoStore\Http\Requests;
use LogoStore\Http\Controllers\Controller;
use LogoStore\ImagesLogo;
use LogoStore\Logo;

class ImagesLogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
     * -- Operaciones con Logo
     */
    public function listByLogo($logo_id)
    {
        $logo = Logo::with('images')->findOrFail($logo_id);
        $images = $logo->images;
        return view('admin.images.edit', compact('logo', 'images'));
    }

    public function storeByLogo($logo_id, Request $request)
    {

        //dd($request);

        $logo = Logo::with('images')->findOrFail($logo_id);

        $file = $request->file('file_data');

        $fileNewName = $this->renameFile($file);

        $val = Storage::disk('local')->put('imagesLogos/'.$fileNewName, File::get($file));

        $response = json_encode([]);
        if ($val) {
            $image = new ImagesLogo();
            $image->filename = $fileNewName;
            $image->name = $request->get('name');
            $image->description = $request->get('description');
            $image->logo_id = $logo->id;
            $image->save();

            $response = json_encode($image);
        }
        return $response;
    }

    private function renameFile($file)
    {
        $OriginalName = $file->getClientOriginalName();
        $timetmp = time();
        $ext = pathinfo($OriginalName, PATHINFO_EXTENSION);
        $name = $timetmp.hash('sha1',$OriginalName).'.'.((!empty($ext)?($ext):''));
        while (Storage::disk('local')->exists($name)) {
            $timetmp++;
            $name = $timetmp.hash('sha1',$OriginalName).'.'.((!empty($ext)?($ext):''));
        }
        return $name;
    }

}
