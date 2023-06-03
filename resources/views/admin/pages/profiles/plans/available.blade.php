@extends('adminlte::page')
@section('title', 'Dashboard - Lista Perfis Disponiveis')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('profiles.index')}}">Perfis</a></li>
</ol>
    <h1>Perfis de: <strong>{{$profile->name}}</strong>  
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('profiles.plans.available',$profile->id)}}" method="POST" class="form form-inline">
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
                    <form action="{{route('profiles.plans.attach',$profile->id)}}" method="post">
                       @csrf
                        @foreach ($plans as $plan)
                            <tr>
                                <td>
                                    <input type="checkbox" name="plans[]" value="{{$plan->id}}">
                                </td>
                                <td>{{$plan->id}}</td>
                                <td>{{$plan->name}}</td>
                                
                                
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="50">
                                <button type="submit" class="btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $plans->appends($filters)->links() !!}
            @else
            {!! $plans->links() !!}
            @endif
            
        </div>
    </div>
@endsection