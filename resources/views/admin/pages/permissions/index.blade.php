@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.index')}}">Permissões</a></li>
    </ol>

    <h1>Permissões <a href="{{ route('permissions.create')}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('plans.search')}}" method="POST" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                    <tr>
                        <td>
                            {{$permission->name}}
                        </td>
                        <td  style="width=10px">
                           {{-- <a href="{{ route('details.permission.index', $plan->url)}}" class="btn btn-primary">Detalhes</a> --}}
                            <a href="{{ route('permissions.edit', $permission->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{ route('permissions.show', $permission->id)}}" class="btn btn-warning">Ver</a>
                            <a href="{{ route('permissions.profiles', $permission->id)}}" class="btn btn-warning"><i class="fas fa-address-book"></i></a>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!!$permissions->appends($filters)->links() !!}   
            @else
               {!!$permissions->links()!!}
            @endif
        </div>
    </div>
@stop