<?php

namespace App\Http\Controllers\Importacoes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ImportarCSV as Request;
use App\Events\ArquivoCSVRecebido;
use App\Exceptions\CSV\InterruptedImportingException;

class Processamento extends Controller
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
        try {
            $request->file('mycsv')->storeAs('csv', $request->file('mycsv')->getClientOriginalName());
            $csv = Storage::path("csv/" . $request->file('mycsv')->getClientOriginalName());

            if (\App\Services\CSV\ImportacaoVendas::verificarDuplicacao($csv)) {
                throw new InterruptedImportingException('O arquivo enviado já foi processado anteriormente');
            }

            event(new ArquivoCSVRecebido($csv, auth()->id()));

            return redirect()->to('home')
            ->with('success', 'Você será informado quando o arquivo for processado')
            ->with('success-title', 'Upload realizado');
        } catch (\Exception $e) {
            \Log::error('Problema ao receber o arquivo: ' . $e->getMessage());

            return redirect()->to('home')
            ->withErrors([$e->getMessage()]);   
        }
    }
}
