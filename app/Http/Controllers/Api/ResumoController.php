<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ResumoService;
use \App\Traits\HttpResponses;

class ResumoController extends Controller
{
    use HttpResponses;

    public function __construct(protected ResumoService $resumoService)
    {
    }

    public function index(int $ano, int $mes)
    {
        $totalMensal = $this->resumoService->totalMensal($ano, $mes);

        return $this->successResponse('Sucesso',200,$totalMensal);
    }
}
