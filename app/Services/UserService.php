<?php

namespace App\Services;

use App\Http\Requests\ReceitaRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\ReceitaRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserService
{

    public function __construct(protected UserRepository $userRepository)
    {

    }

    public function getAll(Request $request)
    {
        $users = $this->userRepository->all($request->all());

        return $users;
    }

    public function getById(int $user_id)
    {
        $user = $this->userRepository->find($user_id);

        return $user;
    }

    public function create(UserRequest $userRequest)
    {
        return $this->userRepository->create($userRequest->validated());
    }

    public function update(UserRequest $userRequest, int $user_id)
    {
        $user = $this->getById($user_id);

        if (!$user){
            return null;
        }

        $user->update($userRequest->validated());

        return $user;
    }

    public function delete(int $user_id) : bool
    {
        $user = $this->getById($user_id);

        if (!$user) {
            return false;
        }

        $user->delete();

        return true;
    }
}
