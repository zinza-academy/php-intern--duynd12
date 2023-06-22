<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService extends DatabaseService
{

    private $profileService;

    // create constructor

    public function __construct(User $model, ProfileService $profileService)
    {
        parent::__construct($model);
        $this->profileService = $profileService;
    }


    // insert data 

    public function insertData($request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        try {
            DB::beginTransaction();

            $user = $this->store($data);
            $data['user_id'] = $user->id;
            $this->profileService->store($data);
            $user->roles()->attach(
                $data['role_id']
            );

            DB::commit();
            Notify::success('Thêm thành công user');
        } catch (Exception $e) {
            DB::rollBack();
            Notify::error($e->getMessage());
        }
    }

    // update data 

    public function updateData($request, $id)
    {
        $data = $request->only(['name', 'dob']);
        $role_id = $request['role_id'];
        $user = $this->find($id);

        try {
            DB::beginTransaction();

            Profile::where('user_id', $id)->update($data);
            $user->roles()->attach($role_id);

            DB::commit();
            Notify::success("Update thành công");
        } catch (Exception $e) {
            DB::rollBack();
            Notify::error($e->getMessage());
        }
    }
}
