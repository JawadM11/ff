<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Passenger; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PassengersTableSeeder extends Seeder
{
    
    public function run(): void
    {
        
        DB::table('passengers')->delete();

        
        Passenger::factory()->count(1000)->create();
    }
}
