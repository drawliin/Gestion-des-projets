<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;


class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nom" => $this->faker->lastName(),
            "prenom" => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'password',
            //'role' => $this->faker->randomElement(['admin', 'directeur', 'gestionnaire', 'responsable_financier']),
            'remember_token' => Str::random(10),
        ];
    }
}
