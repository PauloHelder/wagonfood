@extends('adminlte::page')
@section('title', 'Dashboard - Lista Planos')

@section('content_header')
    <h1>Editar -  {{$plan->name}}</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">Dados do Plano </div>
        <div class="card-body">
            <form action="{{route('plans.update',$plan->url)}}" method="POST">
                @csrf @method('PUT')
               @include('admin.pages.plans._partials.form')
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection