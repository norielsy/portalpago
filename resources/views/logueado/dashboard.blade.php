@extends('template')

@section('title')
Portal de Pagos | Dashboard
@endsection

@section('content')
<div class="container">
    @include('logueado.publicidad')
    @yield('content_publicidad')
    @if( $errors->count() > 0 )
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif @if(Session::has('ok')) <br/>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {!! Session::get('ok') !!}
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Resumen </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-6">
                    <div class="panel panel-default bg-green">
                        <div class="panel-body">
                            <div class="col-xs-3">
                                <h1 class="text-center number">{{$total_deudas_pagadas}}</h1>
                            </div>
                            <div class="col-xs-9">
                                <h3>${{$suma_deudas_pagadas}}</h3>
                                <b>Pagos Realizados</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="panel panel-default bg-yellow">
                        <div class="panel-body">
                            <div class="col-xs-3">
                                <h1 class="text-center number">{{$total_deudas_no_pagadas}}</h1>
                            </div>
                            <div class="col-xs-9">
                                <h3>${{$suma_deudas_no_pagadas}}</h3>
                                <b>Pagos Pendientes</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <h1>Pagos Pendientes
                        <a href="{{asset('cuentas-por-pagar')}}" class="btn btn-main pull-right">Ver más</a>
                    </h1>
                    <table class="table table-hover table-responsive table-condensed listado listado-pendiente-dashboard">
                        <thead>
                            <tr>
                                {{--<th> # </th>--}}
                                <th>Nombre/Empresa</th>
                                <th>Descripción</th>
                                <th>Monto</th>
                                <th>Vencimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deudas_no_pagadas as $fila)

                            <tr @if($fila->fecha_vencimiento < date("Y-m-d")) class="danger" @endif>

                                <td class="text-center hidden-lg hidden-sm hidden-md"><b>{{App\Extras\Utilidades::ImprimirFecha($fila->fecha_vencimiento)}}</b></td>

                                {{--<td>{{$fila->idCobros}}</td>--}}
                                <td>{{$fila->empresa}}</td>
                                <td>{{$fila->descripcion}}</td>
                                <td class="text-right">{{App\Extras\Utilidades::Moneda($fila->monto)}}</td>
                                <td class="hidden-xs">{{App\Extras\Utilidades::ImprimirFecha($fila->fecha_vencimiento)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-xs-6">
                    <div class="panel panel-default bg-olive">
                        <div class="panel-body">
                            <div class="col-xs-3">
                                <h1 class="text-center number">{{$total_cobros_pagados}}</h1>
                            </div>
                            <div class="col-xs-9">
                                <h3>${{$suma_cobros_pagados}}</h3>
                                <b>Cobros Realizados</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="panel panel-default bg-orange">
                        <div class="panel-body">
                            <div class="col-xs-3">
                                <h1 class="text-center number">{{$total_cobros_no_pagados}}</h1>
                            </div>
                            <div class="col-xs-9">
                                <h3>${{$suma_cobros_no_pagados}}</h3>
                                <b>Cobros Pendientes</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <h1>Cobros Pendientes <a href="{{asset('cobrar-cuentas/todo')}}"
                      class="btn btn-main pull-right">Ver
                  más</a></h1>
                  <table class="table table-hover table-responsive table-condensed listado listado-pendiente-dashboard">
                    <thead>
                        <tr>
                            {{--<th> #</th>--}}
                            <th>Nombre/Empresa</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Vencimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cobros_no_pagados as $cobro)
                        <tr>

                            <td class="text-center hidden-lg hidden-sm hidden-md"><b>{{App\Extras\Utilidades::ImprimirFecha($cobro->fecha_vencimiento)}}</b></td>

                            {{--<td>{{$cobro->idCobros}}</td>--}}
                            <td>{{$cobro->empresa}}</td>
                            <td>{{$cobro->descripcion}}</td>
                            <td class="text-right">{{App\Extras\Utilidades::Moneda($cobro->monto)}}</td>
                            <td class="hidden-xs">{{App\Extras\Utilidades::ImprimirFecha($cobro->fecha_vencimiento)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>

</div>

@endsection
