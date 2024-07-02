<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    // Define the fields that are mass assignable
    protected $guarded = [
        'id', // Primary key should usually be guarded
    ];

    // Optionally, define the hidden fields, such as the password
    protected $hidden = [
        'password',
    ];

    // Define the relationship with flight
    public function flights()
    {
        return $this->belongsToMany(Flight::class, 'flight_passenger');
    }
}
