
<div id="reporteHomologar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form class="form" action="{{url('/presupuesto/informes/contractual/reporte')}}" method="POST" id="add" enctype="multipart/form-data">
            {!! method_field('PUT') !!}
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Reporte Contractual</h3>
                </div>
                <div class="modal-body text-center" id="prog">
                    <h4>Seleccione el codigo contractual del que desee obtener el reporte </h4>
                    <br>
                    <select class="form-control text-center" name="code" required>
                        <option>Selecciona un Codigo Contractual</option>
                        @foreach($codeCon as $code)
                            <option value="{{$code->id}}">{{$code->code}} - {{$code->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="submit" class="btn-sm btn-primary">Generar Reporte</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

