@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index')}}">Produtos</a></li>
    </ol>

    <h1>Produtos <a href="{{ route('products.create')}}" class="btn btn-dark"><i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('products.search')}}" method="POST" class="form form-inline">
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
                            <th>Título</th>
z                            <th width="270">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                    <tr>
                        <td>{{$product->Image}}</td>
                        <td>{{$product->title}}</td>
                        <td  style="width=10px">
                            <a href="{{ route('products.edit', $product->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{ route('products.show', $product->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $products->appends($filters)->links() !!}   
            @else
               {!!$products->links() !!}
            @endif
        </div>
    </div>
@stop