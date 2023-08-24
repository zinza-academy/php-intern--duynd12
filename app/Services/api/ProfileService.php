<?php

namespace App\Services\api;

class ProfileService
{
    public function getDataProfile($data)
    {
        $dataProfile = [
            'name' => $data['name'],
            'dob' => $data['dob'],
        ];
        if ($data['avatar'] !== NULL) {
            $dataProfile['avatar'] = $data['avatar'];
        }

        return $dataProfile;
    }
};
