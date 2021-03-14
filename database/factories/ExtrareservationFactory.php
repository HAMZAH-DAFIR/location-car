<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Extra;
use App\Models\Extrareservation;
use App\Models\Reservation;

class ExtrareservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Extrareservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'extra_id' => Extra::factory(),
            'reservation_id' => Reservation::factory(),
            'quantite' => $this->faker->numberBetween(1, 10000),
            'totalPrice' => $this->faker->randomFloat(0, 0, 99999.),
        ];
    }
}
