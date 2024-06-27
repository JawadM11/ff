<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flight::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{4}'),
            'departure_city' => $this->faker->city,
            'arrival_city' => $this->faker->city,
            'departure_time' => $departureTime = $this->faker->dateTimeBetween('now', '+1 month'),
            'arrival_time' => $this->faker->dateTimeBetween($departureTime, $departureTime->modify('+1 day')),
        ];
    }
}
