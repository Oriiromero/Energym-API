<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'subscription_id', 'amount', 'payment_method', 'payment_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
