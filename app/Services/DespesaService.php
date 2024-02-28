<?php

namespace App\Services;

use App\Http\Requests\DespesaRequest;
use App\Models\Despesa;

use function PHPUnit\Framework\isNull;

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
        $despesaValidated = $despesaRequest->validated();
        
        if (!strlen($despesaValidated['categoria']) or isNull($despesaValidated['categoria'])) {
            $despesaValidated['categoria'] = 'Outras';
        }
        
        return $this->despesaRepository->create($despesaValidated);
    }

    public function update(DespesaRequest $despesaRequest, int $despesa_id)
    {
        $despesa = $this->getById($despesa_id);

        if (!$despesa){
            return null;
        }

        $despesaValidated = $despesaRequest->validated();

        if (!strlen($despesaValidated['categoria']) or isNull($despesaValidated['categoria'])) {
            $despesaValidated['categoria'] = 'Outras';
        }
        
        $despesa->update($despesaValidated);
        
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