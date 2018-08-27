@extends('adminlte::page')

@section('title', 'CobroCoactivo')


@section('content_header')
    <h1>Tus Notificaciones</h1>
@stop

@section('content')
   <div class="container">
    <br>
    <div class="row">
        <div class="panel panel-default widget col-xs-12 col-sm-10 col-sm-offset-1 of col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
            <div class="panel-body">
                <ul class="list-group">
                    @foreach ($notifications as $notification)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-2 col-md-2">
                                    <img src="{{asset('img/user.png')}}" class="img-circle img-responsive" alt="" />
                                </div>
                                <div class="col-xs-10 col-md-10">
                                    <div>
                                        <br>
                                        {{$notification->data['name']}}
                                        <a href="{{$notification->data['link']}}" onclick="leida('{{$notification->id}}')">
                                            {{$notification->data['text']}}
                                        </a>
                                        <div class="action pull-right">
                                            @if ($notification->read_at == NULL)
                                                <button class="btn btn-xs btn-success">
                                                    <span class="glyphicon glyphicon-ok"></span>
                                                </button>
                                            @else
                                                <a href="{{route('notification.visibilidad',$notification->id)}}" class="btn btn-xs btn-danger">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </a>
                                            @endif   
                                        </div>
                                        <br>
                                        <div class="mic-info">
                                            {{$notification->created_at->diffForHumans()}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                    @endforeach    
                </ul>
            </div>
        </div>
    </div>

   </div>
@stop


@section('js')
   <script>

        function leida(e){
            // $.ajax({
            //   method: "GET",
            //   url: "/admin/notificaciones/"+e,
            // });

            $.get("/admin/notificaciones/"+e, function(response){
                console.log(e);
            });
        }
   </script>
@stop

