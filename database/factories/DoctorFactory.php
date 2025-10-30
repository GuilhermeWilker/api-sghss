<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');

        return [
            'crm' => $faker->numerify('######-SP'),
            'speacialty' => $faker->randomElement([
                'Cardiologia',
                'Pediatria',
                'Ortopedia',
                'Clínica Geral'
            ])
        ];
    }
}
