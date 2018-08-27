{!! Form::Open(['url' => $url, 'method' => $method]) !!}
            <div class="form-group">
                {{ Form::label('Nombre', 'Nombre')}}
                {{ Form::text('name', $data->name, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
            </div>           
            <div class="form-group">
                <a href="{{ url('admin/roles') }}" class="btn btn-sm btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-sm @if($method == 'POST') btn-primary @else btn-success @endif">Guardar</button>
            </div>
{!! Form::close()!!}


