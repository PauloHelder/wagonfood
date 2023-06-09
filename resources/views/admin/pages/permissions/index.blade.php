@extends('adminlte::page')
@section('title', 'Dashboard - Lista de Permissões')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Permissões</a></li>
</ol>
    <h1>Permissões <a href="{{route('permissions.create')}}" class="btn btn-dark"><i class="fas fa-solid fa-plus"btn-danger></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('permissions.search')}}" method="POST" class="form form-inline">
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
                        <th>Nome</th>
                        <th width=200 >Acção</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            
                            <td>
                               {{-- <a href="{{route('details.permission.index', $permission->url)}}" class="btn btn-primary"><i class="fas fa-duotone fa-list"></i></a> --}} 
                                <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-success"><i class="fas fa-solid fa-pen"></i></a>
                                <a href="{{route('permissions.show', $permission->id)}}" class="btn btn-warning"><i class="fas fa-solid fa-eye"></i></a>
                                <a href="{{route('permissions.profiles', $permission->id)}}" class="btn btn-info"><i class="fas fa-solid fa-user"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $permissions->appends($filters)->links() !!}
            @else
            {!! $permissions->links() !!}
            @endif
            
        </div>
    </div>
@endsection