<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        try {
            return response()->json([$usuarios, 200]);
        } catch(Exception $e) {
            return request()->json(['Erro' => "Erro ao listar os dados", 500]);
        }   
    }

    public function show(string $id)
    {
        try {
            $usuario = User::findOrFail($id);
            return response()->json($usuario, 200);
        } catch(Exception $e) {
            return request()->json(['Erro' => "Erro ao listar os dados", 400]);
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required',
            'email' => 'required|string|email|unique:usuarios',
            'password' => 'required|min:8|confirmed'
        ]);

        try {

        

        $data = [
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password): $usuario->password
        ];

        $usuario = User::create($data);

        return response()->json($usuario, 201);

        }catch (Exception $e) {
            return request()->json(["'ERRO" => "Erro ao listar os dados", 500]);
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|string|email|unique:usuarios',
            'password' => 'required|min:8|confirmed'
        ]);

        try {

            $usuario = User::findOrFail($id);

            $data = [
                'nome' => $request->nome,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password): $usuario->password
            ];

            $usuario->update($data);

            return response()->json($usuario, 200);

        }catch (Exception $e) {
            return request()->json(["'ERRO" => "Erro ao listar os dados", 500]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $usuario = User::findOrFail($id);
            $usuario->delete();
            return response()->json(["message" => "Categoria deletada com sucesso", 200]);
        } catch (Exception $e) {

            return response()->json(["error" => "Erro ao deletar categoria", 200]);
        }
    }
}