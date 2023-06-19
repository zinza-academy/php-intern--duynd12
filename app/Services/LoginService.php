<?php 
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginService{

    public function store($request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return Redirect::to("mail");

        } else {
            Session::flash('message', 'Sai tai khoan hoa mat khau'); 
            return Redirect::back();

        }
    }

}