@extends('layouts.dashboard')
@section('titulo')
    {{ $comision }}
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>{{ $comision }}</b></h4>
            </strong>
        </div>
    </div>
    @if($id == 1)
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Objetivo</h2>
            <p>
                Aprobar todos los proyectos de planeación
            </p>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-title text-center">
                    <h3>Concejales</h3>
                    <br>
                </div>
                <div class="card-body">
                    <div class="recent-meaasge">
                        <div class="media">
                            <div class="col-lg-2">
                                <a href="#"><img src="{{ asset('img/user.png')}}" class="card-img-top" width="100%"></a>
                            </div>
                            <div class="col-lg-10">
                                <h4 class="media-heading">john doe</h4>
                                <div class="meaasge-date">15 minutes Ago</div>
                                <p class="f-s-12">We are happy about your service </p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="col-lg-2">
                                <a href="#"><img src="{{ asset('img/user.png')}}" class="card-img-top" width="100%"></a>
                            </div>
                            <div class="col-lg-10">
                                <h4 class="media-heading">john doe</h4>
                                <div class="meaasge-date">15 minutes Ago</div>
                                <p class="f-s-12">We are happy about your service </p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="col-lg-2">
                                <a href="#"><img src="{{ asset('img/user.png')}}" class="card-img-top" width="100%"></a>
                            </div>
                            <div class="col-lg-10">
                                <h4 class="media-heading">john doe</h4>
                                <div class="meaasge-date">15 minutes Ago</div>
                                <p class="f-s-12">We are happy about your service </p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-title text-center">
                    <h3>Proyectos de Acuerdo</h3>
                    <br>
                </div>
                <div class="card-body">
                    <div class="recent-meaasge">
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading">Proyecto 1</h4>
                                <div class="meaasge-date">San Andres y Providencia</div>
                                <p class="f-s-12">Compra de Terrenos </p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading">Proyecto 2</h4>
                                <div class="meaasge-date">San Andres y Providencia</div>
                                <p class="f-s-12">Reparación de Luminarias </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif($id == 2)
    @elseif($id == 3)
    @elseif($id == 4)
    @endif
@stop