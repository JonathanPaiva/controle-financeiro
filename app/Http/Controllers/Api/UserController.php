<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HttpResponses;

    public function __construct(protected UserService $userService)
    {
    }

    public function index(Request $request)
    {
        $users = $this->userService->getAll($request);

        $usersJson = UserResource::collection($users);

        return $this->successResponse('Sucesso',200,$usersJson);
    }

    public function store(UserRequest $userRequest)
    {
        $user = $this->userService->create($userRequest);

        $user = $this->userService->getById($user->id);

        $usersJson = new UserResource($user);

        return $this->successResponse('Usuário criado', 201, $usersJson);
    }

    public function show(int $user_id)
    {
        $user = $this->userService->getById($user_id);

        if (!$user) {
            return $this->errorResponse('Usuário não encontrado', 404);
        }

        $userJson = new UserResource($user);

        return $this->successResponse('Usuário encontrado', 200, $userJson);
    }

    public function update(UserRequest $userRequest, int $user_id)
    {
        if ($user_id <> $userRequest->id) {
            return $this->errorResponse('Usuário com parâmetros incorretos', 406);
        }

        $user = $this->userService->update($userRequest, $user_id);

        $userJson = new UserResource($user);

        return $this->successResponse('Usuário alterado', 200, $userJson );
    }

    public function destroy(string $user_id)
    {
        $userDeletado = $this->userService->delete($user_id);

        if (!$userDeletado) {
            return $this->errorResponse('Usuário não encontrado', 404);
        }

        return $this->successResponse('Usuário Deletado', 204);
    }
}
