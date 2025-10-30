<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $doctor = Role::firstOrCreate(['name' => 'medico']);
        $patient = Role::firstOrCreate(['name' => 'paciente']);
        Role::firstOrCreate(['name' => 'enfermeiro']);

        $doctor->givePermissionTo([
            'visualizar pacientes',
            'criar consultas',
            'editar consultas',
            'prescrever medicamentos',
            'emitir atestados',
            'acessar prontuário completo',
        ]);

        $patient->givePermissionTo([
            'visualizar consultas',
            'visualizar prescrições',
            'agendar consulta',
            'cancelar consulta',
        ]);
    }
}
