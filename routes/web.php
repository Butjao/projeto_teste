<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('usuario.index');
});

Route::get('/usuario/buscar-dados', [UsuarioController::class, 'searchData'])->name('usuario.buscar_dados');

Route::post('/usuario/adicionar-dados', [UsuarioController::class, 'addData'])->name('usuario.adicionar-dados');