
<div id="adicion" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
      <form class="form" action="{{url('/presupuesto/rubro/m/1/'.$rubro->id)}}" method="POST" id="add">
          {!! method_field('PUT') !!}
          {{ csrf_field() }}
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Adición al Rubro</h4>
              </div>
              <div class="modal-body">
                  <div class="table-responsive" >
                      @if($fuentesR->sum('adicion') == 0 )
                          <div class="col-md-12 align-self-center">
                              <div class="alert alert-danger text-center">
                                  El rubro no ha recibido adiciones. &nbsp;
                              </div>
                          </div>
                      @else
                      @endif
                      <table id="tabla_rubrosCdp" class="table table-bordered">
                          <thead>
                          <tr>
                              <th>&nbsp;</th>
                              <th scope="col" class="text-center">Rubros</th>
                          </tr>
                          </thead>
                          <tbody>
                          @for($i = 0; $i < $rubros->count(); $i++)
                              <tr>
                                  <td class="text-center">
                                      <button type="button" class="btn-sm btn-success" onclick="ver('fuente{{$i}}')" ><i class="fa fa-arrow-down"></i></button>
                                  </td>
                                  <td class="text-center">
                                      <div class="col-lg-6">
                                          <h4>
                                              <b>{{ $rubros[$i]->name }}</b>
                                          </h4>
                                      </div>
                                      <div class="col-lg-6">
                                          @php( $valorRed = $rubros[$i]->fontsRubro->sum('reduccion') )
                                          <h4>
                                              <b>
                                                  Dinero Tomado:
                                                  @if($valorRed > 0)
                                                      $<?php echo number_format( $valorRed ,0) ?>
                                                  @else
                                                      $0.00
                                                  @endif
                                              </b>
                                          </h4>
                                      </div>
                                  </td>
                              </tr>
                              <tr id="fuente{{$i}}" style="display: none">
                                  <td style="vertical-align: middle">
                                      <b>Fuentes del rubro {{ $rubros[$i]->name }}</b>
                                  </td>
                                  <td>
                                      <div class="col-lg-12">
                                          @foreach($rubros[$i]->fontsRubro as $fuentesRubro)
                                              @if($fuentesRubro->valor_disp != 0)
                                                  <div class="col-lg-4">
                                                      <input type="hidden" name="fuenteR_id[]" value="{{ $fuentesRubro->id }}">
                                                      @php( $fechaActual = Carbon\Carbon::today()->Format('Y-m-d') )
                                                      <li style="list-style-type: none;">
                                                          {{ $fuentesRubro->font->name }} : $<?php echo number_format( $fuentesRubro->valor_disp,0) ?>
                                                      </li>
                                                  </div>
                                              @endif
                                              <div class="col-lg-4">
                                                  @if($fuentesRubro->valor_disp != 0)
                                                      Valor usado de {{ $fuentesRubro->font->name }}:
                                                      @if($fuentesRubro->reduccion != 0)
                                                          <input type="hidden" name="font_rubro_id[]" value="{{ $fuentesRubro->id }}">
                                                          <input type="number" required  name="valorRed[]" value="{{ $fuentesRubro->reduccion }}" max="{{ $fuentesRubro->valor_disp }}" style="text-align: center">
                                                      @else
                                                          <input type="hidden" name="font_rubro_id[]" value="">
                                                          <input type="number" required  name="valorRed[]" class="form-group-sm" value="0" max="{{ $fuentesRubro->valor_disp }}" style="text-align: center">
                                                      @endif
                                                  @endif
                                              </div>
                                              <div class="col-lg-4">
                                                  Fuente destino del dinero:
                                                  <br>
                                                  &nbsp;
                                                  <br>
                                                  <select name="fuente_id[]" required>
                                                      @foreach($fuentesAll as $fonts)
                                                          <option value="{{ $fonts['id'] }}">{{ $fonts['name'] }}</option>
                                                      @endforeach
                                                  </select>
                                              </div>
                                          @endforeach
                                      </div>
                                  </td>
                              </tr>
                          @endfor
                          </tbody>
                      </table>
                          <br>
                  </div>
              </div>
              <div class="modal-footer">
                  <center>
                      @if($rol == 2)
                          <button type="submit" class="btn-sm btn-primary">Guardar Adición</button>
                      @endif
                  </center>
              </div>
          </div>
      </form>
  </div>
</div>
