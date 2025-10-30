<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Gerais
            // 'ver dashboard',
            'gerenciar usuários',
            'gerenciar roles',

            // Médico
            'visualizar pacientes',
            'criar consultas',
            'editar consultas',
            'excluir consultas',
            'prescrever medicamentos',
            'emitir atestados',
            'acessar prontuário completo',

            // Enfermeiro
            'registrar sinais vitais',
            'gerenciar estoque',

            // Paciente
            'visualizar consultas',
            'visualizar prescrições',
            'agendar consulta',
            'cancelar consulta',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
