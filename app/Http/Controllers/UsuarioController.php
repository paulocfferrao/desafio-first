<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioStoreRequest;
use App\Services\UsuarioService;
use Illuminate\Http\JsonResponse;

class UsuarioController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index()
    {
        $usuarios = $this->usuarioService->getAllUsuarios();
        return view('usuario.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuario.create');
    }

    public function store(UsuarioStoreRequest $request)
    {
        try {
            $user = $this->usuarioService->createUsuario($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Usuário cadastrado com sucesso!',
                'data' => $user
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar usuário: ' . $e->getMessage()
            ], 500);
        }
    }
}