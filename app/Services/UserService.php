<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;
use Exception;
use Helmesvs\Notify\Facades\Notify;
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

    public function insertData($data, $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->store($data);
            $data['user_id'] = $user->id;
            $this->profileService->store($data);

            DB::commit();
            Notify::success('Thêm thành công user');
        } catch (Exception $e) {
            DB::rollBack();
            Notify::error($e->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    // update data 

    public function updateData($request, $id)
    {
        $dataProfile = $request->only(['name', 'dob']);
        $dataUser = $request->only(['role', 'company_id']);

        try {
            DB::beginTransaction();

            Profile::where('user_id', $id)->update($dataProfile);
            $this->update($id, $dataUser);
            DB::commit();
            Notify::success("Update thành công");
        } catch (Exception $e) {
            DB::rollBack();
            Notify::error($e->getMessage());
            logger($e);
            return redirect()->back()->withInput($request->all());
        }
    }
}
