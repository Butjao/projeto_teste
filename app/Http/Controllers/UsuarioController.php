<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arrSituacao = [0 => 'Inativo', 1 => 'Ativo'];

        return view('usuario.index')
            ->with('arrSituacao', $arrSituacao);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        Usuario::where('id', '=', $usuario->id)->delete();

        return response(0);
    }

    public function searchData() {

        //funcao do ajax vai buscar os dados do model usuario e trazer de volta pro ajax para atualizar a listagem
        $dados = Usuario::ObtemTodos();
        return view('usuario.listagem')
            ->with('dados', $dados);
    }

    public function addData(Request $request) {

        $usuario = new Usuario();
        $usuario->nome        = $request->nm_usuario;
        $usuario->email       = $request->email_usuario;
        $usuario->id_situacao = $request->id_situacao;
        $usuario->dt_admissao = $request->dt_admicao;
        $usuario->save();

        return response(0);
    }
}
