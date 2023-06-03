@extends('adminlte::page')
@section('title', 'Dashboard - Editar  Plano')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.show',$plan->url)}}">{{$plan->name}}</a></li>
    <li class="breadcrumb-item avtive"><a href="{{route('details.plan.index',$plan->url)}}">{{$plan->name}}</a></li>
</ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Editar detalhe</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('details.plan.update', [$plan->url,$detail->id]) }}" method="POST">
                @method('PUT')
                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
@endsection