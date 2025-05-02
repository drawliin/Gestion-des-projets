<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Province;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Province>
 */
class ProvinceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Province::class;

    public function definition(): array
    
    {
        $faker = \Faker\Factory::create('fr_FR'); // Set Faker's locale to French for one language
        $fakerAr = \Faker\Factory::create('ar_SA'); // Set Faker's locale to Arabic for another language

        return [
            'code_province' => $this->faker->unique()->countryCode(),
            'description_province_fr' => $faker->sentence(), // French
            'description_province_ar' => $fakerAr->sentence(), // Arabic
        ];
    }
}
