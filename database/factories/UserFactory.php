<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'is_admin' => $this->faker->boolean,
            'email_verified_at' => $this->faker->word,
            'password' => Hash::make('hamzadafir'),
            'remember_token' => Str::random(10),
            'locale' => $this->faker->randomElement(['ar','fr','en']),
        ];
    }
}
