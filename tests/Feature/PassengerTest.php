<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Passenger;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PassengerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_passenger()
    {
        $passenger = Passenger::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
        ]);

        $this->assertDatabaseHas('passengers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
        ]);
    }
}
