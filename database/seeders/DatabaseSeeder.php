<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Despesa;
use App\Models\Receita;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Despesa::factory(20)->create();

        Receita::factory(20)->create();

        User::factory(10)->create();

         User::factory()->create([
             'name' => 'Teste',
             'email' => 'teste@teste.com'
         ]);
    }
}
