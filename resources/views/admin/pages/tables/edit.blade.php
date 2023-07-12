@extends('adminlte::page')
@section('title', 'Dashboard - Editar Categoria')

@section('content_header')
    <h1>Editar Mesas</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Editar Categoria</div>
        <div class="card-body">
            <form action="{{route('tables.update',$table->id)}}" method="POST">
                @method('PUT')
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection