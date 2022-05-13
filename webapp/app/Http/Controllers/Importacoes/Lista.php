<?php

namespace App\Http\Controllers\Importacoes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Lista extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $lista = \App\Models\Importacao::orderBy('id', 'desc')->paginate();
        
        return view('home')->with('lista', $lista);
    }
}
