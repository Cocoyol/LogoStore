<?php

use Illuminate\Support\Facades\Storage;

/**
 * @param $OriginalName
 * @return string
 */
function encodeFilename($OriginalName)
{
    $ext = pathinfo($OriginalName, PATHINFO_EXTENSION);

    $basename = hash('sha1',time().$OriginalName);
    $tmp = 1;
    $name = $basename.$tmp.'.'.((!empty($ext)?($ext):''));
    while (Storage::disk('local')->exists('imagesLogos/'.$name)) {
        $tmp++;
        $name = $basename.$tmp.'.'.((!empty($ext)?($ext):''));
    }
    return $name;
}


// RESPUESTA - FILEINPUT -> imagesLogos

function prepareResponse($images)
{
    $url = asset('storage/imagesLogos');
    $response = [];
    foreach($images as $image) {
        $filename = pathinfo($image->filename, PATHINFO_FILENAME);
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