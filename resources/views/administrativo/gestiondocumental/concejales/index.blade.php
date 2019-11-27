@extends('layouts.dashboard')
@section('titulo')
    Concejales
@stop
@section('sidebar')
    <li> <a href="{{ asset('/dashboard/concejales/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i><span class="hide-menu">&nbsp; Agregar Concejales</span></a></li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Concejales</b></h4>
            </strong>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="card">
                <div class="card-title text-center">&nbsp;</div>
                <div class="card-body" style="background-color: white">
                    <div class="recent-meaasge">
                        @if(count($Concejales) > 0)
                            @foreach ($Concejales as $key => $data)
                                <div class="media">
                                    <div class="col-lg-2">
                                        <a  href="{{ asset('/dashboard/concejales/'.$data->id.'/edit') }}"><img src="{{ asset('img/concejales/'.$data->persona->num_dc.'.png')}}" class="fotoConcejal" ></a>
                                    </div>
                                    <div class="col-lg-10">
                                        <h4 class="media-heading nombreConcejal"><b>{{ $data->persona->nombre }}</b></h4>
                                        <p class="f-s-12 nConcejal">No C.C {{ $data->persona->num_dc }} </p>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @else
                            <div class="col-md-12 align-self-center">
                                <div class="alert alert-danger text-center">
                                    Actualmente no hay concejales almacenados.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@stop