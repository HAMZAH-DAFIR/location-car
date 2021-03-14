<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Component;
use App\Models\ComponentReformation;
use App\Models\Reformation;

class ComponentReformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ComponentReformation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reformation_id' => Reformation::factory(),
            'component_id' => Component::factory(),
            'quantity' => $this->faker->numberBetween(1, 10000),
            'priceTotal' => $this->faker->randomFloat(0, 0, 99999.),
        ];
    }
}
