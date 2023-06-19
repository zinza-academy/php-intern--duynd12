<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmail;
use Error;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index(){
        return view('mail');
    }
    public function senMail(Request $request){
        $data = $request->all();
        $emailJob = new SendWelcomeEmail($data);    
        dispatch($emailJob);
    }
}
