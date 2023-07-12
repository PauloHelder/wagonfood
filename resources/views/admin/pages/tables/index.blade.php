@extends('adminlte::page')
@section('title', 'Dashboard - Lista de Categorias')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('tables.index')}}">Mesa</a></li>
</ol>
    <h1>Mesas  <a href="{{route('tables.create')}}" class="btn btn-dark">
        <i class="fas fa-solid fa-plus"></i></a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('tables.search')}}" method="POST" class="form form-inline">
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
                        <th>Identify</th>
                        <th width=210 >Acção</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tables as $table)
                        <tr>
                            <td>{{$table->id}}</td>
                            <td>{{$table->identify}}</td>                            
                            <td>
                               {{-- <a href="{{route('details.profile.index', $profile->url)}}" class="btn btn-primary"><i class="fas fa-duotone fa-list"></i></a> --}} 
                                <a href="{{route('tables.edit', $table->id)}}" class="btn btn-success"><i class="fas fa-solid fa-pen"></i></a>
                                <a href="{{route('tables.show', $table->id)}}" class="btn btn-warning"><i class="fas fa-solid fa-eye"></i></a>
                                {{-- <a href="{{route('users.permissions', $user->id)}}" class="btn btn-primary"><i class="fas fa-solid fa-lock"></i></a>
                                <a href="{{route('users.plans', $user->id)}}" class="btn btn-info"><i class="fas fa-solid fa-list"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      
        <div class="card-footer">
            @if (isset($filters))
            {!! $tables->appends($filters)->links() !!}
            @else
            {!! $tables->links() !!}
            @endif
            
        </div>
    </div>
@endsection