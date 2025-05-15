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
        return [
            'code_province' => $this->faker->unique()->postcode,
            'description_province_fr' => $this->faker->unique()->randomElement([
                'Tanger-Assilah', 'Tétouan', 'Larache', 'Chefchaouen', 'Al Hoceïma',
                'Fès', 'Meknès', 'Taza', 'Ifrane', 'Oujda-Angad', 'Nador',
                'Agadir Ida-Outanane', 'Taroudant', 'Guelmim', 'Laâyoune', 'Dakhla',
            ]),
            'description_province_ar' => $this->faker->unique()->randomElement([
                'طنجة-أصيلة', 'تطوان', 'العرائش', 'شفشاون', 'الحسيمة',
                'فاس', 'مكناس', 'تازة', 'إفران', 'وجدة-أنكاد', 'الناظور',
                'أكادير إدا وتنان', 'تارودانت', 'كلميم', 'العيون', 'الداخلة',
            ]),
        ];
    }
}
