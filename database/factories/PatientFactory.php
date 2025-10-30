<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
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
            // 'prontuario' => $faker->unique()->numerify('PR-####'),
            'health_plan' => $faker->randomElement([
                'Alice',
                'Allianz Saúde',
                'Ameplan Saúde',
                'Amil',
                'Ana Costa Saúde',
                'Bradesco Saúde',
                'Care Plus',
                'Golden Cross',
                'Hapvida',
                'NotreDame Intermédica',
                'SulAmérica Saúde',
                'Unimed'
            ]),
            'blood_type' => $faker->randomElement([
                'A+',
                'A-',
                'B+',
                'B-',
                'O+',
                'O-',
                'AB+',
                'AB-'
            ])
        ];
    }
}
