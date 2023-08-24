<?php

namespace App\Services\api;

use App\Events\RegisterUser;
use App\Models\Profile;
use App\Models\User;
use App\Services\UserService as ServiceUser;
use Illuminate\Support\Facades\DB;

class UserService
{
    private $userService;

    public function __construct(ServiceUser $userService)
    {
        $this->userService = $userService;
    }

    //check so luong user
    public function checkAmountUser($data)
    {
        if (!$this->userService->checkMaxUserOfCompany($data)) {

            return response()->json([
                'message' => 'Số lượng user đã max . Vui lòng chọn công ty khác'
            ]);
        }
    }

    //create user
    public function createUser($user)
    {
        DB::beginTransaction();
        $data = User::create($user);
        $user['user_id'] = $data->id;
        Profile::create($user);
        $this->checkAmountUser($user);
        event(new RegisterUser($user));

        DB::commit();
    }
}
