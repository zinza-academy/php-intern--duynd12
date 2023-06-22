<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class DatabaseService
{
    protected $model;

    // create function construct

    public function __construct(Model $_model)
    {
        $this->model = $_model;
    }

    // find data 
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Save data 
     */

    public function store($array)
    {
        return $this->model::create($array);
    }

    /**
     * update data 
     */

    public function update($id, $data)
    {
        return $this->model::findOrFail($id)->update($data);
    }
}
