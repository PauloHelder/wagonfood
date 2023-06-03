@extends('adminlte::page')
@section('title', 'Dashboard - Detalhes do Plano ')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.show',$plan->url)}}">{{$plan->name}}</a></li>
    <li class="breadcrumb-item active"><a href="#">Detalhes - {{$plan->name}}</a></li>
</ol>
    <h1>Planos <a href="{{route('plans.create')}}" class="btn btn-dark"><i class="fas fa-solid fa-plus"btn-danger></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">@include('admin.includes.alerts')</div>
        <div class="card-body">
            <Ul>
                <li><strong>ID: </strong>{{$plan->id}}</li>
                <li><strong>Nome:</strong>{{$plan->name}}</li>
                <li><strong>Preço</strong> Kz {{ number_format($plan->price,2, ',', '.')}}</li>
                <li><Strong>Descrição</strong>{{$plan->description}}</li>
            </Ul>
            
            <form action="{{route('plans.delete',$plan->url)}}" method="POST">
                @csrf @method('DELETE')
                <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i> Apagar</button>
            </form>
            
        </div>
           
    </div>
@endsection