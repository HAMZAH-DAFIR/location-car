<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Agence;
use App\Models\Car;
use App\Models\Employe;
use App\Models\Reservation;
use App\Models\User;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'car_id' => Car::factory(),
            'user_id' => User::factory(),
            'agent_id' => Employe::factory(),
            'date_start' => $this->faker->dateTime(),
            'date_back' => $this->faker->dateTime(),
            'time_start' => $this->faker->numberBetween(0, 23),
            'time_back' => $this->faker->numberBetween(0, 23),
            'agenceBack_id' => Agence::factory(),
            'confiremed' => $this->faker->boolean,
        ];
    }
}
