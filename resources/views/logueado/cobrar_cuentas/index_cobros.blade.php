@extends('template')
@section('title')
    Quiero Cobrar | Portal de Pagos
@endsection

@section('content')
    <input type="hidden" id="get_token" name="_token" value="{{ csrf_token() }}"/>
    <!--container start-->
    <div class="component-bg">
        <div class="container">
            @include('logueado.publicidad')
            @yield('content_publicidad')
            <div class="row">

                <div class="col-xs-12 hidden-lg hidden-md hidden-sm top25">
                    <a class="btn btn-main btn-block custom-btn" href="{{asset("cobrar-cuentas/individuales")}}">Cargar cobro individual</a>
                    <a class="btn btn-main btn-block custom-btn"href="{{asset("cobrar-cuentas/nominas")}}">Cargar Nómina de cobros</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <h1>Cobros Pendientes</h1>
                    @if($pendientes->count() > 0)
                        <table class="table table-hover table-responsive table-condensed listado listado-pendiente-dashboard">
                            <thead>
                            <tr>
                                {{--<th> #</th>--}}
                                <th>Rut</th>
                                <th>Nombre/Empresa</th>
                                <th>Monto ($)</th>
                                <th>Vencimiento</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pendientes as $cobro)
                                <tr>
                                    <td class="text-center hidden-lg hidden-sm hidden-md">{{App\Extras\Utilidades::ImprimirFecha($cobro->fecha_vencimiento)}}</td>
                                    {{--<td>{{$cobro->idCobros}}</td>--}}
                                    <td>{{App\Helper\Rut::rut($cobro->rut_empresa)}}</td>
                                    <td>{{$cobro->empresa}}</td>
                                    <td>{{App\Extras\Utilidades::Moneda($cobro->monto)}}</td>
                                    <td class="hidden-xs">{{App\Extras\Utilidades::ImprimirFecha($cobro->fecha_vencimiento)}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            <strong>Usted no registra cobros pendientes.</strong><br>
                            Cargue su primer crobro haciendo click <a class="btn btn-main"
                                                                      href="{{asset("cobrar-cuentas/individuales")}}">aqui</a>
                        </div>
                    @endif
                    <div class="col-xs-12 clearfix">
                        <a href="{{asset('cobrar-cuentas/todo')}}" class="btn btn-main pull-right visible-xs visible-sm">Ver
                            más</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <h1>Cobros Realizados</h1>
                    @if($pagadas->count() > 0)
                        <table class="table listado listado-realizados table-hover table-responsive table-condensed">
                            <thead>
                            <tr>
                                {{--<th> #</th>--}}
                                <th style="min-width:100px;">Rut</th>
                                <th>Nombre/Empresa</th>
                                <th>Monto ($)</th>
                                <th>Fecha Pago</th>
                                <th>Forma de Pago</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pagadas as $pagada)
                                <tr>
                                    {{--<td>{{$pagada->idCobros}}</td>--}}
                                    <td>{{App\Helper\Rut::rut($pagada->rut)}}</td>
                                    <td>{{$pagada->empresa}}</td>
                                    <td>{{App\Extras\Utilidades::Moneda($pagada->monto)}}</td>
                                    <td>{{App\Extras\Utilidades::ImprimirFecha($pagada->fecha_pago)}}</td>
                                    <td>@if(empty($pagada->forma_pago))
                                            TEF (Conc.Auto)
                                        @else
                                            {{@$pagada->forma_pago}}
                                        @endif</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            <strong>Usted todavia no ha realizado ningún cobro.</strong><br>
                            @if($pendientes->count() == 0)
                                Cargue su primer crobro haciendo click
                                <a class="btn btn-main" href="{{asset("cobrar-cuentas/individuales")}}">aqui</a>
                            @endif
                        </div>
                    @endif
                    <a href="{{asset('cobrar-cuentas/pagadas')}}" class="btn btn-main pull-right visible-xs visible-sm">Ver
                        más</a>
                </div>
            </div>
            <div class="row hidden-xs hidden-sm">
                <div class="col-md-6 col-xs-12">
                    <a href="{{asset('cobrar-cuentas/todo')}}" class="btn btn-main pull-right">Ver más</a>
                </div>
                <div class="col-md-6 col-xs-12">
                    <a href="{{asset('cobrar-cuentas/pagadas')}}" class="btn btn-main pull-right">Ver más</a>
                </div>
            </div>
        </div>
    </div>
    <div class="top25"></div>
@endsection
