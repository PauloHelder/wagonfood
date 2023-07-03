@extends('adminlte::page')
@section('title', 'Dashboard - Criar Categoria')

@section('content_header')
    <h1>Cadastrar Produto</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Novo Produto</div>
        <div class="card-body">
            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                @include('admin.pages.products._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection