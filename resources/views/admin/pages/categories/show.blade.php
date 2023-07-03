@extends('adminlte::page')
@section('title', 'Dashboard - Mostrar detalhe do  Plano')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categorias</a></li>
    <li class="breadcrumb-item active"><a href="{{route('users.index',$category->id)}}">{{$category->name}}</a></li>
</ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Detalhe da categoria {{$category->name}} </h3>
        </div>
        <div class="card-body">
           <ul>
            <li><strong>Nome: </strong> {{$category->name}}</li>
            <li><strong>Descrição: </strong> {{$category->description}}</li>
            <li><strong>Empresa: </strong> {{$category->tenant->name}}</li>
           </ul>
        </div>
        <div class="card-footer">
            <form action="{{route('categories.destroy',[$category->url])}}" method="post">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar Categoria {{$category->name}} </button>
            </form>

        </div>
    </div>
@endsection