@extends('layouts.dashboard')

@section('content')
    <br>
    <div class="col-xs-hidden col-sm-1 col-md-2 col-lg-3 "></div>

     <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 sombra-formulario">
        <center><label>Creación de un Plan de Mejoramiento</label></center>
         <form id="form-create"  method="POST" action="{{ route('planmejoramiento.store') }}">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>Responsable:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="responsable">
                        </div>
                    <small class="form-text text-muted">Nombre completo del responsable</small>

                        <br>


                                <label>Asunto: </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="asunto">
                                </div>
                                <small class="form-text text-muted">Asunto del Plan de Mejoramiento</small>

                            <div class="row">
                                <div class="form-group">
                                    <button class="btn btn-danger ocultar" id="planmejoramiento">Cancelar</button>
                                    <button class="btn btn-primary btn-block" type="submit">Nuevo Plan de Mejoramiento</button>
                                </div>
                            </div>
            </form>
     </div>
@stop
@section('sidebar')
    <li><a href="{{ route('planmejoramiento.index') }}" class="btn btn-primary">Planes de Mejoramiento</a></li>
@stop