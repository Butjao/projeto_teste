<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('usuario.index');
});

Route::get('/usuario/buscar-dados', [UsuarioController::class, 'searchData'])->name('usuario.buscar_dados');

Route::post('/usuario/adicionar-dados', [UsuarioController::class, 'addData'])->name('usuario.adicionar-dados');

Route::get('/usuario/excluir-dados', [UsuarioController::class, 'deleteData'])->name('usuario.excluir_dados');
