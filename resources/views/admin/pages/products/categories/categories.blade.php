@extends('adminlte::page')

@section('title', "Categorias do Produto {$product->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index')}}">productos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.categories', $product->id) }}">Perfis</a></li>
    </ol>

    <h1>Categorias do Produto <strong> {{ $product->title }}</strong></h1>
        
    <a href="{{ route('products.categories.available', $product->id)}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD Nova Categoria</a>
@stop

@section('content')
    <div class="card">
        {{--
        <div class="card-header">
            <form action="{{route('categories.categories.available', $category->id)}}" method="POST" class="form form-inline">
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
                        @foreach ($categories as $category)
                    <tr>
                        <td>
                            {{$category->name}}
                        </td>
                        <td  style="width=10px">
                           {{-- <a href="{{ route('details.category.index', $product->url)}}" class="btn btn-primary">Detalhes</a> --}}
                            <a href="{{ route('products.category.detach', [$category->id, $category->id])}}" class="btn btn-danger">Desvincular</a>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!!$categories->appends($filters)->links() !!}   
            @else
               {!!$categories->links()!!}
            @endif
        </div>
    </div>
@stop