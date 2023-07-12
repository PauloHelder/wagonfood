@extends('adminlte::page')
@section('title', 'Dashboard - Mostrar detalhe do  Plano')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categorias</a></li>
    <li class="breadcrumb-item active"><a href="{{route('users.index',$table->id)}}">{{$table->name}}</a></li>
</ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Detalhe da MEsa {{$table->identify}} </h3>
        </div>
        <div class="card-body">
           <ul>
            <li><strong>Nome: </strong> {{$table->identify}}</li>
            <li><strong>Descrição: </strong> {{$table->desciption}}</li>
            <li><strong>Empresa: </strong> {{$table->tenant->name}}</li>
           </ul>
        </div>
        <div class="card-footer">
            <form action="{{route('tables.destroy',[$table->id])}}" method="post">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar Categoria {{$table->identify}} </button>
            </form>

        </div>
    </div>
@endsection