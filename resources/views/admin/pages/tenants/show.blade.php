@extends('adminlte::page')

@section('title', "Detalhes do Tenant {$tenant->title}")

@section('content_header')
    <h1>Detalhes do Tenant <b>{{ $tenant->title }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <img src="{{ url("storage/{$tenant->logo}")}}" alt="{{ $tenant->title}}" style="max-width: 90px;">
            <ul>
                <li>
                    <strong>Plano:</strong> {{$tenant->plan->name}}
                </li>
                <li>
                    <strong>Nome:</strong> {{$tenant->name}}
                </li>
                <li>
                    <strong>URL:</strong> {{$tenant->url}}
                </li>
                <li>
                    <strong>E-mail:</strong> {{$tenant->email}}
                </li>
                <li>
                    <strong>CNPJ:</strong> {{$tenant->cnpj}}
                </li>
                <li>
                    <strong>Ativo:</strong> {{$tenant->active ==  'Y' ? 'SIM' : 'NÂO'}}
                </li>
            </ul>

            <hr>
            <h3>Assinatura</h3>
            <ul>
                <li>
                    <strong>Data da Assinatura:</strong> {{$tenant->subscription}}
                </li>
                <li>
                    <strong>Data de Expirar:</strong> {{$tenant->expires_at}}
                </li>
                <li>
                    <strong>Identificador:</strong> {{$tenant->subscription_id}}
                </li>
                <li>
                    <strong>Ativo:</strong> {{$tenant->subscription_active ? 'SIM' : 'NÃO' }}
                </li>
                <li>
                    <strong>Cancelou?:</strong> {{$tenant->subscription_suspended ? 'SIM' : 'NÃO' }}
                </li>
            </ul>

            @include('admin.includes.alerts')
            <form action="{{ route('tenants.destroy', $tenant->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o Tenant {{ $tenant->title }}</button>
            </form>
        </div>
    </div>
        @endsection