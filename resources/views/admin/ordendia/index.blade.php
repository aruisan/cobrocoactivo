@extends('layouts.dashboard')
@section('titulo')
    Orden del Día
@stop
@section('sidebar')
    <h2 class="text-center">
        Agenda
    </h2>
    <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showTabs=0&amp;mode=AGENDA&amp;height=300&amp;wkst=2&amp;bgcolor=%23ffffff&amp;src=sl3ni704u5shje7lnp3250pl7g%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FBogota" style="border-width:0" width="100%" height="460" frameborder="0" scrolling="no"></iframe>@stop
@section('content')
    <div class="col-md-12 align-self-center">
        <div class="breadcrumb text-center">
            <strong>
                <h4><b>Orden del Día</b></h4>
            </strong>
        </div>
    </div>
    <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;height=600&amp;wkst=2&amp;bgcolor=%23ffffff&amp;src=sl3ni704u5shje7lnp3250pl7g%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=America%2FBogota" style="border-width:0" width="100%" height="500" frameborder="0" scrolling="no"></iframe>
@stop