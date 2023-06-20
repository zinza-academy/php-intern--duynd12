<?php
namespace App\Services;

class ImageService{
    
    // xu ly upload anh , luu vao storage 
    // return image_name ( ten file )
     
    public function storeImage($request)
    {
        $destination_path = 'public/images/avatar';
        $image = $request->file('avatar');
        $image_name = $image->getClientOriginalName();
        $path = $request->file('avatar')->storeAs($destination_path,$image_name);
        return $image_name;
    }

}