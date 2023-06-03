@extends('adminlte::page')
@section('title', 'Dashboard - Detalhes do Plano')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{route('plans.show',$plan->url)}}">{{$plan->name}}</a></li>
    <li class="breadcrumb-item avtive"><a href="{{route('details.plan.index',$plan->url)}}">{{$plan->name}}</a></li>
</ol>
    <h1>Detalhes de:  {{$plan->name}}. <a href="{{route('details.plan.create',$plan->url)}}" class="btn btn-dark"><i class="fas fa-solid fa-plus"btn-danger></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th width=120 >Acção</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{$detail->id}}</td>
                            <td>{{$detail->name}}</td>
                            <td>
                                <a href="{{route('details.plan.edit', [$plan->url,$detail->id])}}" class="btn btn-success"><i class="fas fa-solid fa-pen"></i></a>
                                <a href="{{route('details.plan.show', [$plan->url,$detail->id])}}" class="btn btn-warning"><i class="fas fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
            {!! $details->appends($filters)->links() !!}
            @else
            {!! $details->links() !!}
            @endif
            
        </div>
    </div>
@endsection