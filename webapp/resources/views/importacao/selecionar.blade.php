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

            <form method="POST" action="{{route('importacao.enviar')}}" enctype="multipart/form-data">
                @csrf

                <div class="d-grid mb-3">

                    <button id="file-select" id="btn-send-csv" type="button" class="btn btn-outline-secondary py-5 d-flex flex-column align-items-center">
                        <i class="fa-solid fa-file-arrow-up fa-3x"></i>
                        <span id="btn-send-csv-label" class="py-2 px-3 rounded mt-3 bg-dark text-light">Selecionar arquivo</span>

                        <span class="mt-5">Clique para selecionar um arquivo</span>
                    </button>

                    <input type="file" name="mycsv" id="mycsv" accept="text/csv" class="d-none" onchange=read(this)>

                    <div id="file-selected" class="border border-secondary rounded py-5 d-flex flex-column justify-content-center align-items-center d-none">
                        <i class="fa-solid fa-file fa-3x"></i>

                        <div class="d-flex flex-column">
                            <h5 class="mt-3">Arquivo selecionado</h5>

                            <span id="file-selected-size" class="text-center">165 kb</span>
                        </div>
                        
                        <span class="mt-5">Clique novamente para selecionar outro arquivo</span>
                    </div>
                    

                </div>

                <div class="d-grid">
                    <button id="btn-submit" class="btn btn-dark py-3" disabled>INICIAR IMPORTAÇÃO</button>
                </div>
                
            </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const reader = new FileReader()

function read(input) {
    const csv = input.files[0]
    reader.readAsText(csv)
}

reader.onload = function (e) {
    var resSize = 'bytes'
    if (e.target.result.length > 1024) {
        resSize = 'kbytes'
    }

    console.log(e.target)

    document.getElementById('file-selected-size').innerHTML = e.target.result.length + ' ' + resSize
    document.getElementById('file-selected').classList.remove("d-none")
    document.getElementById('file-select').classList.add("d-none")
    document.getElementById('btn-submit').removeAttribute("disabled")
}

window.addEventListener('load', function() {
    document.getElementById('file-select').addEventListener('click', function() { document.getElementById('mycsv').click() })
    document.getElementById('file-selected').addEventListener('click', function() { document.getElementById('mycsv').click() })
})
</script>
@endsection