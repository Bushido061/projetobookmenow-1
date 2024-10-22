<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
 
class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        try {
            return reponse()->json([$categorias, 200]);
        } catch(Exception $e) {
            return request()->json(['Erro' => "Erro ao listar os dados", 500]);
        }  
    }
 
    public function show(string $id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
            return response()->json($categoria, 200);
        } catch(Exception $e) {
            return request()->json(['Erro' => "Erro ao listar os dados", 400]);
        }
    }
}
 