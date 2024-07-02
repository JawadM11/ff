<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Passenger;

class PassengerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Passenger::query()->delete();

        
        Passenger::factory()->count(1000)->create();
    }
}

