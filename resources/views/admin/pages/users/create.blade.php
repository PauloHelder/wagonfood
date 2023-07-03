@extends('adminlte::page')
@section('title', 'Dashboard - Crir User')

@section('content_header')
    <h1>Cadastrar User</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Novo User</div>
        <div class="card-body">
            <form action="{{route('users.store')}}" method="POST">
                @include('admin.pages.users._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection