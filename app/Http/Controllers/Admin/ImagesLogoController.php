<?php

namespace LogoStore\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use LogoStore\Http\Requests;
use LogoStore\Http\Controllers\Controller;
use LogoStore\Http\Requests\CreateImagesLogoRequest;
use LogoStore\ImagesLogo;
use LogoStore\Logo;

class ImagesLogoController extends Controller
{

    /*
     * -- Prefijos y tamaños de thumbnails
     */
    protected $thumbs = [
        "_thumb" => [230, 230],
        "_thumb2" => [729, 510],
        "_thumb3" => [328, 212]
    ];

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
    public function update(CreateImagesLogoRequest $request, $id)
    {
        $image = ImagesLogo::findOrFail($id);
        $image->fill($request->all());

        $image->save();

        return "La imagen ".$image->filename." se ha actualizado.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $image = ImagesLogo::findOrFail($id);

        $response = json_encode((object)["La imagen no existe ya."]);
        if(Storage::disk('local')->exists('imagesLogos/'.$image->filename)) {

            $filename = extractFilename($image->filename);
            $extension = extractExtension($image->filename);

            Storage::disk('local')->delete('imagesLogos/'.$image->filename);
            foreach($this->thumbs as $thumbKey => $thumb) {
                Storage::disk('local')->delete('imagesLogos/'.$filename.$thumbKey.'.'.$extension);
            }

            $response = json_encode((object)["error" => "La imagen ".$image->filename." NO ha sido eliminada."]);
            if(!Storage::disk('local')->exists('imagesLogos/'.$image->filename)) {
                $response = json_encode((object)["La imagen " . $image->filename . " ha sido eliminada."]);
                $image->delete();
            }
        }
        return $response;
    }

    /*
     * -- Operaciones con Logo
     */
    public function listByLogo($logo_id, Request $request)
    {
        $logo = Logo::with('images')->findOrFail($logo_id);
        $images = prepareResponse($logo->images);
        return json_encode($images);
    }

    public function storeByLogo($logo_id, CreateImagesLogoRequest $request)
    {

        //dd($request->all());
        $logo = Logo::with('images')->findOrFail($logo_id);

        $file = $request->file('images');
        //dd($file);
        $response = (object)["error" => "Ning&uacute;n archivo seleccionado."];
        if($file != null) {

            $response = (object)["error" => "El archivo \"".$file->getClientOriginalName()."\" NO es una imagen. Solo im&aacute;genes son permitidas."];
            if(validateImage($file)) {

                $fileNewName = encodeFilename($file->getClientOriginalName());

                $val = Storage::disk('local')->put('imagesLogos/' . $fileNewName, file_get_contents($file->getRealPath()));

                $imagePath = public_path('storage/imagesLogos/'.$fileNewName);
                $filename = extractFilename($fileNewName);
                $extension = extractExtension($fileNewName);

                foreach($this->thumbs as $thumbKey => $thumb) {
                    $thumbPath = public_path('storage/imagesLogos/'.$filename.$thumbKey.'.'.$extension);
                    resizeImage($imagePath, $thumb[0], $thumb[1], $thumbPath);
                }

                $response = json_encode((object)["error" => "No fue posible almacenar la imagen ".$file->getClientOriginalName()]);
                if ($val) {
                    $image = new ImagesLogo();
                    $image->filename = $fileNewName;
                    $image->name = $request->get('name');
                    $image->description = $request->get('description');
                    $image->logo_id = $logo->id;
                    $image->save();

                    $response = prepareResponse([$image]);
                }
            }
        }
        return json_encode($response);
    }

}
