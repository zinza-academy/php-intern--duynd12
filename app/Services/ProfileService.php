<?php

namespace App\Services;

use App\Models\Profile;

class ProfileService extends DatabaseService
{

    public function __construct(Profile $model)
    {
        parent::__construct($model);
    }
}
