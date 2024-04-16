<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    //-> 2|J8sltRFW6rXSQU2Vh4Vze83ruii5GmQUzeLxuzJt68090df2

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))){

            $token = $request->user()->createToken('validated');

            return $this->successResponse('Autorizado', 200, [
                'token' => $token->plainTextToken
            ]);
        }

        return $this->errorResponse('Não Autorizado', 403);
    }

    public function logout()
    {

    }
}
