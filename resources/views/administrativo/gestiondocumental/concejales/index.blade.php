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
                <div class="card-title text-center">
                    &nbsp;
                </div>
                <div class="card-body" style="background-color: white">
                    <div class="recent-meaasge">
                        <div class="media">
                            <div class="col-lg-2">
                                <a href="#"><img src="{{ asset('img/concejales/5.png')}}" class="card-img-top" width="100%"></a>
                            </div>
                            <div class="col-lg-10">
                                <h4 class="media-heading"><b>JONATHAN LEE ARCHBOLD</b></h4>
                                <p class="f-s-12">No C.C 18.011.306 </p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="col-lg-2">
                                <a href="#"><img src="{{ asset('img/concejales/1.png')}}" class="card-img-top" width="100%"></a>
                            </div>
                            <div class="col-lg-10">
                                <h4 class="media-heading"><b>LERI ANISETO HENRY TAYLOR</b></h4>
                                <p class="f-s-12">No C.C 18.005.378 </p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="col-lg-2">
                                <a href="#"><img src="{{ asset('img/concejales/3.png')}}" class="card-img-top" width="100%"></a>
                            </div>
                            <div class="col-lg-10">
                                <h4 class="media-heading"><b>EVIS EULALIA LIVINGSTON HOWARD</b></h4>
                                <p class="f-s-12">No C.C 23.249.277 </p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="col-lg-2">
                                <a href="#"><img src="{{ asset('img/concejales/6.png')}}" class="card-img-top" width="100%"></a>
                            </div>
                            <div class="col-lg-10">
                                <h4 class="media-heading"><b>ARTURO VICENTE NEWBALL BRITTON</b></h4>
                                <p class="f-s-12">No C.C 18.005.318 </p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="col-lg-2">
                                <a href="#"><img src="{{ asset('img/concejales/7.png')}}" class="card-img-top" width="100%"></a>
                            </div>
                            <div class="col-lg-10">
                                <h4 class="media-heading"><b>ANA MERCEDES NEWBALL TAYLOR</b></h4>
                                <p class="f-s-12">No C.C 23.248.837 </p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="col-lg-2">
                                <a href="#"><img src="{{ asset('img/concejales/4.png')}}" class="card-img-top" width="100%"></a>
                            </div>
                            <div class="col-lg-10">
                                <h4 class="media-heading"><b>ELSA HERMINIA ROBINSON HAWKINS</b></h4>
                                <p class="f-s-12">No C.C 23.248.781 </p>
                            </div>
                        </div>
                        <hr>
                        <div class="media">
                            <div class="col-lg-2">
                                <a href="#"><img src="{{ asset('img/concejales/2.png')}}" class="card-img-top" width="100%"></a>
                            </div>
                            <div class="col-lg-10">
                                <h4 class="media-heading"><b>JAVIER RAFAEL RODRIGUEZ ARCHBOLD</b></h4>
                                <p class="f-s-12">No C.C 18.005.265 </p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
@stop