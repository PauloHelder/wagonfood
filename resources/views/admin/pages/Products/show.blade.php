@extends('adminlte::page')
@section('title', 'Dashboard - Mostrar detalhe do  Plano')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Produtos</a></li>
    <li class="breadcrumb-item active"><a href="{{route('users.index')}}">{{$product->title}}</a></li>
</ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Detalhe da categoria {{$product->title}} </h3>
        </div>
        <div class="card-body">
           <ul>
            <li><strong>id: </strong> {{$product->id}}</li>
            <li><strong>image: </strong><img width="70" src="{{url("storage/$product->image")}}" alt="{{$product->title}}" /></li>
            <li><strong>Title: </strong> {{$product->title}}</li>
            <li><strong>Price: </strong> {{$product->price}}</li>
            <li><strong>uuid: </strong> {{$product->uuid}}</li>
            <li><strong>Descrição: </strong> {{$product->description}}</li>
            <li><strong>Empresa: </strong> {{$product->tenant->name}}</li>
           </ul>
        </div>
        <div class="card-footer">
            <form action="{{route('products.destroy',[$product->uuid])}}" method="post">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar Categoria {{$product->title}} </button>
            </form>

        </div>
    </div>
@endsection