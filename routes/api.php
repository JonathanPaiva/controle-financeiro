<?php

use App\Http\Controllers\Api\DespesaController;
use App\Http\Controllers\Api\ReceitaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::apiResource('/receitas', ReceitaController::class);
Route::get('/receitas',[ReceitaController::class,'index']);
Route::post('/receitas',[ReceitaController::class,'store']);
Route::get('/receitas/{id}',[ReceitaController::class,'show']);
Route::put('/receitas/{id}',[ReceitaController::class,'store']);
Route::delete('/receitas/{id}', [ReceitaController::class,'destroy']);

//Route::apiResource('/despesas', DespesaController::class);
Route::get('/despesas',[DespesaController::class,'index']);
Route::post('/despesas',[DespesaController::class,'store']);
Route::get('/despesas/{id}',[DespesaController::class,'show']);
Route::put('/despesas/{id}',[DespesaController::class,'store']);
Route::delete('/despesas/{id}', [DespesaController::class,'destroy']);