<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', \App\Http\Controllers\Importacoes\Lista::class)->name('home');

Route::get('/importacao', function () {
    return view('importacao.selecionar');
})->name('importacao.selecionar');

Route::post('/importacao', \App\Http\Controllers\Importacoes\Processamento::class)->name('importacao.enviar');
