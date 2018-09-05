@extends('layouts.dashboard')

@section('content')
    <br>
    <div class="col-xs-hidden col-sm-1 col-md-2 col-lg-3 "></div>

     <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 sombra-formulario">
        <center><label>Formulario de Creación De Contrato</label></center>
            <form id="form-create"  method="POST" action="{{ route('contractual.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>Responsable:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="responsable">
                        </div>
                    <small class="form-text text-muted">Nombre completo del responsable del contrato</small>

                        <br>

                            <label>Valor: </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar" aria-hidden="true"></i></span>
                                <input type="number" class="form-control" name="valor" >

                    </div>
                    <small class="form-text text-muted">Valor del contrato</small>
                <br>

                                <label>Asunto: </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="asunto"  >
                                </div>
                                <small class="form-text text-muted">Asunto del contrato</small>

                            <div class="row">
                                <div class="form-group">
                                    <button class="btn btn-danger ocultar" id="contractual">Cancelar</button>
                                    <button class="btn btn-primary btn-block" type="submit">Nuevo Contrato</button>
                                </div>
                            </div>
            </form>
     </div>
@stop

@section('sidebar')
  <a href="{{ route('contractual.index') }}" class="btn btn-primary">Contractuales</a>
@stop
