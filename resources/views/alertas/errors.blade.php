@if(Session::has('message-error'))
	<div class="row">
		<div class="col-md-offset-3 col-md-6 alert alert-danger alert-dismissible" role="alert">
		    <button type="buton" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
		    <center>{{Session::get('message-error')}}</center>
		</div>
	</div>
@endif