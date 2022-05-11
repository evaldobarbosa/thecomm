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
                    <h5>{{ session('success-title') ?? 'Upload realizado' }}</h5>
                    {{ session('success') ?? 'Você será informado quando o arquivo for processado' }}
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
                    <h5>Arquivo XYZ</h5>
                    <span>10-02-2022 10:00</span>
                </li>
                <li class="list-group-item">
                    <h5>Arquivo XYZ</h5>
                    <span>10-02-2022 10:00</span>
                </li>
                <li class="list-group-item">
                    <h5>Arquivo XYZ</h5>
                    <span>10-02-2022 10:00</span>
                </li>
                <li class="list-group-item">
                    <h5>Arquivo XYZ</h5>
                    <span>10-02-2022 10:00</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
