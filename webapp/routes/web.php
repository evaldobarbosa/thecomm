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

Route::get('/importacao', function () {
    return view('importacao.selecionar');
})->name('importacao.selecionar');


/*
Route::post('/importacao', function (\Illuminate\Http\Request $request) {
    $file = $request->file('mycsv')->storeAs('csv', $request->file('mycsv')->getClientOriginalName());

    return redirect()->to('home')
        ->with('success', 'Você será informado quando o arquivo for processado')
        ->with('success-title', 'Upload realizado');
})->name('importacao.enviar');
*/


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/', \App\Http\Controllers\Importacoes\Lista::class);
Route::get('/home', \App\Http\Controllers\Importacoes\Lista::class)->name('home');
Route::post('/importacao', \App\Http\Controllers\Importacoes\Processamento::class)->name('importacao.enviar');
