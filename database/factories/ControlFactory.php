<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Car;
use App\Models\Control;
use App\Models\Employe;

class ControlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Control::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'controller_id' => Employe::factory(),
            'car_id' => Car::factory(),
            'confirmed' => $this->faker->boolean,
        ];
    }
}
