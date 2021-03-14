<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Agence;
use App\Models\Car;
use App\Models\Category;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name('car'),
            'model' => $this->faker->word,
            'carNumber' => $this->faker->numberBetween(1, 10000),
            'horse' => $this->faker->numberBetween(1, 10000),
            'kilometers' => $this->faker->numberBetween(1, 10000),
            'dor' => $this->faker->numberBetween(1, 5),
            'fuel' => $this->faker->word,
            'type' => $this->faker->randomElement(['A','M']),
            'luggage' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->randomElement(["available","reserved","crash","reforme","inavalable"]),
            'category_id' => Category::factory(),
            'agence_id' => Agence::factory(),
            'in_agaence' => $this->faker->boolean,
        ];
    }
}
