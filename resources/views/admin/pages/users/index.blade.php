@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Usuários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('users.index')}}">Planos</a></li>
    </ol>

    <h1>Usuários <a href="{{ route('users.create')}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('users.search')}}" method="POST" class="form form-inline">
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
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th width="270">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                    <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td  style="width=10px">
                            <a href="{{ route('users.edit', $user->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{ route('users.show', $user->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $users->appends($filters)->links() !!}   
            @else
               {!!$users->links() !!}
            @endif
        </div>
    </div>
@stop