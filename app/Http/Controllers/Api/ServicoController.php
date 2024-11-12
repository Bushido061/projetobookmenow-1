<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;

class ServicoController extends Controller
{
    public function index()
    {
        $servicos = Servico::all();
        try {
            return response()->json([$servicos, 200]);
        } catch(Exception $e) {
            return request()->json(['Erro' => "Erro ao listar os dados", 500]);
        }   
    }

    public function show(string $id)
    {
        try {
            $servico = Servico::findOrFail($id);
            return response()->json($servico, 200);
        } catch(Exception $e) {
            return request()->json(['Erro' => "Erro ao listar os dados", 400]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'=> 'required|string|max:100',
            'descricao'=> 'required',
            'valor'=> 'required|numeric',
            'celular'=> 'required|string|max:20',
            'endereco'=> 'required',
            'numero'=> 'required',
            'bairro'=> 'required',
            'cidade'=>'required',
            'estado'=> 'required',
            'cep'=> 'required',
            'usuario_id'=> 'required',
            'categoria_id'=> 'required'

        ]);

        try {

            $servico = Servico::create($request->all());

            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    $caminhoFoto = $file->store('fotos','public');
                    Foto::create([
                        'servico_id'=> $servico->id,
                        'imagem'=> $caminhoFoto
                    ]);
                }
            }

            return response()->json($servico, 201);

        }catch (Exception $e) {
            return request()->json(["'ERRO" => "Erro ao listar os dados", 500]);
        }
    
    }
}
