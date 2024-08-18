<?php

namespace App\Filters;
use App\Filters\ApiFilter;

class SubscriptionFilter extends ApiFilter {
    protected $safeParms = [
        'id'=> ['eq'],
        'name'=> ['eq'],
        'memberId'=> ['eq'],
        'subType'=> ['eq'],
        'startDate'=> ['eq', 'gt', 'lt'],
        'endDate'=> ['eq', 'gt', 'lt'],
        'status' => ['eq'],
        'price' => ['eq', 'gt', 'lt']
    ];

    protected $columnMap = [
        'memberId' => 'member_id',
        'subType' => 'sub_type',
        'startDate' => 'start_date',
        'endDate' => 'end_date'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '=<',
        'gt' => '>',
        'gte' => '>=',
    ];

}