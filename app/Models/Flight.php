<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    // Define the fields that are mass assignable
    protected $fillable = [
        'number',
        'departure_city',
        'arrival_city',
        'departure_time',
        'arrival_time',
    ];

    // Define the relationship with passengers
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}

