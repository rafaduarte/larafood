@extends('adminlte::page')

@section('title', "Perfis do plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index')}}">Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.profiles', $plan->id) }}">Perfis</a></li>
    </ol>

    <h1>Perfis do plano <strong> {{ $plan->name }}</strong></h1>
        
    <a href="{{ route('plans.profiles.available', $plan->id)}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD Novo Perfil</a>
@stop

@section('content')
    <div class="card">
        {{--
        <div class="card-header">
            <form action="{{route('profiles.profiles.available', $profile->id)}}" method="POST" class="form form-inline">
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
                           {{-- <a href="{{ route('details.profile.index', $plan->url)}}" class="btn btn-primary">Detalhes</a> --}}
                            <a href="{{ route('plans.profile.detach', [$profile->id, $profile->id])}}" class="btn btn-danger">Desvincular</a>
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