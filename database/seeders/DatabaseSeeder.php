<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;
use App\Models\Passenger;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FlightSeeder::class,
            PassengerSeeder::class,
        ]);

        // Attach passengers to flights
        $flights = Flight::all();
        Passenger::all()->each(function ($passenger) use ($flights) {
            $passenger->flights()->attach(
                $flights->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
