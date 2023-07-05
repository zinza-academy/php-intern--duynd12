<?php

namespace App\Services;

use App\Events\RegisterUser;
use App\Events\SendMail;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Support\Facades\DB;

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

    public function insertData($data)
    {
        try {
            DB::beginTransaction();

            $user = $this->store($data);
            $data['user_id'] = $user->id;
            $this->profileService->store($data);
            event(new RegisterUser($data));

            DB::commit();
            Notify::success('Thêm thành công user');
        } catch (Exception $e) {
            DB::rollBack();
            Notify::error($e->getMessage());
            return redirect()->back()->withInput($data);
        }
    }

    // update data 

    public function updateData($request, $id)
    {
        $dataProfile = $request->only(['name', 'dob']);
        $dataUser = $request->validated();
        try {
            DB::beginTransaction();

            $this->update($id, $dataUser);
            Profile::where('user_id', $id)->update($dataProfile);
            DB::commit();

            Notify::success("Update thành công");
        } catch (Exception $e) {
            DB::rollBack();
            Notify::error($e->getMessage());
            logger($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }
}
