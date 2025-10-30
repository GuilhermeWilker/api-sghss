<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            SupplySeeder::class,
        ]);

        $admin = User::factory()->create([
            'name' => 'Administrador Geral',
            'email' => 'admin@sghss.com',
            'cpf' => '00000000000',
            'gender' => 'M',
        ]);
        $admin->assignRole('admin');

        User::factory()->count(5)->doctor()->create();
        User::factory()->count(10)->patient()->create();
    }
}
