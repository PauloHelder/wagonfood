@extends('adminlte::page')
@section('title', 'Dashboard - Lista Planos')

@section('content_header')
    <h1>Cadastrar Perfil</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Novo Perfil</div>
        <div class="card-body">
            <form action="{{route('profiles.store')}}" method="POST">
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection