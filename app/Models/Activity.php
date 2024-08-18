<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id', 'name', 'description', 'schedule', 'capacity'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
