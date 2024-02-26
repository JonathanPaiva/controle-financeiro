<?php

namespace App\Services;

use App\Http\Requests\DespesaRequest;
use App\Models\Despesa;

class DespesaService
{

    public function __construct(protected Despesa $despesaRepository)
    {
        
    }

    public function getAll() 
    {
        $despesas = $this->despesaRepository->all();

        return $despesas;
    }

    public function getById(int $receita_id)
    {
        $despesa = $this->despesaRepository->find($receita_id);

        return $despesa;
    }

    public function create(DespesaRequest $despesaRequest)
    {
        return $this->despesaRepository->create($despesaRequest->validated());
    }

    public function update(DespesaRequest $despesaRequest, int $despesa_id)
    {
        $despesa = $this->getById($despesa_id);

        if (!$despesa){
            return null;
        }
        
        $despesa->update($despesaRequest->validated());
        
        return $despesa;
    }

    public function delete(int $despesa_id) : bool
    {
        $despesa = $this->getById($despesa_id);

        if (!$despesa) {
            return false;
        }
        
        $despesa->delete();

        return true;
    }

}
