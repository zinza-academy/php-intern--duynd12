<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailNotification
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
    public function handle(SendMail $event): void
    {
        $user = $event->user;
        Mail::send('welcome', ['user' => $user], function ($message) use ($user) {
            $message->from('duy88706@gmail.com', 'Nguyen dang duy');
            $message->subject('Welcome to my channel ' . '!');
            $message->to($user['email']);
        });
    }
}
