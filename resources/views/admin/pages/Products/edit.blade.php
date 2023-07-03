@extends('adminlte::page')
@section('title', 'Dashboard - Editar Categoria')

@section('content_header')
    <h1>Editar Produtos</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Editar Categoria</div>
        <div class="card-body">
            <form action="{{route('products.update',$product->uuid)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.pages.products._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection