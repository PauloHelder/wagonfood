@extends('adminlte::page')
@section('title', 'Dashboard - Lista Permissões')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Produtos</a></li>
</ol>
    <h1>Categorias de: <strong>{{$product->title}}</strong>  <a href="{{route('products.categories.available',$product->id)}}" class="btn btn-dark">
        <i class="fas fa-solid fa-plus"></i></a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body">
            <table class="table">
                @include('admin.includes.alerts')
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th width=200 >Acção</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            
                            <td>
                                <a href="" class="btn btn-primary"><i class="fas fa-duotone fa-list"></i></a> 
                                <a href="{{route('products.categories.detach', [$product->id,$category->id])}}" class="btn btn-danger"><i class="fas fa-solid fa-trash"></i></a> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
             
            @if (isset($filters))
            {!! $categories->appends($filters)->links() !!}
            @else
            {!! $categories->links() !!}
            @endif
            
        </div>
        
    </div>
@endsection