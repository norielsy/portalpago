@extends('template')

@section('title')
    Quiero Cobrar | Portal de Pagos
@endsection

@section('content')
    <input type="hidden" id="get_token" name="_token" value="{{ csrf_token() }}" />
    <!--container start-->
    <div class="component-bg">
        <div class="container">

            <div class="row logout">
                <div class="col-lg-8 col-sm-8">
                    <div class="bienvenido pull-left">
                        Bienvenido <strong class="azul">{{ Session::get('nombre') }}</strong>
                    </div>
                </div>
            </div>

            <h1>Cobrar Cuentas</h1>

            <div class="bs-docs-section">
                <h3>Detalle cobro puntual</h3>

                <table class="table listado-deudas table-hover top50">
                    <thead>
                    <tr>
                        {{--<th> # </th>--}}
                        <th> Empresa </th>
                        <th> Descripción </th>
                        <th>Rut</th>
                        <th>Email</th>
                        <th>Fecha Venc.</th>
                        <th>Monto
                            <a href="{{URL::route('detallepagadas',array('monto' => 'desc','id' => $id,'page' => Request::get('page')))}}">
                                <i class="icono-verde fa fa-sort-numeric-desc"></i>
                            </a>
                            <a href="{{URL::route('detallepagadas',array('monto' => 'asc','id' => $id,'page' => Request::get('page')))}}">
                                <i class="icono-verde fa fa-sort-numeric-asc"></i>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($detalles as $detalle)
                        <tr>
                            {{--<td>{{$detalle->idnominasdetalle}}</td>--}}
                            <td>{{$detalle->nombre}}</td>
                            <td>{{$detalle->descripcion}}</td>
                            <td>{{$detalle->rut}}</td>
                            <td>{{$detalle->email}}</td>
                            <td>{{App\Extras\Utilidades::ImprimirFecha($detalle->fecha_vencimiento)}}</td>
                            <td>{{App\Extras\Utilidades::Moneda($detalle->monto)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! str_replace('/?', '?',$detalles->appends(Request::only(['monto','id']))->render()) !!}
                <a class="btn btn-primarynew btn-lg pull-right" href="{{ URL::action('CobrarController@pagadas')}}">Volver a Cuentas Pagadas</a>

            </div> <!-- por pagar -->



        </div><!--docs section-->
    </div><!--container end-->

@endsection