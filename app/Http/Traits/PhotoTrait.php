<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait PhotoTrait
{
    public function savePhoto($avatar, $path){
        $image = Image::make(file_get_contents($avatar))->resize(300, 300)->encode('png');

        $fileName = 'image_'.time().rand(1,999).'.png';
        Storage::disk('local')->put($path.$fileName, $image);
        return $fileName;
    }

    public function deletePhoto($name, $path)
    {
        Storage::disk('local')->delete($path.$name);
    }
}
