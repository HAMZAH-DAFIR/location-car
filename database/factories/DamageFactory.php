<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Control;
use App\Models\Damage;

class DamageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Damage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(0, 0, 9999.),
            'control_id' => Control::factory(),
        ];
    }
}
