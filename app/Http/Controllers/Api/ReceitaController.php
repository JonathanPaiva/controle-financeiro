<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceitaRequest;
use App\Http\Resources\ReceitaResource;
use App\Services\ReceitaService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{

    use HttpResponses;

    public function __construct(protected ReceitaService $receitaService)
    {
        
    }

    public function index(Request $request)
    {
        $receitas = $this->receitaService->getAll($request);

        $receitasJson = ReceitaResource::collection($receitas);
        
        return $this->successResponse('Sucesso',200,$receitasJson);
    }

    public function store(ReceitaRequest $receitaRequest, int $receita_id = 0)
    {

        if ($receita_id) {
            
            if ($receita_id <> $receitaRequest->id) {
                return $this->errorResponse('Receita com parâmetros incorretos', 406);
            }

            $receita = $this->receitaService->update($receitaRequest, $receita_id);

            $receitaJson = new ReceitaResource($receita);

            return $this->successResponse('Receita alterada', 200, $receitaJson );
        }

        $receita = $this->receitaService->create($receitaRequest);

        $receita = $this->receitaService->getById($receita->id);

        $receitaJson = new ReceitaResource($receita);

        return $this->successResponse('Receita criada', 201, $receitaJson);
    }

    public function show(int $receita_id)
    {
        $receita = $this->receitaService->getById($receita_id);

        if (!$receita) {
            return $this->errorResponse('Receita não encontrada', 404);
        }

        $receitaJson = new ReceitaResource($receita);

        return $this->successResponse('Receita encontrada', 200, $receitaJson);
    }

    public function destroy(int $receita_id)
    {
        $receitaDeletada = $this->receitaService->delete($receita_id);

        if (!$receitaDeletada) {
            return $this->errorResponse('Receita não encontrada', 404);
        }

        return $this->successResponse('Receita Deletada', 204);
    }

    public function receitaMensal(int $ano, int $mes)
    {
        if (!$mes>0 & !$mes<=12) {
            return $this->errorResponse('Receita com parâmetros incorretos', 406);
        }

        $receitasMensal = $this->receitaService->receitaMensal($ano, $mes);

        if (!$receitasMensal) {
            return $this->errorResponse('Receitas não encontradas', 404);
        }

        $receitasMensalJson = ReceitaResource::collection($receitasMensal);

        return $this->successResponse('Sucesso', 200, $receitasMensalJson);
    }
}
