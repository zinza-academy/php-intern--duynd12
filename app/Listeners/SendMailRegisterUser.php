<?php

namespace App\Listeners;

use App\Events\RegisterUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailRegisterUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RegisterUser $event): void
    {
        $user = $event->data;
        Mail::send('infoUser', $user, function ($message) use ($user) {
            $message->from('duy88706@gmail.com', 'Thông tin tài khoản');
            $message->subject('Đăng kí tài khoản thành công');
            $message->to($user['email']);
        });
    }
}
