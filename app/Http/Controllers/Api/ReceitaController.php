<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Receita;
use App\Http\Requests\ReceitaRequest;
use App\Http\Resources\ReceitaResource;
use App\Services\ReceitaService;

class ReceitaController extends Controller
{

    public function __construct(protected ReceitaService $receitaService)
    {
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ReceitaRequest $receitaRequest)
    {
        $receitas = $this->receitaService->getAll();

        return ReceitaResource::collection($receitas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReceitaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $receita_id)
    {
        $receita = $this->receitaService->getById($receita_id);

        return new ReceitaResource($receita);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReceitaRequest $request, Receita $receita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receita $receita)
    {
        //
    }
}
