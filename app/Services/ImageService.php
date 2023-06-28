<?php

namespace App\Services;

use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\UploadedFile;

class ImageService
{

    // xu ly upload anh , luu vao storage , return image_name ( ten file )

    public function storeImage(UploadedFile $file, $title)
    {
        $destinationPath = 'public/images/' . $title;
        $typeImage = $file->getClientOriginalName();
        $path = $destinationPath . '/' . $typeImage;
        $file->storeAs($destinationPath, $typeImage);

        return $path;
    }

    //replace public -> storage

    public function getPath($name)
    {
        $path = explode('/', $name);
        $path[0] = 'storage';

        return implode('/', $path);
    }

    // check dung luong file 

    public function checkSizeImage($request, $name, $data)
    {
        if ($request->hasFile($name)) {
            $file = $request->file($name);
            $image_name = $this->storeImage($file, $name);
            $image_name = $this->getPath($image_name);

            $data[$name] = $image_name;
        }
        return $data;
    }
}
