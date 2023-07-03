@extends('adminlte::page')
@section('title', 'Dashboard - Editar User')

@section('content_header')
    <h1>Editar User</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Editar User</div>
        <div class="card-body">
            <form action="{{route('users.update',$user->id)}}" method="POST">
                @method('PUT')
                @include('admin.pages.users._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection