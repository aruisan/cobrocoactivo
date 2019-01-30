 <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="modal-pres" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">
                        Presupuesto Año 2019
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
                              <th class="text-center">Credito</th>
                              <th class="text-center">CCredito</th>
                              <th class="text-center">P.Definitivo</th>
                              <th class="text-center">CDP's</th>
                              <th class="text-center">Saldo Disponible</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($codigos as $codigo)
                              <tr>
                                  @if($codigo['valor'])
                                      <td class="text-dark">{{ $codigo['codigo']}}</td>
                                  @else
                                      <td class="text-dark">{{ $codigo['codigo']}}</td>
                                  @endif
                                  <td class="text-dark">{{ $codigo['name']}}</td>
                                  <!-- PRESUPUESTO INICIAL-->
                                  @foreach($valoresIniciales as $valorInicial)
                                      @if($valorInicial['id'] == $codigo['id'])
                                          <td class="text-center text-dark">$ <?php echo number_format($valorInicial['valor'],0);?></td>
                                      @endif
                                  @endforeach
                                  @if($codigo['valor'])
                                      <td class="text-center text-dark">$ <?php echo number_format($codigo['valor'],0);?></td>
                                  @endif
                                      <td>$0</td>
                                      <td>$0</td>
                              <!-- ADICIÓN -->
                                  @foreach($valoresIniciales as $valorInicial)
                                      @if($valorInicial['id'] == $codigo['id'])
                                          <td class="text-center text-dark">$ 0</td>
                                      @endif
                                  @endforeach
                                  @foreach($valoresAdd as $valorAdd)
                                      @if($codigo['id_rubro'] == $valorAdd['id'])
                                          <td class="text-center text-dark">$ <?php echo number_format($valorAdd['valor'],0);?></td>
                                      @endif
                                  @endforeach
                              <!-- REDUCCIÓN -->
                                  @foreach($valoresIniciales as $valorInicial)
                                      @if($valorInicial['id'] == $codigo['id'])
                                          <td class="text-center text-dark">$ 0</td>
                                      @endif
                                  @endforeach
                                  @foreach($valoresRed as $valorRed)
                                      @if($codigo['id_rubro'] == $valorRed['id'])
                                          <td class="text-center text-dark">$ <?php echo number_format($valorRed['valor'],0);?></td>
                                      @endif
                                  @endforeach
                                  <!-- PRESUPUESTO DEFINITIVO -->
                                  @foreach($valoresDisp as $valorDisponible)
                                      @if($valorDisponible['id'] == $codigo['id'])
                                          <td class="text-center">$ <?php echo number_format($valorDisponible['valor'],0);?></td>
                                      @endif
                                  @endforeach
                                  @foreach($ArrayDispon as $valorPD)
                                      @if($codigo['id_rubro'] == $valorPD['id'])
                                          <td class="text-center text-dark">$ <?php echo number_format($valorPD['valor'],0);?></td>
                                      @endif
                                  @endforeach
                              <!-- CDP'S -->
                                  @foreach($valoresIniciales as $valorInicial)
                                      @if($valorInicial['id'] == $codigo['id'])
                                          <td class="text-center text-dark">$ 0</td>
                                      @endif
                                  @endforeach
                                  @foreach($valoresCdp as $valorCdp)
                                      @if($codigo['id_rubro'] == $valorCdp['id'])
                                          <td class="text-center text-dark">$ <?php echo number_format($valorCdp['valor'],0);?></td>
                                      @endif
                                  @endforeach
                              <!-- SALDO DISPONIBLE -->
                                  @foreach($valorDisp as $vDisp)
                                      @if($vDisp['id'] == $codigo['id'])
                                          <td class="text-center">$ <?php echo number_format($vDisp['valor'],0);?></td>
                                      @endif
                                  @endforeach
                                  @foreach($saldoDisp as $salD)
                                      @if($codigo['id_rubro'] == $salD['id'])
                                          <td class="text-center text-dark">$ <?php echo number_format($salD['valor'],0);?></td>
                                      @endif
                                  @endforeach
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