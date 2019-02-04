<div id="cambiarPasword" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Cambiar Password</h4>
          </div>
          {!! Form::Open(['route' => 'user-password', 'method' => 'POST']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('passwordActual', 'password Actual')}}
                    {{ Form::password('passwordActual', null, ['class' => 'form-control', 'placeholder' => 'password Actual']) }}
                </div>
                <div class="form-group">
                {{ Form::label('password', 'nuevo password')}}
                {{ Form::password('password', null, ['class' => 'form-control', 'placeholder' => 'nuevo password']) }}
                </div>
                <div class="form-group">
                {{ Form::label('passwordC', 'confirmar nuevo password')}}
                {{ Form::password('passwordC', null, ['class' => 'form-control', 'placeholder' => 'confirmar nuevo password']) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Cambiar Password</button>
            </div>
        {!! Form::close()!!}
      </div>	
    </div>
</div>