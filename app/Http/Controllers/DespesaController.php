<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Http\Requests\StoreDespesaRequest;
use App\Http\Requests\UpdateDespesaRequest;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDespesaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Despesa $despesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Despesa $despesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDespesaRequest $request, Despesa $despesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Despesa $despesa)
    {
        //
    }
}
