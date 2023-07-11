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
        '0' => 'problem',
        '1' => 'solve',
        '2' => 'reject_by_admin_or_company_acc'
    ];

    const PIN = 1;
    const LIMIT_ELEMENT = 6;
    const KEY_CACHE_TOPIC = 'topics';
}
