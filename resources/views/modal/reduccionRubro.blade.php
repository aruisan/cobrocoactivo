
<div id="reduccion" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form class="form" action="{{url('/presupuesto/rubro/m/3/'.$rubro->id)}}" method="POST" id="add" enctype="multipart/form-data">
            {!! method_field('PUT') !!}
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reducción al Rubro:  {{ $rubro->name }}</h4>
                </div>
                <div class="modal-body" id="prog">
                    <div class="table-responsive" >
                        <table id="tabla_rubrosCdp" class="table table-bordered">
                            <thead>
                            <tr>
                                @foreach($fuentesR as $data)
                                    <th class="text-center">Dinero a retirar de  la fuente: {{ $data->Font->name }}</th>
                                @endforeach
                                <th scope="col" class="text-center">Archivo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @foreach($fuentesR as $fuentesRubro)
                                    <input type="hidden" name="fuenteR_id[]" value="{{ $fuentesRubro->id }}">
                                    <td>
                                        <div class="col-lg-12">
                                            @if($red->count() > 0)
                                            <!--
                                                <input type="hidden" name="fuente_id[]" value="@foreach($fuentesRubro->rubrosMov as $mov) @if($mov->rubro_id == $rubro->id and $mov->movimiento == 3) {{  $mov->fonts_id }}@endif @endforeach">
                                                <input type="hidden" name="fuenteBase_id[]" value="{{ $fuentesRubro->Font->id }}">
                                            -->
                                                <input type="hidden" name="mov_id[]" value="@foreach($red as $mov) @if($mov->rubro_id == $rubro->id and $mov->movimiento == 3) {{  $mov->id }} @endif @endforeach">
                                                <input type="text" required  name="valorCred[]" value="@foreach($fuentesRubro->rubrosMov as $mov) @if($mov->rubro_id == $rubro->id and $mov->movimiento == 3) {{  $mov->valor }} @endif @endforeach" style="text-align: center">
                                            @else
                                                <input type="hidden" name="fuente_id[]" value="{{ $fuentesRubro->Font->id }}">
                                                <input type="hidden" name="mov_id[]" value="">
                                                <input type="number" required  name="valorCred[]" class="form-group-sm" value="0" style="text-align: center">
                                            @endif
                                        </div>
                                    </td>
                                @endforeach
                                <td>
                                    <div class="form-group-sm">
                                        <input type="file" required name="fileReduccion" accept="application/pdf" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <center>
                        @if($rol == 2)
                            <button type="submit" class="btn-sm btn-primary">Guardar Reducción</button>
                        @endif
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

