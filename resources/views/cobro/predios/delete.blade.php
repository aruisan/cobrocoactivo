{!! Form::open(['url' => 'predios/'.$predio->id, 'method' => 'DELETE', 'class' => 'inline-block']) !!}
    <button type="submit" name="delete_modal" class="btn btn-sm btn-danger delete" >
		<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </button>
{!! Form::close() !!}