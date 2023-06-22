<?php

namespace App\Services;

use App\Models\Profile;
use App\Services\ImageService;
use App\Services\LoginService;
use App\Services\UserService;
use Exception;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingService
{

    private $loginService;
    private $userService;
    private $imageService;
    private $fieldsToRemove = ['oldPassword', 'confirmPassword', 'password'];

    // create constructor

    public function __construct(LoginService $loginService, UserService $userService, ImageService $imageService)
    {
        $this->loginService = $loginService;
        $this->userService = $userService;
        $this->imageService = $imageService;
    }

    public function update($request)
    {

        $data = $request->all();
        unset($data['email']);
        $id = $this->loginService->getSessionId();
        $userData = $this->userService->find($id);
        $data = $this->imageService->checkSizeImage($request, 'avatar', $data);

        $password = $userData['password'];
        $oldPassword = $data['oldPassword'];
        $newPassword = $data['password'];

        if ($oldPassword == null) {
            foreach ($this->fieldsToRemove as $field) {
                unset($data[$field]);
            }
        } else {
            $boolean = Hash::check($oldPassword, $password);
        }
        [$boolean, $data] = $this->TypedPassword($oldPassword, $password, $data);

        try {
            DB::beginTransaction();

            $data['password'] = Hash::make($newPassword);
            if (isset($boolean) && $boolean) {
                $this->userService->update($id, $data);
            } else if ($oldPassword !== null) {
                Notify::error("Mật khẩu cũ không đúng");
                return redirect()->back()->withInput($request->all());
            }

            // Profile::where('user_id','=',$id)->update($data);
            // $userData->Profiles()->updateOrCreate($data);
            DB::table('profiles')
                ->where('user_id', $id)
                ->update([
                    'name' => $data['name'],
                    'dob' => $data['dob'],
                    'avatar' => $data['avatar']
                ]);
            DB::commit();
            Notify::success("Update thành công");
        } catch (Exception $e) {
            DB::rollBack();
            Notify::error($e->getMessage());
        }
    }

    //check type password

    public function TypedPassword($oldPassword, $password, $data)
    {
        $boolean = false;
        if ($oldPassword == null) {
            foreach ($this->fieldsToRemove as $field) {
                unset($data[$field]);
            }
        } else {
            $boolean = Hash::check($oldPassword, $password);
        }
        return [$boolean, $data];
    }
}
