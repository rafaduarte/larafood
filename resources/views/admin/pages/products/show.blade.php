@extends('adminlte::page')

@section('title', "Detalhes da produto {$product->title}")

@section('content_header')
    <h1>Detalhes do produto <b>{{ $product->title }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Título:</strong> {{$product->image}}
                </li>
                <li>
                    <strong>Flag:</strong> {{$product->title}}
                </li>
                <li>
                    <strong>Descrição:</strong> {{$product->description}}
                </li>
            </ul>
            @include('admin.includes.alerts')
            <form action="{{ route('categories.destroy', $product->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar a produto {{ $product->title }}</button>
            </form>
        </div>
    </div>
        @endsection