<?php

namespace App\Repositories;

use App\Models\Receita;
use Illuminate\Database\Eloquent\Collection;

class ReceitaRepository
{
    public function __construct(protected Receita $model)
    {
        
    }

    public function paginate()
    {
        return $this->model->paginate();
    }

    public function all(array $filtros = []) : Collection|null
    {           
        if (count($filtros)) {
            $receitas = $this->model->query();
            
            foreach ($filtros as $key => $value) {
                $receitasFiltradas = $receitas->where($key, 'LIKE', "%$value%")->get();
            }
            
            return $receitasFiltradas->sortByDesc('data');
        }
        
        $receitas = $this->model->all()->sortByDesc('data');

        return $receitas;
    }

    public function find(int $receita_id) : Receita|null
    {
        $receita = $this->model->find($receita_id);

        return $receita;
    }

    public function create(array $requestValidated) : Receita
    {
        return $this->model->create($requestValidated);
    }

    public function receitaMensal(int $ano, int $mes) : Collection|null
    {
        if (!$mes>0 & !$mes<=12) {
            return null;
        }

        $receitaMesal = $this->model->query()->whereMonth('data', '=', $mes)
                                             ->whereYear('data', '=', $ano)
                                             ->get();    

        return $receitaMesal->sortByDesc('data');
    }
}