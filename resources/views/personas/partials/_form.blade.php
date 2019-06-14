{!! Form::Open(['route' => $route, 'method' => $method]) !!}
            <div class="row justify-content-center">
                <br>
                <center><h2>Nuevo Tercero</h2></center>
                <br>
            </div>
            <div class="form-group">
                {{ Form::label('Nombre', 'Nombre')}}
                {{ Form::text('nombre', $persona->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
            </div>
            <div class="form-group">
                {{ Form::label('Tipo de Documento', 'Tipo de Documento')}}
                {{ Form::select('tipo_doc', ['NIT'=> 'NIT', 'CC' =>'CC'], $persona->tipo_cc, ['placeholder' => 'Selecciona Tipo de Documento']) }}
                <br>
                {{ Form::label('Declarante', 'Declarante')}}
                {{ Form::checkbox('declarante','1', $persona->declarante) }}
                <br>
                {{ Form::label('Regimen', 'Regimen')}}
                {{ Form::select('regimen', ['Comun'=> 'Comun', 'Simplificado' =>'Simplificado', 'Gran Contribuyente' => 'Gran Contribuyente', 'Especial' => 'Especial', 'Otro' => 'Otro'], $persona->regimen, ['placeholder' => 'Selecciona Tipo de Regimen', 'onchange' => 'var obj= document.getElementById("regimen_text");if(this.value=="Otro"){obj.style.display="inline";}else{obj.style.display="none";};']) }}
                <br>
                {{ Form::text('regimen_text', $persona->regimen, ['id' => 'regimen_text','class' => 'form-control', 'placeholder' => 'Cual otro?', 'display' => 'none', 'style'=>'display: none']) }}
            </div>
            <div class="form-group">
                {{ Form::label('Numero Documento', 'Numero Documento')}}
                {{ Form::text('num_dc', $persona->num_dc, ['class' => 'form-control', 'placeholder' => 'Numero Documento']) }}
            </div>
            <div class="form-group">
                {{ Form::label('Email', 'Email')}}
                {{ Form::text('email', $persona->email, ['class' => 'form-control', 'placeholder' => 'Email']) }}            
            </div>
            <div class="form-group">
                {{ Form::label('Tipo', 'Tipo')}}
                {{ Form::select('tipo', ['NATURAL'=> 'NATURAL', 'JURIDICA' =>'JURIDICA'], $persona->tipo, ['placeholder' => 'Selecciona Tipo de Persona']) }}            
            </div>
            <div class="form-group">
                {{ Form::label('Direccion', 'Direccion')}}
                {{ Form::text('direccion', $persona->direccion, ['class' => 'form-control', 'placeholder' => 'Direccion']) }}            
            </div>
            <div class="form-group">
                {{ Form::label('Telefono', 'Telefono')}}
                {{ Form::text('telefono', $persona->telefono, ['class' => 'form-control', 'placeholder' => 'Telefono']) }}            
            </div>
            <div class="form-group">
                {{ Form::label('Ciudad', 'Ciudad')}}
                {{ Form::text('ciudad', $persona->ciudad, ['class' => 'form-control', 'placeholder' => 'Ciudad']) }}
            </div>
            <div class="form-group">

            </div>
            <div class="form-group text-center">
                <input type="submit" value="Guardar" class="btn btn-lg btn-success">
            </div>
{!! Form::close()!!}