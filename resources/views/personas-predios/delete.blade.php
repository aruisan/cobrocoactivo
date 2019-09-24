{!! Form::open(['url' => 'personas-predios/'.$personas->id, 'method' => 'DELETE', 'class' => 'inline-block']) !!}

    <button type="submit" class="btn btn-xs btn-danger delete" >
		<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </button>
{!! Form::close() !!}