 <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="modal-pres" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">
                        Presupuesto
                    </h4>
                </div>
              <div class="modal-body">
                  @if($V == "Vacio")
                      <div class="alert alert-danger text-center">
                          Actualmente no hay un presupuesto en la página.
                      </div>
                  @else
                  <div class="table-responsive">
                      <br>
                      <table class="table table-hover table-bordered" align="100%" id="tabla_presupuesto">
                          <thead>
                          <tr>
                              <th class="text-center">Rubro</th>
                              <th class="text-center">Nombre</th>
                              <th class="text-center">P. Inicial</th>
                              <th class="text-center">Adición</th>
                              <th class="text-center">Reducción</th>
                              <th class="text-center">Modificación</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($codigos as $codigo)
                              <tr>
                                  <td class="text-dark">{{ $codigo['codigo']}}</td>
                                  <td class="text-dark">{{ $codigo['name']}}</td>
                                  @foreach($valoresIniciales as $valorInicial)
                                      @if($valorInicial['id'] == $codigo['id'])
                                          <td class="text-center text-dark">$ <?php echo number_format($valorInicial['valor'],0);?>.00</td>
                                      @endif
                                  @endforeach
                                  @if($codigo['valor'])
                                      <td class="text-center text-dark">$ <?php echo number_format($codigo['valor'],0);?>.00</td>
                                  @endif
                                  <td>0</td>
                                  <td>0</td>
                                  <td>0</td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                  </div>
                  @endif
              </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-6 text-right">
                            <img class="card-img-top" src="{{ asset('img/escudoIslas.png') }}" alt="Card image cap" width="60">                        </div>
                        <div class="col-sm-6 text-left">
                            <img class="card-img-top" src="{{ asset('img/masporlasislas.png') }}" alt="Card image cap" width="150">
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>