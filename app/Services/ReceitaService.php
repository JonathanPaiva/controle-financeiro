<?php

namespace App\Services;

use App\Models\Receita;

class ReceitaService
{

    public function __construct(protected Receita $receitaRepository)
    {
        
    }

    public function getAll() 
    {
        $receitas = $this->receitaRepository->all();

        return $receitas;
    }

    public function getById(int $receita_id)
    {
        $receita = $this->receitaRepository->findOrfail($receita_id);

        return $receita;
    }

}
