<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');
        $gender = $faker->randomElement(['male', 'female']);

        return [
            'name' => fake()->name($gender),
            'cpf' => $faker->unique()->cpf(false),
            'email' => fake()->unique()->safeEmail(),
            'gender' => $gender === 'male' ? "M" : "F",
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function doctor(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('medico');

            Doctor::factory()->create([
                'user_id' => $user->id
            ]);
        });
    }

    public function patient(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('paciente');

            Patient::factory()->create([
                'user_id' => $user->id
            ]);
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
