@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex align-items-center">
            <h1 class="pt-2 flex-fill">{{ __('Importações') }}</h1>
            <a href="{{route('importacao.selecionar')}}" class="btn btn-outline-secondary btn-sm">Novo</a>
        </div>

        @if (session('success'))
        <div class="col-md-8">
            <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-start" role="alert">
                <div class="flex-fill">
                    <h5 id="success-title">{{ session('success-title') ?? 'Sucesso' }}</h5>
                    <span id="success-message">{{ session('success') }}</span>
                </div>

                <div class="bg-dark">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        @endif


        <div class="col-md-8 mt-4">
            <ul class="list-group">
                <li class="list-group-item">
                    <h5 id="file-ttl-0001">Arquivo XYZ</h5>
                    <span id="file-desc-0001">Importado em 10/02/2022 10:01</span>
                </li>
                <li class="list-group-item">
                    <h5 id="file-ttl-0002">Arquivo XYZ</h5>
                    <span id="file-desc-0002">Importado em 10/02/2022 10:01</span>
                </li>
                <li class="list-group-item">
                    <h5 id="file-ttl-0003">Arquivo XYZ</h5>
                    <span id="file-desc-0003">Importado em 10/02/2022 10:01</span>
                </li>
                <li class="list-group-item">
                    <h5 id="file-ttl-0004">Arquivo XYZ</h5>
                    <span id="file-desc-0004">Importado em 10/02/2022 10:01</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
