<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id', 'member_id', 'booking_date', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
