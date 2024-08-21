<?php

namespace App\Filters;
use App\Filters\ApiFilter;

class UserFilter extends ApiFilter {
    protected $safeParms = [
        'id'=> ['eq'],
        'name'=> ['eq'],
        'email'=> ['eq'],
        'role'=> ['eq', 'gt', 'lt'],
        'phone'=> ['eq'],
        'membershipStatus' => ['eq'],
        'birthDate' => ['eq', 'gt', 'lt'],
        'postalCode' => ['eq']
    ];

    protected $columnMap = [
        'membershipStatus' => 'membership_status',
        'birthDate' => 'birth_date',
        'postalCode' => 'postal_code',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '=<',
        'gt' => '>',
        'gte' => '>=',
    ];

}