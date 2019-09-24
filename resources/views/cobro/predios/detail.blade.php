@extends('layouts.dashboard')

@section('titulo')
    Editando Predio
@stop
@section('sidebar')
  @include('cobro.predios.cuerpo.aside')
@stop

@section("content")

<div style="height: 100%;display: flex;background: white;flex-wrap: wrap;width: 100%;">
  
  <div class="row" style="justify-content: center;display: : flex; width: 100%;">
    <div class="col-lg-12 margin-tb">
            <h2 class="text-center">Predios Detail</h2>
    </div>
    <div class="container-fluid">
      <div class="white">

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-success" style="display: flex;flex-direction: column;">
                <div class="panel-heading text-center">Datos Generales</div>
                <div class="panel-body">
                    {{ Form::label('ficha_catastral', 'Ficha Catastral', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('ficha_catastral', $predio->ficha_catastral, ['class' => 'form-control', 'placeholder' => 'Ficha Catastral']) }}
                    </div>
                        {{ Form::label('Matricula Inmobiliaria', 'Matricula Inmobiliaria', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('matricula_inmobiliaria', $predio->matricula_inmobiliaria, ['class' => 'form-control', 'placeholder' => 'Matricula Inmobiliaria']) }}
                    </div>
                        {{ Form::label('direccion_predio', 'Direccion Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('direccion_predio', $predio->direccion_predio, ['class' => 'form-control', 'placeholder' => 'Direccion Del Predio']) }}            
                    </div>
                        {{ Form::label('nombre_predio', 'Nombre Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('nombre_predio', $predio->nombre_predio, ['class' => 'form-control', 'placeholder' => 'Nombre Del Predio']) }}
                    </div>
                        {{ Form::label('estrato', 'Estrato', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('estrato', $predio->estrato, ['class' => 'form-control', 'placeholder' => 'Estrato']) }}            
                    </div>
                        {{ Form::label('a_hectareas', 'Hectarias del Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('a_hectareas', $predio->a_hectareas, ['class' => 'form-control', 'placeholder' => 'Hectarias Del Predio']) }}            
                    </div>
                        {{ Form::label('a_metros', 'Metros del Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('a_metros', $predio->a_metros, ['class' => 'form-control', 'placeholder' => 'Metros Del Predio']) }}            
                    </div>
                        {{ Form::label('a_construida', 'Area Construida', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('a_construida', $predio->a_construida, ['class' => 'form-control', 'placeholder' => 'Area SConstruida']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-success" style="display: flex;flex-direction: column;">
                <div class="panel-heading text-center">Datos Economicos</div>
                <div class="panel-body">
                        {{ Form::label('avaluo', 'Evaluo', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('avaluo', $predio->avaluo, ['class' => 'form-control', 'placeholder' => 'Evaluo']) }}            
                    </div>
                        {{ Form::label('v_declarado', 'Valor Declarado', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('v_declarado', $predio->v_declarado, ['class' => 'form-control', 'placeholder' => 'Valor Declarado']) }}            
                    </div>
                        {{ Form::label('impuesto_predial', 'Impuesto Predial', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('impuesto_predial', $predio->impuesto_predial, ['class' => 'form-control', 'placeholder' => 'Impuesto Predial']) }}            
                    </div>            
                        {{ Form::label('interes_predial', 'Interes Predial', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('interes_predial', $predio->interes_predial, ['class' => 'form-control', 'placeholder' => 'Interes Predial']) }}            
                    </div>
                        {{ Form::label('contribucion_car', 'Contribucion', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('contribucion_car', $predio->contribucion_car, ['class' => 'form-control', 'placeholder' => 'Contribucion']) }}            
                    </div>
                        {{ Form::label('interes_Car', 'Interes', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('interes_Car', $predio->interes_Car, ['class' => 'form-control', 'placeholder' => 'Interes']) }}            
                    </div>
                        {{ Form::label('otros_conceptos', 'Otros Conceptos', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('otros_conceptos', $predio->otros_conceptos, ['class' => 'form-control', 'placeholder' => 'Otros Conceptos']) }}            
                    </div>
                        {{ Form::label('cuantia', 'Cuantia', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('cuantia', $predio->cuantia, ['class' => 'form-control', 'placeholder' => 'Cuantia']) }}            
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-success" style="display: flex;flex-direction: column;">
                <div class="panel-heading text-center">Datos Socio-economicos</div>
                <div class="panel-body">
                        {{ Form::label('tipo_tarifa', 'Tipo de Tarifa', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('tipo_tarifa', $predio->tipo_tarifa, ['class' => 'form-control', 'placeholder' => 'Tipo de Tarifa']) }}       
                    </div>
                        {{ Form::label('destino_economico', 'Destin Economico', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('destino_economico', $predio->destino_economico, ['class' => 'form-control', 'placeholder' => 'Destino Economico']) }}
                    </div>
                        {{ Form::label('porc_tarifa', 'Porcentaje de la Tarifa', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('porc_tarifa', $predio->porc_tarifa, ['class' => 'form-control', 'placeholder' => 'Porcentaje de la Tarifa']) }}          
                    </div>
                        {{ Form::label('incio', 'Año Inicio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('inico', $predio->inico, ['class' => 'form-control', 'placeholder' => 'Año Inicial']) }}            
                    </div>
                        {{ Form::label('final', 'Año Final', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('final', $predio->final, ['class' => 'form-control', 'placeholder' => 'Año Final']) }}            
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-success" style="display: flex;
    flex-direction: column;">
                <div class="panel-heading text-center">Datos del Proceso</div>
                <div class="panel-body">
                        {{ Form::label('existe', 'Existe', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::select('existe', ['1' => 'SI', '0' => 'NO'], $predio->existe, ['placeholder' => 'Selecciona Si Existe El Predial']) }}            
                    </div>
                        {{ Form::label('ubicacion', 'Ubicacion del Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('ubicacion', $predio->ubicacion, ['class' => 'form-control', 'placeholder' => 'Ubicacion del Predial']) }}            
                    </div>
                        {{ Form::label('exento', 'Exento', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::select('exento', ['1' => 'SI', '0' => 'NO'], $predio->exento, ['placeholder' => 'Selecciona Si Esta Exento']) }}            
                    </div>
                        {{ Form::label('semaforo', 'Semaforo', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                   <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('semaforo', $predio->semaforo, ['class' => 'form-control', 'placeholder' => 'Semafaro']) }}            
                    </div>
                        {{ Form::label('estado', 'Estado', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('estado', $predio->estado, ['class' => 'form-control', 'placeholder' => 'Estado']) }}            
                    </div>
                    {{ Form::label('observacion', 'Observacion del Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-6 col-lg-6'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        {{ Form::text('observacion', $predio->observacion, ['class' => 'form-control', 'placeholder' => 'observacion']) }}            
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="row">
        <center>
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a href="{{ url('predios') }}" class="btn btn-default" style="color:black">Regresar al Listado De Predios</a>
            </div>
        </center>
    </div>

          
      </div>
    </div>  
  </div>
</div>
@endsection