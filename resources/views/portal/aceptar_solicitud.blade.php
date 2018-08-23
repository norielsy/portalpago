@extends('template')

@section('title')
    Nueva Solicitud | Portal de Pagos
@endsection

@section('content')
    <div class="container solicitud">
        <h1>{!!$mensaje!!}</h1>
<br>

        <a href="{{asset('/')}}" class="btn btn-main btn-lg big-btn">Ingresar a Portal de Pagos</a>
    </div>
@endsection
