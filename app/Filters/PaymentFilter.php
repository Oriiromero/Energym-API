<?php

namespace App\Filters;
use App\Filters\ApiFilter;

class PaymentFilter extends ApiFilter {
    protected $safeParms = [
        'id'=> ['eq'],
        'memberId'=> ['eq'],
        'subscriptionId'=> ['eq'],
        'amount'=> ['eq', 'gt', 'lt'],
        'paymentMethod'=> ['eq'],
    ];

    protected $columnMap = [
        'memberId' => 'member_id',
        'subscriptionId' => 'subscription_id',
        'paymentMethod' => 'payment_method',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '=<',
        'gt' => '>',
        'gte' => '>=',
    ];

}