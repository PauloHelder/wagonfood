@extends('adminlte::page')
@section('title', 'Dashboard - Editar Categoria')

@section('content_header')
    <h1>Editar Categoria</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Editar Categoria</div>
        <div class="card-body">
            <form action="{{route('categories.update',$category->url)}}" method="POST">
                @method('PUT')
                @include('admin.pages.categories._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection