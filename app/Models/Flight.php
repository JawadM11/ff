<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable;

class Flight extends Model implements AuditableContract
{
    use HasFactory, Auditable;


    protected $guarded = [];

    public function passengers()
    {
        return $this->belongsToMany(Passenger::class, 'flight_passenger');
    }
}

