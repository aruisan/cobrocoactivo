@if($errors->any())
	<div class="row">
		<div class="col-md-offset-3 col-md-6 alert alert-danger alert-dismissible" role="alert">	
			<button type="buton" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<p>Por favor corrige los errores</p>
			<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
	</div>
@endif