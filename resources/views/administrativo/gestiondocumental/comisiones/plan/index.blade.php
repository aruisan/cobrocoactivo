@extends('layouts.dashboard')
@section('titulo')
    Comisión de Plan
@stop
@section('sidebar')
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Comisión de Plan</b></h4>
            </strong>
        </div>
    </div>
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
                </div>
                <div class="card-body">
                    <div class="recent-meaasge">
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img alt="..." src="images/avatar/1.jpg" class="media-object"></a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">john doe</h4>
                                <div class="meaasge-date">15 minutes Ago</div>
                                <p class="f-s-12">We are happy about your service </p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img alt="..." src="imag/user.png" class="media-object"></a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Mr. John</h4>
                                <div class="meaasge-date">40 minutes ago</div>
                                <p class="f-s-12">Quick service and good serve </p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img alt="..." src="images/avatar/3.jpg" class="media-object"></a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Mr. Michael</h4>
                                <div class="meaasge-date">1 minutes ago</div>
                                <p class="f-s-12">We like your birthday cake </p>
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

@stop