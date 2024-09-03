<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\AuditableContract as Auditable;

class Flight extends Model implements AuditableContract
{
    use HasFactory, Auditable;


    protected $guarded = [];

    protected $auditInclude = [
        'flight_number',
        'departure_city',
        'arrival_city',
        'departure_time',
        'arrival_time',
    
    ];


    public function passengers()
    {
        return $this->belongsToMany(Passenger::class, 'flight_passenger');
    }
}

