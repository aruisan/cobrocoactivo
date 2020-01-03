@extends('layouts.dashboard')
@section('titulo')
    Editar Retención en la Fuente
@stop
@section('content')

<div class="col-lg-12 formularioRetencion">
<div class="row">
    <br>
    <div class="col-lg-12 margin-tb">
        <h2 class="text-center"> Editar Retención en la Fuente</h2>
    </div>
</div>


<div class="row inputCenter" style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #efb827; ">
   
    <br>
    <hr>
    <form action="{{ asset('/administrativo/contabilidad/retefuente/'.$retens->id) }}" method="POST"  class="form" enctype="multipart/form-data">
        {!! method_field('PUT') !!}
        {{ csrf_field() }}
        <div class="row">
           <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                <label>Concepto: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" name="concept" value="{{ $retens->concepto }}" required>
                </div>
                <small class="form-text text-muted">Concepto de la retención</small>
            </div>
     
          <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                <label>UVT: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="number" class="form-control" name="uvt" required value="{{ $retens->uvt }}">
                </div>
                <small class="form-text text-muted">UVT de la retención</small>
            </div>
        </div>


        <div class="row">
           <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                <label>Base: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                    <input type="number" name="base" class="form-control" required value="{{ $retens->base }}">
                </div>
                <small class="form-text text-muted">Base de la retención</small>
            </div>
      
           <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                <label>Tarifa: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                    <input type="number" name="tarifa" class="form-control" required value="{{ $retens->tarifa }}">
                </div>
                <small class="form-text text-muted">Tarifa de la retención</small>
            </div>
        </div>


        <div class="row">
           <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                <label>Codigo: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                    <input type="number" name="codigo" class="form-control" required value="{{ $retens->codigo }}">
                </div>
                <small class="form-text text-muted">Codigo de la retención</small>
            </div>
     
           <div class="form-group col-xs-11 col-sm-11 col-md-6 col-lg-6">
                <label>Cuenta: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file" aria-hidden="true"></i></span>
                    <input type="text" name="cuenta" class="form-control" required value="{{ $retens->cuenta }}">
                </div>
                <small class="form-text text-muted">Cuenta de la retención</small>
            </div>
        </div>

<div class="row">
        <div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
            <button class="btn btn-primary btn-raised btn-lg">Guardar</button>
        </div>
    </form>
    <div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
        <form action="{{ asset('/administrativo/contabilidad/retefuente/'.$retens->id) }}" method="post">
            {!! method_field('DELETE') !!}
            {{ csrf_field() }}
            <button class="btn btn-danger btn-raised btn-lg">Eliminar</button>
        </form>
    </div>
     <div class="form-group col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
        <a class="btn btn-primary btn-raised btn-lg" href="{{ '/administrativo/contabilidad/retefuente' }}"> 
        Cancelar</button></a>
    </div>

       </div>


</div>
</div>

@endsection