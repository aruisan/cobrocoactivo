@if(Session::has('message'))
	<div class="row">
		<div class="col-md-offset-3 col-md-6 alert alert-success alert-dismissible" role="alert">
	        <button type="buton" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
	        <center>{{Session::get('message')}}</center>
	    </div>
	</div>
@endif