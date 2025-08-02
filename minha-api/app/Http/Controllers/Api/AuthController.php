<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function googleRegister(Request $request)
    {
        // Validação
        $data = $request->validate([
            'cpf' => 'required|string|unique:users,cpf',
            'nome_completo' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'telefone' => 'required|string|max:20',
            'codigo_telefone' => 'required|string|max:10',
            'oauth_token' => 'required|string',
        ]);

        // Salvar no banco
        $user = User::create($data);

        // Retornar resposta simulando criação de sessão
        return response()->json([
            'session_token' => Str::random(60),
            'expires_at' => now()->addHours(1)->timestamp,
        ]);
    }
}
