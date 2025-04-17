<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;

class UsuarioService
{
    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function getAllUsuarios()
    {
        return $this->usuarioRepository->getAll();
    }

    public function createUsuario(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->usuarioRepository->create($data);
    }
}