<?php

namespace App\Utils;
use http\Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ImageUpload
{
    public static function uploadImage($request, $path = null, $fileRequestName = 'image') {
        $file =  !is_array($request) ? $request->file($fileRequestName) : $request[$fileRequestName];

        $imageNameObject =
            Str::uuid() . date('Y-m-d') . '.' . $file->getClientOriginalExtension()
            ?? Str::uuid() . date('Y-m-d') . '.' . $file->exetnsion();

        $file->storeAs('/public/images/' . $path . '/', $imageNameObject);

        $parts = explode('/', Storage::path('/storage/app/public/images/' . $path . '/' . $imageNameObject));
        $lastElement = array_pop($parts);
        return $lastElement;
//        return Storage::path('/storage/app/public/images/' . $path . '/' . $imageNameObject);
    }
}
