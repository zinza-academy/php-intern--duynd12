<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginService
{

    public function store($request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user_id = Auth::id();
            Session::put('data', [
                'id' => $user_id,
                'email' => $credentials['email']
            ]);
            return redirect()->to('/');
        } else {
            Session::flash('message', 'Sai tai khoan hoa mat khau');
            return Redirect::back();
        }
    }

    // get id in session

    public function getSessionId()
    {
        if (Session::has('data')) {
            return Session::get('data')['id'];
        }
    }

    // get email in session

    public function getSessionEmail()
    {
        if (Session::has('data')) {
            return Session::get('data')['eamil'];
        }
    }
}
