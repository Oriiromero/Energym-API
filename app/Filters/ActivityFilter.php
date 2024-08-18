<?php

namespace App\Filters;
use App\Filters\ApiFilter;

class ActivityFilter extends ApiFilter {
    protected $safeParms = [
        'id'=> ['eq'],
        'name'=> ['eq'],
        'trainerId'=> ['eq'],
        'description'=> ['eq'],
        'schedule'=> ['eq', 'gt', 'lt'],
        'capacity'=> ['eq', 'gt', 'lt'],
    ];

    protected $columnMap = [
        'trainerId' => 'trainer_id',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '=<',
        'gt' => '>',
        'gte' => '>=',
    ];

}