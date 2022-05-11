@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex align-items-start">
            <div class="pt-2 flex-fill">
                <h1>{{ __('Importar vendas') }}</h1>
                <p>Escolha o arquivo com os dados das vendas do período</p>
            </div>
            <a href="/" class="btn btn-outline-secondary btn-sm mt-2">Voltar</a>
        </div>

        <div class="col-md-8 mt-4">

            <form method="POST" action="{{route('importacao.enviar')}}">

                <div class="d-grid mb-3">

                    <button type="button" class="btn btn-outline-secondary py-5 d-flex flex-column align-items-center">
                        <i class="fa-solid fa-file-arrow-up fa-3x"></i>
                        <span class="py-2 px-3 rounded mt-3 bg-dark text-light">Selecionar arquivo</span>
                    </button>

                    <input type="file" name="mycsv" id="mycsv" accept="text/csv" class="invisible">

                    <div class="border border-secondary rounded py-5 d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-file fa-3x"></i>

                        <div class="d-flex flex-column">
                            <h5 class="mt-3">Arquivo selecionado</h5>

                            <span>Nome_do_arquivo.csv</span>
                            <span>165 kb</span>
                        </div>
                    </div>
                    

                </div>

                <div class="d-grid">
                    <button class="btn btn-dark py-3">INICIAR IMPORTAÇÃO</button>
                </div>
                
            </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- https://www.javascripttutorial.net/web-apis/javascript-filereader/ -->
@endsection