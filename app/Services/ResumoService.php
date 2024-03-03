<?php

namespace App\Services;

use App\Http\Requests\ReceitaRequest;
use App\Repositories\ReceitaRepository;
use Illuminate\Http\Request;

class ResumoService
{

    public function __construct(protected ReceitaService $receitaService,
                                protected DespesaService $despesaService)
    {

    }

    public function totalReceitaMensal(int $ano, int $mes) :array
    {
        return $this->receitaService->totalReceitaMensal($ano,$mes);
    }

    public function totalDespesaMensal(int $ano, int $mes) :array
    {
        return $this->despesaService->totalDespesaMensal($ano,$mes);
    }

    public function saldoMensal(array $receita, array $despesa) :array
    {
        $saldo = $receita['valor'] - $despesa['valor'];

        return [
            'tipo' => 'Saldo',
            'valor' => $saldo
        ];
    }

    public function totalDespesaValorCategoriaMensal(int $ano, int $mes) : array
    {
        return $this->despesaService->totalDespesaValorCategoriaMensal($ano, $mes);
    }

    public function totalMensal(int $ano, int $mes) : array
    {
        $totalReceitaMensal = $this->totalReceitaMensal($ano, $mes);

        $totalDespesaMensal = $this->totalDespesaMensal($ano, $mes);

        $saldoMensal = $this->saldoMensal($totalReceitaMensal, $totalDespesaMensal);

        $totalDespesaValorCategoriaMensal = $this->totalDespesaValorCategoriaMensal($ano, $mes);

        $totalMensal = [
            'receita' => $totalReceitaMensal,
            'despesa' => $totalDespesaMensal,
            'saldo' => $saldoMensal,
            'despesa_por_categoria' => $totalDespesaValorCategoriaMensal
        ];

        dd($totalMensal);

        return $totalMensal;
    }
}
