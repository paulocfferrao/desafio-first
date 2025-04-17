<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    protected $model;

    public function __construct(Usuario $usuario)
    {
        $this->model = $usuario;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}