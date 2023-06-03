@extends('adminlte::page')
@section('title', 'Dashboard - Lista Permissõess')

@section('content_header')
    <h1>Cadastrar Permissão</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Nova Permissão</div>
        <div class="card-body">
            <form action="{{route('permissions.store')}}" method="POST">
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection