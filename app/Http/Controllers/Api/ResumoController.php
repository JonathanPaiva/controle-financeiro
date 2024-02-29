<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use \App\Traits\HttpResponses;

class ResumoController extends Controller
{
    use HttpResponses;

    public function index(int $ano, int $mes)
    {
        dd("teste resumo - $ano - $mes");
    }
}
