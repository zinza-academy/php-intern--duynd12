<?php

namespace App\Services;

use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
            $imageName = $this->storeImage($file, $name);
            $imageName = $this->getPath($imageName);
            $data[$name] = $imageName;
        }

        return $data;
    }

    // store image with api
    public function storeImageApi($name, $data)
    {
        $destinationPath = 'public/images/' . $name;
        Storage::disk('local')->put($destinationPath, file_get_contents($data));

        $imageName = $this->getPath($destinationPath);
        $data[$name] = $imageName;
    }
}
