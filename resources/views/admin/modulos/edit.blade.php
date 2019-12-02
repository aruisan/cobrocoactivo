@extends('layouts.dashboard')
@section('titulo')
    Editar Modulo
@stop

@section('sidebar')
  @include('admin.modulos.cuerpo.aside')
  @include('admin.permisos.cuerpo.aside')
@stop
@section('content')

<div class="col-12 formularioModulos">


        <div class="row">
            <div class="col-lg-12 margin-tb">
                    <h2 class="text-center"> Editar Modulo</h2>
            </div>
        </div>

{!! Form::model($modulo, ['method' => 'PATCH','route' => ['modulos.update', $modulo->id]]) !!}


            <div class="row inputCenter" style=" margin-top: 20px;    padding-top: 20px;    border-top: 3px solid #3d7e9a; ">
            
                <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">  
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Nombre de modulo','class' => 'form-control','name'=>'name'));   !!}
                    </div>
   
                </div>

  <div class="col-xs-11 col-sm-11 col-md-6 col-lg-6">  
                    <div class="form-group">
                                <strong>Categoria:</strong>
                       

                           <select class="form-control" name="tabs">
                            @foreach($tabs as $tab)
                                <option value="{{$tab->id}}" 
                                @if($tab->id == $modulo->tabs_permission_id) 
                                selected @endif>{{$tab->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                 
                </div>

             <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                    </div>
                </div>

       
    </div>
</div>
{!! Form::close() !!}


@endsection

@section('css')
    <style type="text/css">
        .permisos{
            margin-left: 15px;
        }

        hr { 
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript">
    
    </script>
@endsection