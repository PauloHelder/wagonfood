@extends('adminlte::page')
@section('title', 'Dashboard - Mostrar detalhe da Permissão')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Permissões</a></li>
    <li class="breadcrumb-item active"><a href="{{route('permissions.index',$permission->id)}}">{{$permission->name}}</a></li>
</ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Detalhe da Permissão {{$permission->name}} </h3>
        </div>
        <div class="card-body">
           <ul>
            <li><strong>Nome: </strong> {{$permission->name}}</li>
            <li><strong>Descrição: </strong> {{$permission->description}}</li>
           </ul>
        </div>
        <div class="card-footer">
            <form action="{{route('permissions.destroy',[$permission->id])}}" method="post">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar Permissão {{$permission->name}} </button>
            </form>

        </div>
    </div>
@endsection