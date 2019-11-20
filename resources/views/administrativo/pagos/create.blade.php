@extends('layouts.dashboard')
@section('titulo')
    Creación Pago
@stop
@section('sidebar')
    <li>
        <a href="{{ url('/administrativo/pagos') }}" class="btn btn-success">
            <span class="hide-menu">Pagos</span></a>
    </li>
@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="row justify-content-center">
            <br>
            <center><h2>Nuevo Pago</h2></center>
            <div class="form-validation">
                <form class="form-valide" action="{{url('/administrativo/pagos')}}" method="POST" enctype="multipart/form-data">
                    <hr>
                    {{ csrf_field() }}
                    <div class="col-md-12 text-center">
                        <h2>Seleccione la orden de pago correspondiente:</h2>
                    </div>
                    <div class="col-md-12 text-center">
                        <br>
                        <div class="table-responsive">
                            <br>
                            <table class="display" id="tabla_OrdenesPago">
                                <thead>
                                <tr>
                                    <th class="text-center"><i class="fa fa-hashtag"></i></th>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Tercero</th>
                                    <th class="text-center">Valor</th>
                                    <th class="text-center">Saldo</th>
                                    <th class="text-center hidden">Valor</th>
                                    <th class="text-center hidden">Valor</th>
                                    <th class="text-center hidden">iva</th>
                                    <th class="text-center hidden">desc</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($ordenPagos as $key => $data)
                                    <?php $desc = $data->valor - $data->descuentos->sum('valor');?>
                                    <tr onclick="ver('col{{$data->id}}','Obj{{$data->nombre}}','Name{{$data->registros->persona->nombre}}','Val{{$data->saldo}}','ValTo{{$data->valor}}','Iva{{$data->iva}}','Desc{{$desc}}');" style="cursor:pointer">
                                        <td id="col{{$data->id}}" class="text-center">{{ $data->id }}</td>
                                        <td id="Obj{{$data->nombre}}" class="text-center">{{ $data->nombre }}</td>
                                        <td id="Name{{$data->registros->persona->nombre}}" class="text-center">{{ $data->registros->persona->nombre }}</td>
                                        <td class="text-center">$<?php echo number_format($desc,0) ?></td>
                                        <td class="text-center">$<?php echo number_format($data->saldo,0) ?></td>
                                        <td id="Val{{$data->saldo}}" class="text-center hidden">{{ $data->saldo }}</td>
                                        <td id="ValTo{{$data->valor}}" class="text-center hidden">{{ $data->valor }}</td>
                                        <td id="Iva{{$data->iva}}" class="text-center hidden">{{ $data->iva }}</td>
                                        <td id="Desc{{$desc}}" class="text-center hidden">{{ $desc }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12" style="display: none; background-color: white" id="form" name="form">
                        <hr>
                        <center>
                            <h3>Pagar</h3>
                        </center>
                        <hr>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-4 align-self-center">
                                <div class="form-group">
                                    <label class="control-label text-right col-md-4">Nombre Orden de Pago: </label>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="IdOP" id="IdOP">
                                        <input type="hidden" name="SaldoOP" id="SaldoOP">
                                        <input type="hidden" name="ff" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                        <input type="text" style="text-align: center" class="form-control" name="Objeto" id="Objeto" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 align-self-center">
                                <div class="form-group">
                                    <label class="control-label text-right col-md-4">Valor de Orden de Pago: </label>
                                    <div class="col-lg-6">
                                        <input type="number" style="text-align: center" class="form-control" name="ValTo" id="ValTo" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 align-self-center">
                                <div class="form-group">
                                    <label class="control-label text-right col-md-4">Tercero Orden de Pago: </label>
                                    <div class="col-lg-6">
                                        <input type="text" style="text-align: center" class="form-control" name="Name" id="Name" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-4 align-self-center">
                                <div class="form-group">
                                    <label class="control-label text-right col-md-4">Valor Orden de Pago - Descuentos: </label>
                                    <div class="col-lg-6">
                                        <input type="text" style="text-align: center" class="form-control" name="ValOD" id="ValOD" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 align-self-center">
                                <div class="form-group">
                                    <label class="control-label text-right col-md-4">Valor Disponible Orden de Pago: </label>
                                    <div class="col-lg-6">
                                        <input type="number" style="text-align: center" class="form-control" name="ValDis" id="ValDis" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 align-self-center">
                                <div class="form-group">
                                    <label class="control-label text-right col-md-4">Monto a Pagar: </label>
                                    <div class="col-lg-6">
                                        <input type="text" style="text-align: center" class="form-control" min="0" name="Monto" id="Monto" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <center>
                            <button type="submit" class="btn btn-success">Continuar</button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @stop
@section('js')
    <script type="text/javascript">
        $('#tabla_OrdenesPago').DataTable( {
     	language: {
			  "lengthMenu": "Mostrar _MENU_ registros",
			  "zeroRecords": "No se encontraron resultados",
			  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
			  "sSearch": "Buscar:",
			  "oPaginate": {
				  "sFirst": "Primero",
				  "sLast":"Último",
				  "sNext":"Siguiente",
				  "sPrevious": "Anterior"
			   },
			   "sProcessing":"Procesando...",
		  },
	  //para usar los botones   
      "pageLength": 5,
	  responsive: "true",
	  dom: 'Bfrtilp',       
	  buttons:[ 
			  {
			  extend:    'copyHtml5',
			  text:      '<i class="fa fa-clone"></i> ',
			  titleAttr: 'Copiar',
			  className: 'btn btn-primary'
		  },
		  {
			  extend:    'excelHtml5',
			  text:      '<i class="fa fa-file-excel-o"></i> ',
			  titleAttr: 'Exportar a Excel',
			  className: 'btn btn-success'
		  },
		  {
			  extend:    'pdfHtml5',
			  text:      '<i class="fa fa-file-pdf-o"></i> ',
			  titleAttr: 'Exportar a PDF',     
			  message : 'SIEX-Providencia',
			  header :true,
			  orientation : 'landscape',
			  pageSize: 'LEGAL',
			  className: 'btn btn-danger',
			   },
		  {
			  extend:    'print',
			  text:      '<i class="fa fa-print"></i> ',
			  titleAttr: 'Imprimir',
			  className: 'btn btn-info'
		  },
	  ]	             

		 });

        $(document).ready(function() {
            var table = $('#tabla_OrdenesPago').DataTable();

            $('#tabla_OrdenesPago tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );

            $('#button').click( function () {
                table.row('.selected').remove().draw( false );
            } );

            $(document).on('click', '.borrar', function (event) {
                event.preventDefault();
                $(this).closest('tr').remove();
            });
        } );

        function ver(col, Obj, Name, Val, ValTo, Iva, Desc){
            content = document.getElementById(col);
            var Id = document.getElementById(col);
            var Obj = document.getElementById(Obj);
            var Name = document.getElementById(Name);
            var Val = document.getElementById(Val);
            var ValTo = document.getElementById(ValTo);
            var Iva = document.getElementById(Iva);
            var Desc = document.getElementById(Desc);
            var data = content.innerHTML;
            if (data) {
                $("#form").show();
                $("#IdOP").val(Id.innerHTML);
                $("#Objeto").val(Obj.innerHTML);
                $("#Name").val(Name.innerHTML);
                $("#Val").val(Val.innerHTML);
                $("#ValOP").val(ValTo.innerHTML);
                $("#ValTo").val(ValTo.innerHTML);
                $("#ValTo2").val(ValTo.innerHTML);
                $("#iva").val(Iva.innerHTML);
                $("#ValIOP").val(Iva.innerHTML);
                $("#IdR").val(content.innerHTML);
                $("#ValTOP").val(Val.innerHTML);
                $("#ValS").val(Val.innerHTML);
                $("#ValOD").val(Desc.innerHTML);
                $("#ValDis").val(Val.innerHTML);
                $("#Monto").val(Val.innerHTML);
                $("#SaldoOP").val(Val.innerHTML);
            } else {
                $("#form").hide();
            }
        }

        function sumar() {

            var num1 = document.getElementById("ValOP").value;
            var num2 = document.getElementById("ValIOP").value;

            var resultado = parseInt(num1) + parseInt(num2);
            document.getElementById("ValTOP").value = resultado;
        }



    </script>
@stop
