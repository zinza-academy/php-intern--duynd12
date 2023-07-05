<?php

namespace App\Listeners;

use App\Events\Birthday;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailBirthdayNotification
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
    public function handle(Birthday $event): void
    {
        $user = $event->data;
        Mail::send('sendMail', $user, function ($message) use ($user) {
            $message->from('duy88706@gmail.com', 'Thư chúc mừng sinh nhật');
            $message->subject('Thư chúc mừng sinh nhật');
            $message->to($user['email']);
        });
    }
}
