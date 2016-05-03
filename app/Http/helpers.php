<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * @param $OriginalName
 * @return string
 */
function encodeFilename($OriginalName)
{
    $ext = extractExtension($OriginalName);

    $basename = hash('sha1',time().$OriginalName);
    $tmp = 1;
    $name = $basename.$tmp.'.'.(!empty($ext)?$ext:'jpg');
    while (Storage::disk('local')->exists('imagesLogos/'.$name)) {
        $tmp++;
        $name = $basename.$tmp.'.'.(!empty($ext)?$ext:'jpg');
    }
    return $name;
}


// RESPUESTA - FILEINPUT -> imagesLogos
function prepareResponse($images)
{
    $url = asset('storage/imagesLogos');
    $response = [];
    foreach($images as $image) {
        $filename = extractFilename($image->filename);
        $response['initialPreview'][] = "<img src='".$url."/".$image->filename."' class='file-preview-image' alt='".$filename."' title='".$filename."'>";
        $response['initialPreviewConfig'][] = (object)[
            "caption" => $image->filename,
            "url" => route('logos.images.destroy', $image->id),
            "key" => $image->id
        ];
        $response['initialPreviewThumbTags'][] = (object)["{TAG_IMAGE_NAME}" => $image->name, "{TAG_IMAGE_DESCRIPTION}" => $image->description];
    }
    return (object)$response;
}


// DEVUELVE SOLO EL NOMBRE DE ARCHIVO SIN EXTENSIÓN
function extractFilename($fullFilename)
{
    return pathinfo($fullFilename, PATHINFO_FILENAME);
}


function extractExtension($fullFilename)
{
    return pathinfo($fullFilename, PATHINFO_EXTENSION);
}


// VALIDA TIPO DE IMAGEN POR $file
function validateImage($file)
{
    $imageInfo = getimagesize($file->getPathname());
    if($imageInfo) {
        $allowedType = ['image/jpeg', 'image/png', 'image/gif'];
        if(in_array($imageInfo['mime'],$allowedType)) {
            return true;
        }
    }
    return false;
}


// REDIMENSIONA LA IMAGEN (Requiere 'Intervention')
function resizeImage($imagePath, $w, $h, $thumbPath){
    $img = Image::make($imagePath);
    $originalW = $img->width();
    $originalH = $img->height();
    $originalAR = $originalW / $originalH;
    $newAR = $w / $h;

    if ($originalW >= $originalH) {
        if ($originalAR >= $newAR) {
            $img->resize(null, $h, function($c){ $c->aspectRatio(); });
        } else {
            $img->resize($w, null, function($c){ $c->aspectRatio(); });
        }
    } else {
        if ($originalAR >= $newAR) {
            $img->resize(null, $h, function($c){ $c->aspectRatio(); });
        } else {
            $img->resize($w, null, function($c){ $c->aspectRatio(); });
        }
    }
    $img->crop($w, $h);

    $img->save($thumbPath);
}


// DIVIDE UN ARRAY EN N PARTES DE SIMILAR TAMAÑO
function nChunks($collection, $n)
{
    $chunks = collect();
    $Sz = $collection->count();
    if($Sz > $n) {
        $chunkSz = floor($Sz / $n);
        $mod = $Sz % $n;
        $base = 0;
        while ($n-- > 0) {
            $length = $chunkSz;
            if ($mod-- > 0) $length++;
            $chunks->push($collection->slice($base, $length));
            $base += $length;
        }
        return $chunks;
    }
    return $collection;
}