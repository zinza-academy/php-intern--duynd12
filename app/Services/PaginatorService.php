<?php

namespace App\Services;

use App\Constants\Pagination;

class PaginatorService
{

    // get query param 

    public function getParam($request, $name)
    {
        $column = $name;

        $param = $request->query($column);

        return $param;
    }

    // get data with paginate 

    public function paginate($request, $name, $data)
    {
        $param  = $this->getParam($request, $name);
        $column =  $name;

        if ($param !== null) {
            $data = $data->orderBy($column, $param)->paginate(Pagination::LIMIT_ELEMENT);
        } else {
            $data = $data->paginate(Pagination::LIMIT_ELEMENT);
        }
        return $data;
    }
}
