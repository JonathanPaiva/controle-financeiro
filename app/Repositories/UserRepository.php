<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function __construct(protected User $model)
    {

    }

    public function paginate()
    {
        return $this->model->paginate();
    }

    public function all(array $filtros = []) : Collection|null
    {
        if (count($filtros)) {
            $users = $this->model->query();

            foreach ($filtros as $key => $value) {
                $usersFiltrados = $users->where($key, 'LIKE', "%$value%")->get();
            }

            return $usersFiltrados->sortByDesc('name');
        }

        $users = $this->model->all()->sortByDesc('name');

        return $users;
    }

    public function find(int $user_id) : User|null
    {
        $user = $this->model->find($user_id);

        return $user;
    }

    public function create(array $requestValidated) : User
    {
        return $this->model->create($requestValidated);
    }
}
