<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Damage;
use App\Models\Employe;
use App\Models\Reformation;

class ReformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reformation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mechanic_id' => Employe::factory(),
            'damage_id' => Damage::factory(),
            'description' => $this->faker->text,
            'totalprice' => $this->faker->randomFloat(0, 0,9999.),
        ];
    }
}
