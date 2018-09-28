@extends('template')
@section('title')
    Portal de Pagos | Bienvenidos
@endsection

@section('content')
    <!--container start-->
    <div class="component-bg">
        <div class="container">

            @include('logueado.publicidad')
            @yield('content_publicidad')


            <div class="row">
                <div class="col-md-6">
                    <h1>Pagos Pendientes
                        <a href="{{asset('cuentas-por-pagar')}}" class="btn btn-main pull-right">Ver más</a>
                    </h1>
                    <table class="table table-hover table-responsive table-condensed listado listado-pendientes">
                        <thead>
                        <tr>
                            {{--<th> #</th>--}}
                            <th> Rut</th>
                            <th> Nombre/Empresa</th>
                            <th> Monto ($)</th>
                            <th> Vencimiento</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($nopagadas as $nopagada)
                            <tr>
                                {{--<td>{{$nopagada->idCobros}}</td>--}}
                                <td>{{App\Helper\Rut::rut($nopagada->cobrador->rut)}}</td>
                                <td>{{$nopagada->cobrador->nombre}}</td>
                                <td>{{App\Extras\Utilidades::Moneda($nopagada->monto)}}</td>
                                <td>{{App\Extras\Utilidades::ImprimirFecha($nopagada->fecha_vencimiento)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($nopagadas->count() == 0)
                        <div class="alert alert-info">
                            <span>No registra ninguna deuda</span>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <h1>Pagos Realizados
                        <a href="{{asset('cuentas-por-pagar/pagadas')}}" class="btn btn-main pull-right">Ver más</a>
                    </h1>
                    <table class="table table-hover table-responsive table-condensed listado listado-pendientes">
                        <thead>
                        <tr>
                            {{--<th> #</th>--}}
                            <th> Rut</th>
                            <th> Nombre/Empresa</th>
                            <th> Monto ($)</th>
                            <th> Vencimiento</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagadas as $pagada)
                            <tr>
                                {{--<td>{{$pagada->idCobros}}</td>--}}
                                <td>{{App\Helper\Rut::rut($pagada->cobrador->rut)}}</td>
                                <td>{{$pagada->cobrador->nombre}}</td>
                                <td>{{App\Extras\Utilidades::Moneda($pagada->monto)}}</td>
                                <td>{{App\Extras\Utilidades::ImprimirFecha($pagada->fecha_vencimiento)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($nopagadas->count() == 0 && $pagadas->count() == 0)
                        <div class="alert alert-info">
                            <span>No registra ninguna deuda</span>
                        </div>
                    @elseif($pagadas->count() == 0 && $nopagadas->count() > 0)
                        <div class="alert alert-warning">
                            <span>Tiene deudas pendientes de pago</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
