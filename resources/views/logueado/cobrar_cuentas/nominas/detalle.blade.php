@extends('template')

@include('logueado.cobrar_cuentas.nominas.detalle.popup_adjuntar')
@include('logueado.cobrar_cuentas.nominas.detalle.popup_editar_detalle')
@include('logueado.cobrar_cuentas.nominas.detalle.popup_eliminar_detalle')
@include('logueado.cobrar_cuentas.nominas.detalle.popup_pagar_detalle')


@section('title')
    Quiero Cobrar | Portal de Pagos
@endsection

@section('content')

    <!--container start-->
    <div class="component-bg">
        <input type="hidden" id="get_token" name="_token" value="{{ csrf_token() }}"/>
        <div class="container">


            @if(Session::has('ok'))
                <br/>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {!! Session::get('ok') !!}
                </div>
            @endif
            @if( $errors->count() > 0 )
                <br/>
                <div class="alert alert-danger" role="alert">
                    <strong>Se registro el(los) siguiente(s) error(es)</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1>Quiero Cobrar</h1>
            <div class="bs-docs-section">
                <h3>Detalle nómina <strong>{{$nombre}}</strong></h3>
                <table class="table listado listado-deudas-nominas table-hover top50">
                    <thead>
                    <tr>
                        {{--<th> #</th>--}}
                        <th> Nombre</th>
                        <th>Rut</th>
                        <th>Correo</th>
                        <th>Descripción</th>

                        <th class="text-right">
                            Monto
                            @if(Input::get('monto') != null && Input::get('monto') == 'asc')
                                <a href="{{URL::route('cobrarcuentasdetalle',array('monto' => 'desc','id' => $id,'page' => Request::get('page')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                </a>
                            @else
                                <a href="{{URL::route('cobrarcuentasdetalle',array('monto' => 'asc','id' => $id,'page' => Request::get('page')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                </a>
                            @endif
                        </th>
                        <th>Vencimiento
                            @if(Input::get('fecha') != null && Input::get('fecha') == 'asc')
                                <a href="{{URL::route('cobrarcuentasdetalle',array('fecha' => 'desc', 'id' => $id, 'page' => Request::get('page'), 'monto' => Request::get('monto')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                </a>
                            @else
                                <a href="{{URL::route('cobrarcuentasdetalle',array('fecha' => 'asc', 'id' => $id, 'page' => Request::get('page'), 'monto' => Request::get('monto')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                </a>
                            @endif

                        </th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <!--
                        <th class="op"></th>
                        <th class="op"></th>
                        -->
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($detalles as $detalle)
                        <tr>
                            {{--<td>{{$detalle->idnominasdetalle}}</td>--}}
                            <td>{{$detalle->nombre}}</td>
                            <td>{{$detalle->rut}}</td>
                            <td>{{$detalle->email}}</td>
                            <td>{{$detalle->descripcion}}</td>
                            <td>{{App\Extras\Utilidades::Moneda($detalle->monto)}}</td>
                            <td>{{App\Extras\Utilidades::ImprimirFecha($detalle->fecha_vencimiento)}}</td>


                            <td>
                                @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == 0 || \Illuminate\Support\Facades\Session::get('permiso_cobrador') == 2)
                                    <a href="javascript:;" class="editar_nominadetalle"
                                       attr-id="{{$detalle->idnominasdetalle}}">
                                        <i class="icono-verde fa fa-pencil-square-o "></i>
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == 0 || \Illuminate\Support\Facades\Session::get('permiso_cobrador') == 2)
                                    <a class="delete_items" href="javascript:;"
                                       attr-id="{{$detalle->idnominasdetalle}}">
                                        <i class="icono-verde fa fa-minus-square"></i>
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                        <!--
                            <td>
                                @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == 0 || \Illuminate\Support\Facades\Session::get('permiso_cobrador') == 2)
                            <a href="javascript:;" attr-id="{{$detalle->idnominasdetalle}}" class="btn btn-success btn-sm popup_pagar_nominas">Marcar como pagado</a>
                                @else
                            -
@endif
                                </td>
                                <td>
@if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == 0)
                            @if(empty($detalle->url_adjunto))
                                <a href="javascript:;" attr-id="{{$detalle->idnominasdetalle}}" class="btn btn-success btn-sm popup_adjuntar_nomina">Adjuntar</a>
                                    @else
                                <a href="{{asset("/d?download=".Crypt::encrypt("upload/individual/".$detalle->url_adjunto))}}" class="btn btn-success btn-sm">Descargar</a>
                                    @endif
                        @else
                            -
@endif
                                </td>
-->
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! str_replace('/?', '?',$detalles->appends(Request::only(['monto','id']))->render()) !!}
                <a class="btn btn-primarynew btn-lg pull-right" href="{{ URL::action('CobrarController@index')}}">Volver
                    a Cobrar Cuentas</a>

            </div> <!-- por pagar -->

        </div><!--docs section-->
    </div><!--container end-->



    <script src="{{ asset('public/js/services/cobros.js')}}"></script>
    <script src="{{ asset('public/js/validaciones/validation_marcapagado_pagar.js')}}"></script>
    <script src="{{ asset('public/js/validaciones/validation_editar_nomina_detalle.js')}}"></script>

    @yield('modal_detalle_adjuntar_nomina')
    @yield('modal_detalle_editar')
    @yield('modal_detalle_eliminar')
    @yield('modal_detalle_pagar')

@endsection
