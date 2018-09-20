
@extends('layouts.principal')
@section('contenido')
<div id="encabezado" class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="caja_respuesta"></div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <div class="dropdown btn-group">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Servicio en línea
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#">Petición, quejas, reclamos y solicitudes</a></li>  
                            <li><a tabindex="-1" href="#">Solicitud de Licencias de Construcción y urbanismo</a></li>  
                            <li><a tabindex="-1" href="#">Recuperación de clave</a></li> 
                            <li><a tabindex="-1" href="#">Certificado estratificación</a></li>   
                            <li><a tabindex="-1" href="#">Certificado Nomenclatura</a></li>  
                            <li><a tabindex="-1" href="#">Certificado Zona de Riesgos</a></li> 
                            <li><a tabindex="-1" href="#">Certificado laboral</a></li> 
                            <li><a tabindex="-1" href="#">Certificado Paz y Salvo Contratistas</a></li>  
                            <li><a tabindex="-1" href="#">Certificado Paz y Salvo Predial</a></li> 
                            <li><a tabindex="-1" href="#">Certificado retención en la Fuente</a></li>  
                            <li><a tabindex="-1" href="#">Certificado Marca y Herretes</a></li>  
                            <li><a tabindex="-1" href="#">Certificado de existencia y representación legal</a></li> 
                        </ul>
                    </div>
                    <div class="dropdown btn-group">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Consultas
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#">Consulta expedientes de cobro coactivo</a></li>
                            <li><a tabindex="-1" href="#">Consulta comparendos policivos</a></li>
                            <li><a tabindex="-1" href="#">Consulta procesos policivos</a></li>
                            <li><a tabindex="-1" href="#">Consulta procesos Comisaría de Familia</a></li>
                            <li><a tabindex="-1" href="#">Consulta Comparendos de tránsito</a></li>
                            <li><a tabindex="-1" href="#">Consulta Expedientes judiciales </a></li>
                            <li><a tabindex="-1" href="#">Consulta procesos sancionatorios contractuales</a></li>
                            <li><a tabindex="-1" href="#">Consulta Registro Marcas y Herretes</a></li>
                            <li><a tabindex="-1" href="#">Consulta licencias de urbanismo</a></li>
                            <li><a tabindex="-1" href="#">Consulta licencias de funcionamiento</a></li>
                            <li><a tabindex="-1" href="#">Consulta poda de arboles</a></li> 
                            <li><a tabindex="-1" href="#">Consulta titulación de predios</a></li>
                            <li><a tabindex="-1" href="#">Consulta sisben</a></li>
                        </ul>
                    </div>
                    <div class="dropdown  btn-group">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Pago de Impuestos, tasas y tarifas
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#">Impuesto Predial</a></li>
                            <li><a tabindex="-1" href="#">Agentes retenedores ICA</a></li>
                            <li><a tabindex="-1" href="#">Industria y Comerio</a></li>
                            <li><a tabindex="-1" href="#">Deliniación y Urbanismo</a></li>
                            <li><a tabindex="-1" href="#">Publicidad Exterior Visual</a></li>
                            <li><a tabindex="-1" href="#">Comparendos Policivos</a></li>
                            <li><a tabindex="-1" href="#">Comparendos de Tránstio</a></li>
                            <li><a tabindex="-1" href="#">Valorización</a></li>
                            <li><a tabindex="-1" href="#">Fosomi</a></li>
                            <li><a tabindex="-1" href="#">Espacio público</a></li>
                            <li><a tabindex="-1" href="#">Alumbrado público</a></li>
                            <li><a tabindex="-1" href="#">Escenarios deportivos</a></li>
                            <li><a tabindex="-1" href="#">Plusvaía</a></li>
                            <li><a tabindex="-1" href="#">Otros pagos</a></li>
                        </ul>
                    </div>
                </div>
                <div id="contenedor_buscar" class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <h4 class="card-title text-principal text-center"><b>Providencia Islas</b></h4>
                    <center><img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="80"></center>
                      <div class="card-block">
                        <h4 class="card-title text-principal text-center">BUSCA TU PROCESO</h4>
                        <form class="navbar-form" id="form-create-dueno" role="form">
                          <input type="text"  id="datos" class="form-input form-control input-lg" placeholder="Nombre, Identificacion o Proceso" />
                          <button id="buscar_proceso" class="btn btn-primary btn-lg btn-raised " data-toggle="modal" data-target="#modal-respuesta">Buscar <i class="fa fa-search"></i> </button>
                        </form>
                      </div>
                </div>
  </div>

@stop