<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Despesa>
 */
class DespesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descricao' => fake()->text(10),
            'valor' => fake()->randomFloat(2,0,999.99),
            'data' => fake()->dateTimeThisMonth(),
            'categoria' => fake()->randomElement(['Moradia', 'Comunicação', 'Transporte', 'Lazer', 'Alimentação', 'Saúde', 'Cartão de Crédito']),
            'tipo' => 'D',
            'grupo' => fake()->randomElement(['Fixa', 'Variável'])
        ];
    }
}
