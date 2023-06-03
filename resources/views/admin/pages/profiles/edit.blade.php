@extends('adminlte::page')
@section('title', 'Dashboard - Edtiar Perfil')

@section('content_header')
    <h1>Editar Perfil</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Esditar Perfil</div>
        <div class="card-body">
            <form action="{{route('profiles.update',$profile->id)}}" method="POST">
                @method('PUT')
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection