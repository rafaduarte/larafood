@extends('adminlte::page')

@section('title', 'Tenants')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tenants.index')}}">Tenants</a></li>
    </ol>

    <h1>Tenants <a href="{{ route('tenants.create')}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tenants.search')}}" method="POST" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" placeholder="Filtrar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
z                            <th width="270">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tenants as $tenant)
                    <tr>
                        <td>
                            <img src="{{ url("storage/{$tenant->image}")}}" alt="{{ $tenant->title}}" style="max-width: 90px;">
                        </td>
                        <td>{{$tenant->title}}</td>
                        <td  style="width=10px">
                            <a href="{{ route('tenants.edit', $tenant->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{ route('tenants.show', $tenant->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $tenants->appends($filters)->links() !!}   
            @else
               {!!$tenants->links() !!}
            @endif
        </div>
    </div>
@stop