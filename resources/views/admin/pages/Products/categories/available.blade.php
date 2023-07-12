@extends('adminlte::page')
@section('title', 'Dashboard - Lista Perfis Disponiveis')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Produtos</a></li>
</ol>
    <h1>Categorias do: <strong>{{$product->title}}</strong>  
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('products.categories.available',$product->id)}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtros" class="form-control" value="{{$filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-info"> Pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table">
                @include('admin.includes.alerts')
                <thead>
                    <tr>
                        <th>#</th>
                        <th>id</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{route('products.categories.attach',$product->id)}}" method="post">
                       @csrf
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <input type="checkbox" name="categories[]" value="{{$category->id}}">
                                </td>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                
                                
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="50">
                                <button type="submit" class="btn btn-default">Vincular</button>
                            </td>
                        </tr>
                    </form>
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