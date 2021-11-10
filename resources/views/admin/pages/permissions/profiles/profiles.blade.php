@extends('adminlte::page')

@section('title', "Perfis da permissão {$permission->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index')}}">Perfis</a></li>
    </ol>

    <h1>Perfis da permissão <strong> {{ $permission->name }}</strong></h1>
        
@stop

@section('content')
    <div class="card">
        {{--
        <div class="card-header">
            <form action="{{route('profiles.permissions.available', $profile->id)}}" method="POST" class="form form-inline">
                @csrf
                <div class="form-group">
                    <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div> --}}
        <div class="card-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th width="250">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $profile)
                    <tr>
                        <td>
                            {{$profile->name}}
                        </td>
                        <td  style="width=10px">
                           {{-- <a href="{{ route('details.permission.index', $plan->url)}}" class="btn btn-primary">Detalhes</a> --}}
                            <a href="{{ route('profiles.permission.detach', [$profile->id, $permission->id])}}" class="btn btn-danger">Desvincular</a>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
        </div> 
        <div class="card-footer">
            @if (isset($filters))
            {!!$profiles->appends($filters)->links() !!}   
            @else
               {!!$profiles->links()!!}
            @endif
        </div>
    </div>
@stop