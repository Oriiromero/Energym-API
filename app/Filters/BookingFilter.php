<?php

namespace App\Filters;
use App\Filters\ApiFilter;

class BookingFilter extends ApiFilter {
    protected $safeParms = [
        'id'=> ['eq'],
        'activityId'=> ['eq'],
        'memberId'=> ['eq'],
        'bookingId'=> ['eq'],
        'status' => ['eq'],
    ];

    protected $columnMap = [
        'memberId' => 'member_id',
        'activityId' => 'activity_id',
    ];

    protected $operatorMap = [
        'eq' => '=',
    ];

}