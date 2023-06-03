@extends('adminlte::page')
@section('title', 'Dashboard - Lista Perfis Disponiveis')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Permissões</a></li>
</ol>
    <h1>Perfis de: <strong>{{$permission->name}}</strong>  
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('permissions.profiles.available',$permission->id)}}" method="POST" class="form form-inline">
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
                    <form action="{{route('permissions.profiles.attach',$permission->id)}}" method="post">
                       @csrf
                        @foreach ($profiles as $profile)
                            <tr>
                                <td>
                                    <input type="checkbox" name="profiles[]" value="{{$profile->id}}">
                                </td>
                                <td>{{$profile->id}}</td>
                                <td>{{$profile->name}}</td>
                                
                                
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
            {!! $profiles->appends($filters)->links() !!}
            @else
            {!! $profiles->links() !!}
            @endif
            
        </div>
    </div>
@endsection