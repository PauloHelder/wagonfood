@extends('adminlte::page')
@section('title', 'Dashboard - Mostrar detalhe do  Plano')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('profiles.index')}}">Perfls</a></li>
    <li class="breadcrumb-item active"><a href="{{route('profiles.index',$profile->id)}}">{{$profile->name}}</a></li>
</ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Detalhe do Plano {{$profile->name}} </h3>
        </div>
        <div class="card-body">
           <ul>
            <li><strong>Nome: </strong> {{$profile->name}}</li>
            <li><strong>Descrição: </strong> {{$profile->description}}</li>
           </ul>
        </div>
        <div class="card-footer">
            <form action="{{route('profiles.destroy',[$profile->id])}}" method="post">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar Perfil {{$profile->name}} </button>
            </form>

        </div>
    </div>
@endsection