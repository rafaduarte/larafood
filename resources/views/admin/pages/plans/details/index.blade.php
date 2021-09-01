@extends('adminlte::page')

@section('title', "Detalhes do plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index')}}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.index', $plan->url)}}" class="active">Detalhes</a></li>
    </ol>

    <h1>Criar novo Detalhe do Plano {{ $plan->name }} <a href="{{ route('details.plan.create', $plan->url )}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
        <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                    <tr>
                        <td>
                            {{$detail->name}}
                        </td>
                        <td  style="width=10px">
                            <a href="{{ route('plans.edit', $plan->url)}}" class="">Edit</a>
                            <a href="{{ route('plans.show', $plan->url)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
              </table>
        </div>
    </div>
@stop