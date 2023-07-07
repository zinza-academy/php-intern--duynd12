<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginService
{

    public function store($request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $userId = Auth::id();
            $dataProfile = Profile::where('user_id', $userId)->first()->toArray();
            Session::put('data', [
                'id' => $userId,
                'email' => $credentials['email'],
                'role' => Auth::user()->role,
                'name' => $dataProfile['name'],
                'dob' => $dataProfile['dob'],
                'company_id' => Auth::user()->company_id
            ]);
            return redirect()->to('/');
        } else {
            Session::flash('message', 'Sai tài khoản hoặc mật khẩu');
            return back()->withInput($credentials);
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
            return Session::get('data')['email'];
        }
    }

    // get name in session 

    public function getSessionName()
    {
        if (Session::has('data')) {
            return Session::get('data')['name'];
        }
    }

    // get dob in session 

    public function getSessionDob()
    {
        if (Session::has('data')) {
            return Session::get('data')['dob'];
        }
    }
}
