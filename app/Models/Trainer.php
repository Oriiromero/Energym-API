<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'speciality', 'availability'
    ];

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}
