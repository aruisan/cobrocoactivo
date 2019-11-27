{!! Form::Open(['url' => $url, 'method' => $method]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-success" style="display: flex;flex-direction: column;">
                <div class="panel-heading text-center">Datos Generales</div>
                <div class="panel-body">
                    {{ Form::label('ficha_catastral', 'Ficha Catastral', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">#</span>
                            {{ Form::text('ficha_catastral', $predio->ficha_catastral, ['class' => 'form-control', 'placeholder' => ' Ficha Catastral']) }}       
                        </div>
                    </div>
                    {{ Form::label('Matricula Inmobiliaria', 'Matricula Inmobiliaria', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">#</span>
                            {{ Form::text('matricula_inmobiliaria', $predio->matricula_inmobiliaria, ['class' => 'form-control', 'placeholder' => ' Matricula Inmobiliaria']) }}       
                        </div>
                    </div>
                    {{ Form::label('direccion_predio', 'Dirección Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            {{ Form::text('direccion_predio', $predio->direccion_predio, ['class' => 'form-control', 'placeholder' => ' Dirección Del Predio']) }}
                        </div>            
                    </div>
                    {{ Form::label('nombre_predio', 'Nombre Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                            {{ Form::text('nombre_predio', $predio->nombre_predio, ['class' => 'form-control', 'placeholder' => ' Nombre Del Predio']) }}
                        </div> 
                    </div>
                    {{ Form::label('estrato', 'Estrato', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-list-ol"></i></span>
                            {{ Form::select('estrato', ['1' => '(1) Bajo-bajo', '2' => '(2) Bajo', '3' => '(3) Medio-bajo', '4' => '(4) Medio', '5' => '(5) Medio-alto', '6' => '(6) Alto'], $predio->estrato, ['class' => 'form-control']) }}         
                        </div>
                    </div>
                    {{ Form::label('a_hectareas', 'Hectarias del Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">Hm²</span>
                            {{ Form::text('a_hectareas', $predio->a_hectareas, ['class' => 'form-control', 'placeholder' => ' Hectarias Del Predio']) }}    
                        </div>            
                    </div>
                    {{ Form::label('a_metros', 'Metros del Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">m²</span>
                            {{ Form::text('a_metros', $predio->a_metros, ['class' => 'form-control', 'placeholder' => ' Metros Del Predio']) }}    
                        </div>             
                    </div>
                    {{ Form::label('a_construida', 'Área Construida', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">m²</span>
                            {{ Form::text('a_construida', $predio->a_construida, ['class' => 'form-control', 'placeholder' => ' Área SConstruida']) }}    
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-success" style="display: flex;flex-direction: column;">
                <div class="panel-heading text-center">Datos Economicos</div>
                <div class="panel-body">
                    {{ Form::label('avaluo', 'Avaluo', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {{ Form::text('avaluo', $predio->avaluo, ['class' => 'form-control', 'placeholder' => ' Avaluo']) }}   
                        </div>             
                    </div>
                    {{ Form::label('v_declarado', 'Valor Declarado', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                         <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {{ Form::text('v_declarado', $predio->v_declarado, ['class' => 'form-control', 'placeholder' => ' Valor Declarado']) }} 
                        </div>              
                    </div>
                    {{ Form::label('impuesto_predial', 'Impuesto Predial', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {{ Form::text('impuesto_predial', $predio->impuesto_predial, ['class' => 'form-control', 'placeholder' => ' Impuesto Predial']) }}   
                        </div>              
                    </div>            
                    {{ Form::label('interes_predial', 'Interés Predial', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {{ Form::text('interes_predial', $predio->interes_predial, ['class' => 'form-control', 'placeholder' => ' Interés Predial']) }}   
                        </div>             
                    </div>
                    {{ Form::label('contribucion_car', 'Contribución', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                         <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {{ Form::text('contribucion_car', $predio->contribucion_car, ['class' => 'form-control', 'placeholder' => ' Contribución']) }}   
                        </div>             
                    </div>
                    {{ Form::label('interes_Car', 'Interés', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {{ Form::text('interes_Car', $predio->interes_Car, ['class' => 'form-control', 'placeholder' => ' Interés']) }}     
                        </div>             
                    </div>
                    {{ Form::label('otros_conceptos', 'Otros Conceptos', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {{ Form::text('otros_conceptos', $predio->otros_conceptos, ['class' => 'form-control', 'placeholder' => ' Otros Conceptos']) }}    
                        </div>           
                    </div>
                    {{ Form::label('cuantia', 'Cuantía', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {{ Form::text('cuantia', $predio->cuantia, ['class' => 'form-control', 'placeholder' => ' Cuantía']) }}    
                        </div>            
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
                    {{ Form::label('tipo_tarifa', 'Tipo de Tarifa', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                           {{ Form::text('tipo_tarifa', $predio->tipo_tarifa, ['class' => 'form-control', 'placeholder' => ' Tipo de Tarifa']) }}   
                        </div>            
                    </div>
                    {{ Form::label('destino_economico', 'Destino Economico', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            {{ Form::text('destino_economico', $predio->destino_economico, ['class' => 'form-control', 'placeholder' => ' Destino Economico']) }}  
                        </div>            
                    </div>
                    {{ Form::label('porc_tarifa', 'Porcentaje de la Tarifa', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon">%</span>
                            {{ Form::text('porc_tarifa', $predio->porc_tarifa, ['class' => 'form-control', 'placeholder' => ' Porcentaje de la Tarifa']) }}  
                        </div>            
                    </div>
                    {{ Form::label('incio', 'Año Inicio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            {{ Form::date('inicio', $predio->inico, ['class' => 'form-control', 'placeholder' => ' Año Inicial']) }} 
                        </div>            
                    </div>
                    {{ Form::label('final', 'Año Final', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            {{ Form::date('final', $predio->final, ['class' => 'form-control', 'placeholder' => ' Año Final']) }} 
                        </div>            
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="panel panel-success" style="display: flex;
    flex-direction: column;">
                <div class="panel-heading text-center">Datos del Proceso</div>
                <div class="panel-body">
                    {{ Form::label('existe', 'Existe', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-filter"></i></span>
                            {{ Form::select('existe', ['1' => 'SI', '0' => 'NO'], $predio->existe, ['class' => 'form-control']) }}            
                        </div>
                    </div>
                    {{ Form::label('ubicación', 'Ubicacion del Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-archive"></i></span>
                            {{ Form::text('ubicacion', $predio->ubicacion, ['class' => 'form-control', 'placeholder' => ' Ubicación del Predial']) }}
                        </div>            
                    </div>
                    {{ Form::label('exento', 'Exento', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-filter"></i></span>
                            {{ Form::select('exento', ['1' => 'SI', '0' => 'NO'], $predio->exento, ['class' => 'form-control']) }}            
                        </div>
                    </div>
                    {{ Form::label('semaforo', 'Semaforo', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                   <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-filter"></i></span>
                            {{ Form::select('semaforo', ['3' => 'Verde', '2' => 'Amarillo', '1' => 'Rojo'], $predio->exento, ['class' => 'form-control']) }}    
                        </div>
                    </div>
                    {{ Form::label('estado', 'Estado', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-filter"></i></span>
                            {{ Form::select('estado', ['1' => 'SI', '0' => 'NO'], $predio->existe, ['class' => 'form-control']) }}         
                        </div>
                    </div>                    
                    {{ Form::label('observacion', 'Observacion del Predio', ['class' => 'control-label col-xs-12 col-sm-6 col-md-4 col-lg-4'])}}
                    <div class="form-group col-xs-12 col-sm-6 col-md-8 col-lg-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-comment-o"></i></span>
                            {{ Form::text('observacion', $predio->observacion, ['class' => 'form-control', 'placeholder' => 'observacion']) }}            
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="row">
        <center>
            <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <a href="{{ url('predios') }}">Regresar al Listado De Predios</a>
                <input type="submit" value="enviar" class="btn btn-success">
            </div>
        </center>
    </div>

{!! Form::close()!!}