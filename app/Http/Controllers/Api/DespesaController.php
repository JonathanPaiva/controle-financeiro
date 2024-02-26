<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DespesaRequest;
use App\Http\Resources\DespesaResource;
use App\Services\DespesaService;
use App\Traits\HttpResponses;

class DespesaController extends Controller
{
    use HttpResponses;

    public function __construct(protected DespesaService $despesaService)
    {
        
    }

    public function index()
    {
        $despesas = $this->despesaService->getAll();

        $despesasJson = DespesaResource::collection($despesas);
        
        return $this->successResponse('Sucesso',200,$despesasJson);
    }

    public function store(DespesaRequest $despesaRequest, int $despesa_id = 0)
    {

        if ($despesa_id) {
            
            if ($despesa_id <> $despesaRequest->id) {
                return $this->errorResponse('Despesa com parâmetros incorretos', 406);
            }

            $despesa = $this->despesaService->update($despesaRequest, $despesa_id);

            $despesaJson = new DespesaResource($despesa);

            return $this->successResponse('Despesa alterada', 200, $despesaJson );
        }

        $despesa = $this->despesaService->create($despesaRequest);

        $despesa = $this->despesaService->getById($despesa->id);

        $despesaJson = new DespesaResource($despesa);

        return $this->successResponse('Despesa criada', 201, $despesaJson);
    }

    public function show(int $despesa_id)
    {
        $despesa = $this->despesaService->getById($despesa_id);

        if (!$despesa) {
            return $this->errorResponse('Despesa não encontrada', 404);
        }

        $despesaJson = new DespesaResource($despesa);

        return $this->successResponse('Despesa encontrada', 200, $despesaJson);
    }

    public function destroy(int $despesa_id)
    {
        $despesaDeletada = $this->despesaService->delete($despesa_id);

        if (!$despesaDeletada) {
            return $this->errorResponse('Despesa não encontrada', 404);
        }

        return $this->successResponse('Despesa Deletada', 204);
    }
}
