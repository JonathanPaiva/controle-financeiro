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
            'descricao' => fake()->text(),
            'valor' => fake()->randomFloat(2,0,9999.99),
            'data' => fake()->dateTimeThisMonth(),
            'tipo' => 'D'
        ];
    }
}