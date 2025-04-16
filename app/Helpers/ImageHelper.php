<?php
use Illuminate\Http\UploadedFile;

function uploadImage($image, $path) {
    
    $image_name = time().rand(1,1000).'.'.$image->getClientOriginalExtension();
    $image->move(public_path($path), $image_name);
    return $image_name;
}

?>