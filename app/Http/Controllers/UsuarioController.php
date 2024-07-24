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
        return view('usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteData(Request $request)
    {
        Usuario::where('id', '=', $request->id)->delete();

        return response(0);
    }

    public function searchData(Request $request) {
        //funcao do ajax vai buscar os dados do model usuario e trazer de volta pro ajax para atualizar a listagem
        $data = Usuario::ObtemTodos($request->filtroTexto, $request->filtroData, $request->filtroSituacao);
       
        return view('usuario.listagem')
            ->with('data', $data);
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
