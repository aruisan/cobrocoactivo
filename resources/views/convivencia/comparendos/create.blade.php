@extends('layouts.dashboard')

@section('content')
    <br>
    <div class="col-xs-hidden col-sm-1 col-md-2 col-lg-3 "></div>

     <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 sombra-formulario">
        <center><label>Formulario de Comparendos</label></center>
         <form id="form-create"  method="POST" action="{{ route('comparendos.store') }}">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>Responsable:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="responsable">
                        </div>
                    <small class="form-text text-muted">Nombre Completo del Responsable</small>

                        <br>

                            <label>Valor: </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></span>
                                <input type="number" class="form-control" name="valor">

                    </div>
                    <small class="form-text text-muted">Valor del Comparendo</small>
                <br>

                                <label>Asunto: </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="asunto">
                                </div>
                                <small class="form-text text-muted">Asunto del Comparendo</small>

                            <div class="row">
                                <div class="form-group">
                                    <button class="btn btn-danger ocultar" id="comparendos">Cancelar</button>
                                    <button class="btn btn-primary btn-block" type="submit">Nuevo Comparendo</button>
                                </div>
                            </div>
            </form>
     </div>
@stop
@section('sidebar')
    <li><a href="{{ route('comparendos.index') }}" class="btn btn-primary">Comparendos</a></li>
@stop