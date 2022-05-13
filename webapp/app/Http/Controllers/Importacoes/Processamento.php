<?php

namespace App\Http\Controllers\Importacoes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ImportarCSV as Request;

class Processamento extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $request->file('mycsv')->storeAs('csv', $request->file('mycsv')->getClientOriginalName());
            $csv = Storage::path("csv/" . $request->file('mycsv')->getClientOriginalName());

            $importacao = new \App\Services\CSV\ImportacaoVendas;
            $importacao->processar($csv);

            return redirect()->to('home')
                ->with('success', 'Você será informado quando o arquivo for processado')
                ->with('success-title', 'Upload realizado');
        } catch (\Exception $e) {

            //dd($e->getMessage());
            return redirect()->to('home')
                ->withErros([$e->getMessage()]);   
        }
    }
}
