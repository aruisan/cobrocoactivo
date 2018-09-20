
<div id="observacion" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
      <form class="form" action="{{url('/administrativo/registros/r/'.$registro->id.'/'.$rol.'/1')}}" method="POST">
      {!! method_field('PUT') !!}
      {{ csrf_field() }}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Rechazo Registro</h4>
      </div>
    </div>
      <div class="modal-body">
        <div class="row">
            <div class="form-group col-xs-12 col-sm-4 col-md-3 col-lg-4">
                <label>NUMERO IDENTIFICACION: </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-cc" aria-hidden="true"></i></span>
                    <input type="number" class="form-control" name="num_dc" id="identificador">
                    <input type="hidden" name="id">
                </div>
                <small class="form-text text-muted">identificacion participante del proceso</small>
            </div>
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Rechazar Registro</button>
      </div>
    </div>
      </form>
  </div>
</div>

