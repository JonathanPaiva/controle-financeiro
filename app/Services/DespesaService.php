<?php

namespace App\Services;

use App\Http\Requests\DespesaRequest;
use App\Repositories\DespesaRepository;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class DespesaService
{

    public function __construct(protected DespesaRepository $despesaRepository)
    {

    }

    public function getAll(Request $request)
    {
        $despesas = $this->despesaRepository->all($request->all());

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


        if (strlen($despesaValidated['categoria']) == 0 or !isNull($despesaValidated['categoria'])) {
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

    public function despesaMensal(int $ano, int $mes)
    {
        $despesaMensal = $this->despesaRepository->despesaMensal($ano, $mes);

        return $despesaMensal;
    }

    public function totalDespesaMensal(int $ano, int $mes)
    {
        $totalMensal = $this->despesaRepository->totalDespesaMensal($ano,$mes);

        return $totalMensal;
    }

    public function totalDespesaValorCategoriaMensal(int $ano, int $mes)
    {
        $valorPorCategoria = $this->despesaRepository->totalDespesaValorCategoriaMensal($ano,$mes);

        return $valorPorCategoria;
    }
}
