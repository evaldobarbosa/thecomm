@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex align-items-center">
            <h1 class="pt-2 flex-fill">{{ __('Importações') }}</h1>
            <a href="{{route('importacao.selecionar')}}" class="btn btn-outline-secondary btn-sm">{{ __('Novo') }}</a>
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
        
        @if(Session::has('errors') and $errors->any())
        <div class="alert alert-danger">
            <h3>Um erro aconteceu!</h3>
            {{-- Ajuste para mostrar todos os erros de uma vez --}}
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </div>
        @endif



        <div class="col-md-8 mt-4">
            <ul class="list-group">
                @forelse($lista as $item)
                <li class="list-group-item">
                    <h5 id="file-ttl-{{$item->id5()}}">{{$item->arquivo}}</h5>
                    <span id="file-desc-{{$item->id5()}}">Importado em {{$item->importado_em->format('d/m/Y H:i')}}</span><br>
                    <span id="file-qtd-{{$item->id5()}}">{{$item->vendas->count()}} registros</span>
                </li>
                @empty
                <li class="list-group-item">
                    Sem importações ainda
                </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
