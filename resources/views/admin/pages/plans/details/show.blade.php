@extends('adminlte::page')
@section('title', 'Dashboard - Mostrar detalhe do  Plano')

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
            <h3>Detalhe do Plano {{$plan->name}} </h3>
        </div>
        <div class="card-body">
           <ul>
            <li><strong>Nome: </strong> {{$detail->name}}</li>
           </ul>
        </div>
        <div class="card-footer">
            <form action="{{route('details.plan.destroy',[$plan->url,$detail->id])}}" method="post">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar detalhe {{$detail->name}} do Plano {{$plan->name}} </button>
            </form>

        </div>
    </div>
@endsection