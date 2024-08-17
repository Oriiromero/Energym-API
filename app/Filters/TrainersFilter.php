<?php

namespace App\Filters;
use App\Filters\ApiFilter;

class TrainersFilter extends ApiFilter {
    protected $safeParms = [
        'id'=> ['eq'],
        'name'=> ['eq'],
        'speciality'=> ['eq'],
        'availability'=> ['eq'],
    ];

    protected $operatorMap = [
        'eq' => '=',
    ];

}