@extends('adminlte::page')
@section('title', 'Dashboard - Mostrar detalhe do  Plano')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Perfls</a></li>
    <li class="breadcrumb-item active"><a href="{{route('users.index',$user->id)}}">{{$user->name}}</a></li>
</ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Detalhe do Plano {{$user->name}} </h3>
        </div>
        <div class="card-body">
           <ul>
            <li><strong>Nome: </strong> {{$user->name}}</li>
            <li><strong>email: </strong> {{$user->email}}</li>
            <li><strong>Empresa: </strong> {{$user->tenant->name}}</li>
           </ul>
        </div>
        <div class="card-footer">
            <form action="{{route('users.destroy',[$user->id])}}" method="post">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar Perfil {{$user->name}} </button>
            </form>

        </div>
    </div>
@endsection