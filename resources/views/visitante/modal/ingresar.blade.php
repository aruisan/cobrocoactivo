 <!-- Modal -->
        <div class="modal fade" id="modal-ingresar" tabindex="-2" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <form class="form_entrar col-md-12" action="{{url('/login')}}" method="POST">
                  {{ csrf_field() }}
                    <h4 class="text-center text-white">Ingreso Plataforma</h4>
                    <div class="form-group">
                      <input type="text" name="email" class="form-control input-lg" placeholder="email">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control input-lg" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <button class="btn btn-info btn-lg btn-block" type="submit">Entrar</button>
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>