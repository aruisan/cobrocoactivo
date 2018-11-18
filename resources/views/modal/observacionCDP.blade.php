
<div id="observacionCDP" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
      <form class="form" action="{{url('/administrativo/cdp/r/'.$cdp->id)}}" method="POST">
          {!! method_field('PUT') !!}
          {{ csrf_field() }}
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Rechazo del CDP</h4>
              </div>
              <div class="modal-body">
                  <input type="hidden" name="rol" value="{{ $rol }}">
                  <input type="hidden" name="fecha" value="{{ Carbon\Carbon::today()->Format('Y-m-d')}}">
                  <label>OBSERVACIÓN DEL MOTIVO DE RECHAZO DEL CDP: </label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-file-o" aria-hidden="true"></i></span>
                      <textarea name="motivo" required class="form-control"></textarea>
                  </div>
                  <small class="form-text text-muted">Observación detallada del rechazo del CDP</small>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">Rechazar CDP</button>
              </div>
          </div>
      </form>
  </div>
</div>

