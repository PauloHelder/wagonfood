@extends('adminlte::page')
@section('title', 'Dashboard - Lista Planos')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
</ol>
    <h1>Planos <a href="{{route('plans.create')}}" class="btn btn-dark"><i class="fas fa-solid fa-plus"btn-danger></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('plans.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ?? ''}}">
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
                        <th>Preço</th>
                        <th>Descrição</th>
                        <th>Detalhes</th>
                        <th width=210 >Acção</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{$plan->id}}</td>
                            <td>{{$plan->name}}</td>
                            <td>{{number_format($plan->price,2,',','.')}}</td>
                            <td>{{$plan->description}}</td>
                            <td>{{$plan->details->count()}}</td>
                            <td>
                                <a href="{{route('details.plan.index', $plan->url)}}" class="btn btn-primary"><i class="fas fa-duotone fa-list"></i></a>
                                <a href="{{route('plans.edit', $plan->url)}}" class="btn btn-success"><i class="fas fa-solid fa-pen"></i></a>
                                <a href="{{route('plans.show', $plan->url)}}" class="btn btn-warning"><i class="fas fa-solid fa-eye"></i></a>
                                <a href="{{route('plans.profiles', $plan->id)}}" class="btn btn-info"><i class="fas fa-solid fa-user"></i></a>
                            </td>
                        </tr>
                    @endforeach
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