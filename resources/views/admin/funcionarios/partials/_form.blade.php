{!! Form::Open(['url' => $url, 'method' => $method]) !!}
        
        <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group">
                {{ Form::label('Nombre', 'Nombre')}}
                {{ Form::text('name', $usuario->name, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
            </div>
        </div>

        <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group">
                {{ Form::label('Email', 'Email')}}
                {{ Form::text('email', $usuario->email, ['class' => 'form-control', 'placeholder' => 'Email']) }}            
            </div>
        </div>

        <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group">
                {{ Form::label('Contraseña')}} <br>
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña'])}}
            </div> 
        </div>

        <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group">
                {{ Form::label('Tipo', 'Tipo')}}
                {{ Form::select('role', $roles , $rolUser->role_id, ['class' => 'form-control', 'placeholder' =>'Selecciona un rol para el usuario']) }}            
            </div>
        </div>

        <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group">
                {{ Form::label('Tipo', 'Tipo')}}
                {{ Form::select('tipo', $tipos , $usuario->type_id, ['id'=>'type','class' => 'form-control', 'placeholder' =>'Selecciona Tipo de usuario', '@change' => 'getJefes()']) }}            
            </div>
        </div>

        <div class=" col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="form-group" style="display: none;" id="divJefes">
                {{ Form::label('Jefe', 'Jefe')}}
                <select class="form-control" name="jefe" v-model="selected">
                    <option v-for="dato in datos" v-bind:value="dato.id">
                      @{{dato.name}}
                    </option>             
                </select>          
            </div>
        </div>
            
        <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <a href="{{ url('admin/funcionarios') }}" class="btn btn-sm btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-sm @if($method == 'POST') btn-primary @else btn-success @endif">Guardar</button>
            </div>
        </div>
{!! Form::close()!!}


