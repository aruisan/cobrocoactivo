@extends('layouts.principal')
@section('contenido')
    <div id="contenedor_buscar" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="col-sm-3 text-right">
            <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="100">
        </div>
        <div class="col-sm-6">
            <h4 class="text-center text-black">
                <b>
                    CONCEJO MUNICIPAL
                    <br>
                    MUNICIPIO DE PROVIDENCIA Y SANTA CATALINA
                    <br>
                    DEPARTAMENTO ARCHIPIELAGO DE SAN ANDRES
                    <br>
                    REPUBLICA DE COLOMBIA
                    <br>
                    <br>
                    <font size="5" face="Matura MT Script Capitals">
                        Un Concejo Moderno al Servicio de las Islas</font>
                </b>
            </h4>
        </div>
        <div class="col-sm-3 text-left">
            <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="180">
        </div>
    </div>
<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <center>
        <img src="{{ asset('img/img1.png') }}" width="auto">
    <!--
        <video width="1000" class="media-object" autoplay controls>
            <source src=" {{ asset('video/marque.mp4') }}" type="video/mp4">
        </video>
     -->
    </center>
  </div>


@stop