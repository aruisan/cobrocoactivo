@extends('layouts.dashboard')
@section('titulo')
    Mesa Directiva
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Mesa Directiva</b></h4>
            </strong>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="card">
                <div class="card-title text-center">
                    &nbsp;
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
@stop