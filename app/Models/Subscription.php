<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'member_id', 'sub_type', 'start_date', 'end_date', 'status', 'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
