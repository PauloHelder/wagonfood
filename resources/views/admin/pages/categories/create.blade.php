@extends('adminlte::page')
@section('title', 'Dashboard - Criar Categoria')

@section('content_header')
    <h1>Cadastrar Categoria</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Nova Categoria</div>
        <div class="card-body">
            <form action="{{route('categories.store')}}" method="POST">
                @include('admin.pages.categories._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection