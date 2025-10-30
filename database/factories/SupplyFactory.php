<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supply>
 */
class SupplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'medicamento',
            'equipamento_medico',
            'material_hospitalar',
            'limpeza',
            'escritorio',
            'alimentacao',
            'tecnologia',
        ];

        $type = $this->faker->randomElement($types);

        $name = match ($type) {
            'medicamento' => $this->faker->randomElement([
                'Paracetamol 500mg',
                'Amoxicilina 875mg',
                'Dipirona Sódica 1g',
                'Omeprazol 20mg',
                'Ibuprofeno 400mg',
                'Losartana 50mg',
                'Metformina 850mg',
                'Simeticona 125mg',
                'Azitromicina 500mg',
                'Cetoprofeno 100mg',
                'Prednisona 20mg',
                'Diclofenaco Sódico 50mg',
                'Hidroclorotiazida 25mg',
                'Ranitidina 150mg',
                'Cefalexina 500mg',
                'Lorazepam 1mg',
                'Sinvastatina 20mg',
                'Clonazepam 2mg',
                'Enalapril 10mg',
                'Nimesulida 100mg',
                'Captopril 25mg',
                'Amiodarona 200mg',
                'Furosemida 40mg'
            ]),
            'equipamento_medico' => $this->faker->randomElement([
                'Estetoscópio',
                'Termômetro Digital',
                'Bisturi',
                'Oxímetro de Dedo'
            ]),
            'material_hospitalar' => $this->faker->randomElement([
                'Seringa 5ml',
                'Luvas de Látex',
                'Máscara Cirúrgica',
                'Gaze Estéril'
            ]),
            'limpeza' => $this->faker->randomElement([
                'Álcool 70%',
                'Desinfetante Hospitalar',
                'Sabão Neutro',
                'Água Sanitária'
            ]),
            'escritorio' => $this->faker->randomElement([
                'Papel A4',
                'Caneta Azul',
                'Etiqueta Adesiva',
                'Bloco de Notas'
            ]),
            'alimentacao' => $this->faker->randomElement([
                'Água Mineral 500ml',
                'Suplemento Nutricional',
                'Biscoito Integral',
                'Suco Natural'
            ]),
            'tecnologia' => $this->faker->randomElement([
                'Computador Dell',
                'Monitor 24"',
                'Impressora HP',
                'Cabo HDMI'
            ]),
        };

        return [
            'name' => $name,
            'quantity' => $this->faker->numberBetween(5, 200),
            'min_quantity' => $this->faker->numberBetween(1, 20),
            'unit' => $this->faker->randomElement(['unidade', 'caixa', 'litro', 'kg']),
            'description' => $this->faker->sentence(8),
            'type' => $type,
        ];
    }
}
