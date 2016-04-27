<?php

use Illuminate\Support\Facades\Storage;

/**
 * @param $OriginalName
 * @return string
 */
function encodeFilename($OriginalName)
{
    $timetmp = time();
    $ext = pathinfo($OriginalName, PATHINFO_EXTENSION);
    $name = $timetmp.hash('sha1',$OriginalName).'.'.((!empty($ext)?($ext):''));
    while (Storage::disk('local')->exists('imagesLogos/'.$name)) {
        $timetmp++;
        $name = $timetmp.hash('sha1',$OriginalName).'.'.((!empty($ext)?($ext):''));
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
            //"extra" => (object)["_token" => "0"]
        ];
        $response['initialPreviewThumbTags'][] = (object)["{TAG_IMAGE_NAME}" => $image->name, "{TAG_IMAGE_DESCRIPTION}" => $image->description];
    }
    return (object)$response;
}