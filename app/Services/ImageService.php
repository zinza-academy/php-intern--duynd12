<?php

namespace App\Services;

use Helmesvs\Notify\Facades\Notify;

class ImageService
{

    // xu ly upload anh , luu vao storage 
    // return image_name ( ten file )

    public function storeImage($request)
    {
        $destination_path = 'public/images/avatar';
        $image = $request->file('avatar');
        $image_name = $image->getClientOriginalName();
        $path = $request->file('avatar')->storeAs($destination_path, $image_name);
        return $image_name;
    }

    // check dung luong file 

    public function checkSizeImage($request, $name, $data)
    {
        if ($request->hasFile($name)) {
            if ($request->file($name)->isValid()) {
                $image_name = $this->storeImage($request);
                $data[$name] = $image_name;
            } else {
                Notify::error("File không hợp lệ");
                return redirect()->back()->withInput($request->all());
            }
        }
        return $data;
    }
}
