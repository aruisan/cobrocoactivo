@extends('layouts.dashboard')
@section('titulo')
    Agregar Proyecto de Acuerdo
@stop
@section('sidebar')
    {{-- <li> <a class="btn btn-primary" href="{{ asset('/dashboard/acuerdos') }}"><span class="hide-menu">Acuerdos</span></a></li> --}}
@stop
@section('content')


<div class="col-xs-12 col-sm-12 col-md-12 formularioAcuerdo">


        <div class="row">
            
            <div class="col-lg-12 margin-tb">
                <h2 class="text-center"> Nuevo Proyecto de Acuerdo</h2>
            </div>
        </div>
        
<div class="row inputCenter"  style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #efb827; ">
        
        <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link regresar"  href="{{ asset('/dashboard/acuerdos') }}" >Volver a Acuerdos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " data-toggle="pill" href="#ver">Nuevo</a>
                </li>
             
             
            </ul>
            
    <div class="tab-content col-sm-12" >
    
       <hr>
            {!! Form::open(array('route' => 'proyectos.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
            <div class="row">
                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                    <label>Nombre: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <small class="form-text text-muted">Nombre que se desee asignar al archivo</small>
           </div>


                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                    <label>Fecha del Documento: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input type="date" name="ff_doc" class="form-control" required>
                    </div>
                    <small class="form-text text-muted">Fecha del Documento</small>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                    <label>Comisión: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                        <select class="form-control" name="comision_id">
                            @foreach($Comisiones as $comision)
                                <option value="{{$comision->id}}">{{$comision->id}} - {{$comision->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <small class="form-text text-muted">Comisión asignada al acuerdo</small>
                </div>
          

                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                    <label>Consecutivo: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                        <input type="number" name="cc_id" class="form-control" required>
                    </div>
                    <small class="form-text text-muted">Consecutivo asignado al proyecto de acuerdo</small>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                    <label>Estado actual del proyecto de acuerdo: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-check" aria-hidden="true"></i></span>
                        <select class="form-control" name="estado">
                            <option value="0">Pendiente</option>
                            <option value="1">Aprobado</option>
                            <option value="2">Rechazado</option>
                            <option value="3">Archivado</option>
                        </select>
                    </div>
                    <small class="form-text text-muted">Seleccionar el estado en el que se encuentra el proyecto de acuerdo</small>
                </div>
           

                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                    <label>Fecha de Salida: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input type="date" name="ff_salida" class="form-control" required>
                    </div>
                    <small class="form-text text-muted">Fecha de salida del proyecto de acuerdo</small>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                    <label>Fecha de 1er debate: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input type="date" name="ff_primerdbt" class="form-control" required>
                    </div>
                    <small class="form-text text-muted">Fecha del primer debate</small>
                </div>
            

                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                    <label>Fecha del 2do debate: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input type="date" name="ff_segundodbt" class="form-control" required>
                    </div>
                    <small class="form-text text-muted">Fecha del segundo debate</small>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                    <label>Concejal Ponente: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <select class="form-control" name="ponente_id">
                            @foreach($Concejales as $concejal)
                                <option value="{{$concejal->id}}">{{$concejal->persona->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <small class="form-text text-muted">Concejal ponente</small>
                </div>
       
                <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                    <label>Concejal: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <select class="form-control" name="concejal_id">
                            @foreach($Concejales as $concejal)
                                <option value="{{$concejal->id}}">{{$concejal->persona->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <small class="form-text text-muted">Concejal ponente</small>
                </div>

</div>
            <div class="row">
                <div class="form-group col-xs-11 col-sm-11 col-md-12 col-lg-12 text-center">
                    <label>Subir Archivo: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>
                        <input type="file" name="fileProyA" accept="application/pdf" class="form-control" required>
                    </div>
                    <small class="form-text text-muted">Archivo correspondiente al proyecto de acuerdo</small>
                </div>
            </div>

            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <button class="btn btn-primary btn-raised btn-lg">Agregar</button>
            </div>
            {!! Form::close() !!}
        </div>

</div>
</div>
@endsection