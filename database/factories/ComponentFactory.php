<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Component;

class ComponentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Component::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'serie' => $this->faker->word,
            'type' => $this->faker->word,
            'color' => $this->faker->word,
            'quantite' => $this->faker->numberBetween(1, 10000),
            'price' => $this->faker->randomFloat(0, 0, 9999.),
        ];
    }
}
