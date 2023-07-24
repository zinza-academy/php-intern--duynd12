<?php

namespace app\Constants;

class StatusConstants
{
    const ACTIVE = 'ACTIVE';
    const NO_ACTIVE = 'NO ACTIVE';

    const DESC = "desc";
    const ASC = "asc";

    const COMPANY_ACTIVE = [
        '0' => 'Active',
        '1' => 'inactive'
    ];

    const STATUS_POST = [
        '0' => 'Not Resolve',
        '1' => 'Resolve',
        '2' => 'Delete by admin/company_account'
    ];

    const DELETE_BY_ADMIN_OR_COMPANY_ACCOUNT = 2;
    const RESOLVE = 1;
    const NOT_RESOLVE = 0;
    const ONE = 1;

    const LIMIT_RECORD = 5;
    const KEY_CACHE_TOPIC = 'topics';
    const TIME_CACHE_MINUTE = 30;
}
