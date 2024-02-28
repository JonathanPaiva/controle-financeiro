<?php

namespace App\Services;

use App\Http\Requests\ReceitaRequest;
use App\Models\Receita;
use App\Repositories\ReceitaRepository;
use Illuminate\Http\Request;

class ReceitaService
{

    public function __construct(protected ReceitaRepository $receitaRepository)
    {
        
    }

    public function getAll(Request $request) 
    {
        $receitas = $this->receitaRepository->all($request->all());

        return $receitas;
    }

    public function getById(int $receita_id)
    {
        $receita = $this->receitaRepository->find($receita_id);

        return $receita;
    }

    public function create(ReceitaRequest $receitaRequest)
    {
        return $this->receitaRepository->create($receitaRequest->validated());
    }

    public function update(ReceitaRequest $receitaRequest, int $receita_id)
    {
        $receita = $this->getById($receita_id);

        if (!$receita){
            return null;
        }
        
        $receita->update($receitaRequest->validated());
        
        return $receita;
    }

    public function delete(int $receita_id) : bool
    {
        $receita = $this->getById($receita_id);

        if (!$receita) {
            return false;
        }
        
        $receita->delete();

        return true;
    }

}
