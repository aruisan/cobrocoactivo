<?php
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
?>



<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<title></title>
	<style type="text/css">
		body { 
			margin: 4px;
			font-size: 10px;
		 }

		 .amarillo{
		 	border: 1px solid yellow;
		 }
		 .azul{
		 	border: 1px solid blue;
		 }

		 .rojo{
		 	border: 1px solid red;
		 }

		 .s7{width: 7%; display: inline-block;}
		 .s17{width: 17%; display: inline-block;}
		 .s57{width: 57%; display: inline-block; bottom-top: 10px; bottom:10px;}

		 .s57 p{font-size: 12px; }
		 .br-black-1 p{font-size: 15px; }

		 .hrFecha { 
		 	border-style: double;
		  
		} 

		.br-black-1{
			border: 1px solid black;
		}
	</style>
</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2 s7" >
				<img src="{{ public_path('img/escudoIslas.png') }}"  height="60">
			</div>
			<div class="col-md-4 s57">
				<p>
					<b>
					DEPARTAMENTO DE SAN ANDRES, PROVIDENCIA Y STA CATALINA <br>
					MUNICIPIO DE PROVIDENCIA Y SANTA CATALINA ISLAS <br>
					CONCEJO MUNICIPAL
					</b>
				</p>
			</div>
			<div class="col-md-6 s17">
				<img src="{{ public_path('img/masporlasislas.png') }}" height="60">
			</div>
		</div>
		<div class="row">
			<center><h3>CERTIFICADO DE DISPONIBILIDAD PRESUPUESTAL</h3></center>
		</div>
		<hr class="hrFecha br-black-1">
			<h4>Fecha: <?=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')?></h4>
		<hr class="hrFecha br-black-1">
		<div class="br-black-1">
			<br>
			<center>
				<h2>CERTIFICA</h2>
				<br>
				<p>
					Que en la fecha el presupuesto de Gastos para la vigencia fiscal del año {{$vigencia->vigencia}} se le ha efectuado Registro Presupuestal por:
				</p>
			</center>
		</div>
		<?php $sumCdpsRegistro = 0;?>
		@foreach($registro->cdpsRegistro as $cdpsRegistro)
		<div class="br-black-1">
			<table style="margin: 5px 10px;">
				<tbody>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">Por valor de : </td>
						<td> {{$cdpsRegistro->valor}}</td>
					</tr>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">Objeto: </td>
						<td> {{$cdpsRegistro->cdp->name}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php $sumCdpsRegistro = $sumCdpsRegistro+$cdpsRegistro->valor;?>
		@endforeach
		<div class="br-black-1">
			<table style="margin: 5px 10px;">
				<tbody>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">VALOR TOTAL: </td>
						<td> {{number_format($sumCdpsRegistro)}} ({{\NumerosEnLetras::convertir($sumCdpsRegistro)}})</td>
					</tr>
					<tr style="font-size: 16px;">
						<td style="width: 30px;">Beneficiario: </td>
						<td> {{$registro->persona->nombre}}</td>
					</tr>
				</tbody>
			</table>
			
		</div>
		<div style="margin-top: 400px; font-size: 17px;">
			<center>
				_____________________ <br>
				Alex Ramirez Nuza 	<br>
				Responsable Area de Presupuesto.
			</center>
		</div>
		<hr class="hrFecha br-black-1" style="margin-bottom: 0px;">
			<center>
				<h4>MAS POR LAS ISLAS.</h4>
			</center>
	</div>

</body>
</html>
	