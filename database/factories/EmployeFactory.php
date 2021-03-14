<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Agence;
use App\Models\Employe;
use App\Models\User;

class EmployeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'role' => $this->faker->word,
            'birthday' => $this->faker->dateTime(),
            'cni' => Str::random(20),
            'agence_id' => Agence::factory(),
        ];
    }
}
