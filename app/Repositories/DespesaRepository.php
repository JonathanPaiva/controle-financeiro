<?php

namespace App\Repositories;

use App\Models\Despesa;
use Illuminate\Database\Eloquent\Collection;

class DespesaRepository
{
    public function __construct(protected Despesa $model)
    {

    }

    public function paginate()
    {
        return $this->model->paginate();
    }

    public function all(array $filtros = [])
    {
        if (count($filtros)) {
            $despesas = $this->model->query();

            foreach ($filtros as $key => $value) {
                $despesasFiltradas = $despesas->where($key, 'LIKE', "%$value%")->get();
            }

            return $despesasFiltradas;
        }

        $despesas = $this->model->all()->sortByDesc('data');

        return $despesas;
    }

    public function find(int $despesa_id) : Despesa|null
    {
        $despesa = $this->model->find($despesa_id);

        return $despesa;
    }

    public function create(array $requestValidated) : Despesa
    {
        return $this->model->create($requestValidated);
    }

    public function despesaMensal(int $ano, int $mes) : Collection|null
    {
        if (!$mes>0 & !$mes<=12) {
            return null;
        }

        $despesaMesal = $this->model->query()->whereMonth('data', '=', $mes)
                                             ->whereYear('data', '=', $ano)
                                             ->get();

        return $despesaMesal->sortByDesc('data');
    }
}
