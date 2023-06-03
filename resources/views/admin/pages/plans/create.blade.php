@extends('adminlte::page')
@section('title', 'Dashboard - Lista Planos')

@section('content_header')
    <h1>Cadastrar Plano</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Criar novo Plano</div>
        <div class="card-body">
            <form action="{{route('plans.store')}}" method="POST">
                @csrf
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection