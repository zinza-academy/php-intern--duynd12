<?php

namespace App\Services;

use App\Models\Company;

class CompanyService extends DatabaseService
{

    // create construct function 

    public function __construct(Company $model)
    {
        parent::__construct($model);
    }
}
