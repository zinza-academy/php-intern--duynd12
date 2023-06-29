<?php

namespace App\Services;

use App\Constants\Pagination;

class PaginatorService
{
    const ARRAY = ['desc', 'asc'];

    // get query param 

    public function getParam($request, $name)
    {
        $param = $request->query($name);

        $param = in_array($param, self::ARRAY) ? $param : 'desc';

        return $param;
    }

    // get data with paginate

    public function paginate($request, $name, $data)
    {
        $param  = $this->getParam($request, $name);
        if ($param !== null) {
            $data = $data->orderBy($name, $param)->paginate(Pagination::LIMIT_ELEMENT);
        } else {
            $data = $data->paginate(Pagination::LIMIT_ELEMENT);
        }
        return $data;
    }

    // sort data

    public function sortData($request, $name, $data)
    {
        $param = $this->getParam($request, $name);
        if ($param !== null) {
            $data = $data->orderBy($name, $param);
        }
        return $data;
    }
}
