<?php

namespace App\Console\Commands;

use App\Events\RegisterUser;
use App\Events\SendMail;
use App\Mail\BirthDay;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailBirthDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendMailHappyBirthDay:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dateNow = Carbon::now()->format('m-d');
        $usersWithBirthday = User::whereHas('profiles', function ($query) use ($dateNow) {
            $query->where('dob', 'like', '%' . $dateNow . '%');
        })->get();
        foreach ($usersWithBirthday as $user) {
            try {
                Mail::to($user->email)->send(new BirthDay());
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
