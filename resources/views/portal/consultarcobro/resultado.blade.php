@extends('template')

@section('title')
    Consultar Cobros | Portal de Pagos
@endsection

@section('content')
    <!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <h1 class="top10">
                        Pagos Pendientes -
                        <small>Rut: {{$rut}}</small>
                    </h1>
                </div>

            </div>
        </div>
    </div>

    <div class="container password_restablecer">

        @if( $errors->count() > 0 )
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <table class="table listado-deudas table-hover">
                <thead>
                <tr>
                    <th>Nombre/Empresa</th>
                    <th>Descripción</th>
                    <th class="text-right">Monto ($)
                        <a href="{{URL::route('consultar',array('monto' => 'desc','rut' => Request::get('rut'),'empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                            <i class="icono-verde fa fa-sort-numeric-desc"></i>
                        </a>
                        <a href="{{URL::route('consultar',array('monto' => 'asc','rut' => Request::get('rut'),'empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                            <i class="icono-verde fa fa-sort-numeric-asc"></i>
                        </a>
                    </th>
                    <th class="text-center">Fecha vencimiento
                        <a href="{{URL::route('consultar',array('fecha' => 'desc','rut' => Request::get('rut'),'empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                            <i class="icono-verde fa fa-sort-numeric-desc"></i>
                        </a>
                        <a href="{{URL::route('consultar',array('fecha' => 'asc','rut' => Request::get('rut'),'empresa' => Request::get('empresa'),'page' => Request::get('page')))}}">
                            <i class="icono-verde fa fa-sort-numeric-asc"></i>
                        </a>
                    </th>

                </tr>
                </thead>
                <tbody>

                @if(count($data) > 0)
                    @foreach($data as $fila)
                        <tr>
                            <td>{{$fila->empresa}}</td>
                            <td>{{$fila->descripcion}}</td>
                            <td class="text-right"> xx.xxx</td>
                            <td class="text-center">{{App\Extras\Utilidades::ImprimirFecha($fila->fecha_vencimiento)}}</td>

                        <!-- <td>{{App\Extras\Utilidades::Moneda($fila->monto)}}</td> -->
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="nodata">No registramos pagos pendientes para el Rut consultado</td>
                    </tr>
                @endif
                </tbody>
            </table>
            @if($data != null)
                {!! str_replace('/?', '?',$data->appends(Request::only(['fecha','monto','empresa','rut']))->render()) !!}
            @endif

            <a href="{{asset('index.php')}}" class="btn btn-primarynew btn-lg pull-right">Volver</a>
        </div>

    </div>
    @if(!Auth::check())
        <div class="container" style="padding: 20px 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center feature-head wow fadeInDown">
                        <h3 class="">
                            ¿Quieres más detalles de estos cobros? <a href="registro" class="btn btn-registro">
                                Regístrate ahora
                            </a>
                        </h3>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endsection