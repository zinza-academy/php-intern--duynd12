<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Jobs\SendWelcomeEmail;
use Error;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index(){
        return view('mail');
    }
    public function sendMail(Request $request){
        $data = $request->all();
        event(new SendMail($data));
    }
}
