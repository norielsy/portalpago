@extends('template')

@include('logueado.cobrar_cuentas.individual.popup_adjuntar')
@include('logueado.cobrar_cuentas.individual.popup_eliminar_individual')
@include('logueado.cobrar_cuentas.individual.popup_editar_individual')
@include('logueado.cobrar_cuentas.individual.popup_pagar_cuenta')

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
        <div class="container">

            @include('logueado.publicidad')
            @yield('content_publicidad')
            <div class="row">
                <div class="col-xs-12 hidden-lg hidden-md hidden-sm top25">
                    <a class="btn btn-main btn-block custom-btn" href="{{asset("cobrar-cuentas/individuales")}}">Cargar
                        cobro
                        individual</a>
                    <a class="btn btn-main btn-block custom-btn" href="{{asset("cobrar-cuentas/nominas")}}">Cargar
                        Nómina de
                        cobros</a>
                </div>
            </div>
            @if( $errors->count() > 0 )
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(Session::has('ok'))
                <br/>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {!! Session::get('ok') !!}
                </div>
            @endif

            @if(Session::has('error'))
                <br/>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    {!! Session::get('error') !!}
                </div>
            @endif
            <h1 class="main-text">Cobros Pendientes</h1>
            <div class="bs-docs-section">
                @include('logueado.cobrar_cuentas.menu_cobros')
                {{--@yield('menu_cobros')--}}

                @if($tabla->total() >= 11 || Request::get('empresa') || Request::get('rut') != "")
                    {!! Form::open(['method' => 'GET','class'=>'form-inline form-buscar-tabla add_cobros_v1']) !!}
                    <div class="form-group">
                        <label for="exampleInputName2">Empresa</label>
                        {!! Form::select('empresa',['' => 'Seleccione Nombre/empresa'] + $lista_empresas,$item_seleccionado,['class' => 'form-control input-sm border-radius']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">Rut</label>
                        {!! Form::text('rut',Request::get('rut'),['class' => 'form-control']) !!}
                    </div>
                    <button class="btn btn-sm btn-primarynew btn-filtro" type="submit">Filtrar</button>
                    {!! Form::close() !!}
                @endif
                <table class="table table-hover listado listado-cobro-pendiente">
                    <thead>
                    <tr>
                        {{--<th>#</th>--}}
                        <th>RUT</th>
                        <th>Nombre/Empresa</th>
                        <th>Descripción</th>
                        <th>Monto ($)
                            @if(Input::get('monto') != null && Input::get('monto') == 'asc')
                                <a href="{{URL::route('cobrarcuentastodo',array('monto' => 'desc','page' => Request::get('page'), 'fecha' => Request::get('fecha')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                </a>
                            @else
                                <a href="{{URL::route('cobrarcuentastodo',array('monto' => 'asc','page' => Request::get('page'), 'fecha' => Request::get('fecha')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                </a>
                            @endif
                        </th>
                        <th>Vencimiento
                            @if(Input::get('fecha') != null && Input::get('fecha') == 'asc')
                                <a href="{{URL::route('cobrarcuentastodo',array('fecha' => 'desc','page' => Request::get('page'), 'monto' => Request::get('monto')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                </a>
                            @else
                                <a href="{{URL::route('cobrarcuentastodo',array('fecha' => 'asc','page' => Request::get('page'), 'monto' => Request::get('monto')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                </a>
                            @endif
                        </th>
                        <th class="text-center"><small>Editar</small></th>
                        <th class="text-center"><small>Eliminar</small></th>
                        <th class="text-center"><small>Registrar Pago</small></th>
                        <th class="text-center"><small>Adjuntar</small></th>
                        <!--<th>Tipo</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tabla as $fila)
                        <tr>
                            {{--<td>{{$fila->idCobros}}</td>--}}
                            <td>{{App\Helper\Rut::rut($fila->rut)}}</td>
                            <td>{{$fila->empresa}}</td>
                            <td>{{$fila->descripcion}}</td>
                            <td>{{App\Extras\Utilidades::Moneda($fila->monto)}}</td>
                            <td>{{App\Extras\Utilidades::ImprimirFecha($fila->fecha_vencimiento)}}</td>
                            <td class="text-center">
                                <div class="center-all">
                                    @if($fila->tipo == 1)
                                        <a href="javascript:;" class="editar_cobros_puntuales"
                                           attr-id="{{$fila->idCobros}}">
                                            <i class="icono-verde fa fa-pencil-square-o "></i>
                                        </a>
                                    @elseif($fila->tipo == 2)
                                        <a href="javascript:;" class="editar_nominadetalle"
                                           attr-id="{{$fila->idCobros}}">
                                            <i class="icono-verde fa fa-pencil-square-o "></i>
                                        </a>
                                    @endif

                                <!--                                add hidden-->
                                    @if($fila->tipo == 1)
                                        <a href="javascript:;" class="delete_items_individual no-show"
                                           attr-id="{{$fila->idCobros}}">
                                            <i class="icono-verde fa fa-times"></i>
                                        </a>
                                    @elseif($fila->tipo == 2)
                                        <a href="javascript:;" class="delete_items no-show"
                                           attr-id="{{$fila->idCobros}}">
                                            <i class="icono-verde fa fa-times"></i>
                                        </a>
                                    @endif
                                    @if($fila->tipo == 1)
                                        <a href="javascript:;" attr-id="{{$fila->idCobros}}"
                                           class="popup_pagar_cobros no-show"><i
                                                    class="icono-verde fa fa-usd" aria-hidden="true"></i></a>
                                    @elseif($fila->tipo == 2)
                                        <a href="javascript:;" attr-id="{{$fila->idCobros}}"
                                           class="popup_pagar_nominas no-show"><i
                                                    class="icono-verde fa fa-usd" aria-hidden="true"></i></a>
                                    @endif
                                    @if($fila->tipo == 1)
                                        @if(empty($fila->url_adjunto))
                                            <a href="javascript:;" attr-id="{{$fila->idCobros}}"
                                               class="popup_adjuntar_individual no-show"><i
                                                        class="icono-verde fa fa-file-text"
                                                        aria-hidden="true"></i></a>
                                        @else
                                            <a href="{{asset("/d?download=".Crypt::encrypt("upload/individual/".$fila->url_adjunto))}}"
                                               class="btn btn-success btn-sm no-show">Descargar</a>
                                        @endif
                                    @elseif($fila->tipo == 2)
                                        @if(empty($fila->url_adjunto))
                                            <a href="javascript:;" attr-id="{{$fila->idCobros}}"
                                               class="popup_adjuntar_nomina no-show"><i
                                                        class="icono-verde fa fa-file-text"
                                                        aria-hidden="true"></i></a>
                                        @else
                                            <a href="{{asset("/d?download=".Crypt::encrypt("upload/individual/".$fila->url_adjunto))}}"
                                               class="btn btn-success btn-sm no-show">Descargar</a>
                                        @endif
                                    @endif</div>

                            </td>
                            <td class="text-center hidde">
                                @if($fila->tipo == 1)
                                    <a href="javascript:;" class="delete_items_individual"
                                       attr-id="{{$fila->idCobros}}">
                                        <i class="icono-verde fa fa-times"></i>
                                    </a>
                                @elseif($fila->tipo == 2)
                                    <a href="javascript:;" class="delete_items" attr-id="{{$fila->idCobros}}">
                                        <i class="icono-verde fa fa-times"></i>
                                    </a>
                                @endif
                            </td>
                            <td class="text-center hidde">
                                @if($fila->tipo == 1)
                                    <a href="javascript:;" attr-id="{{$fila->idCobros}}" class="popup_pagar_cobros"><i
                                                class="icono-verde fa fa-usd" aria-hidden="true"></i></a>
                                @elseif($fila->tipo == 2)
                                    <a href="javascript:;" attr-id="{{$fila->idCobros}}" class="popup_pagar_nominas"><i
                                                class="icono-verde fa fa-usd" aria-hidden="true"></i></a>
                                @endif
                            </td>
                            <td class="text-center hidde">
                                @if($fila->tipo == 1)
                                    @if(empty($fila->url_adjunto))
                                        <a href="javascript:;" attr-id="{{$fila->idCobros}}"
                                           class="popup_adjuntar_individual"><i class="icono-verde fa fa-file-text"
                                                                                aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{asset("/d?download=".Crypt::encrypt("upload/individual/".$fila->url_adjunto))}}"
                                           class="btn btn-success btn-sm">Descargar</a>
                                    @endif
                                @elseif($fila->tipo == 2)
                                    @if(empty($fila->url_adjunto))
                                        <a href="javascript:;" attr-id="{{$fila->idCobros}}"
                                           class="popup_adjuntar_nomina"><i class="icono-verde fa fa-file-text"
                                                                            aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{asset("/d?download=".Crypt::encrypt("upload/individual/".$fila->url_adjunto))}}"
                                           class="btn btn-success btn-sm">Descargar</a>
                                    @endif
                                @endif
                            </td>
                        <!--<td>
                                    @if($fila->tipo == 1)
                            Individual
@elseif($fila->tipo == 2)
                            Nómina
@endif
                                </td>-->
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--@if($tabla->total() >= 11 || Request::get('empresa') || Request::get('rut') != "")
                    {!! Form::open(['method' => 'GET','class'=>'form-inline form-buscar-tabla']) !!}
                    <div class="form-group">
                        <label for="exampleInputName2">Empresa</label>
                        {!! Form::select('empresa',['' => 'Seleccione Nombre/empresa'] + $lista_empresas,$item_seleccionado,['class' => 'form-control input-sm border-radius']) !!}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">Rut</label>
                        {!! Form::text('rut',$buscar_rut,['class' => 'form-control']) !!}
                    </div>
                    <button class="btn btn-sm btn-primarynew btn-filtro" type="submit">Filtrar</button>
                    {!! Form::close() !!}
                @endif--}}

                {!! str_replace('/?', '?',$tabla->appends(Request::only(['rut','empresa','monto', 'fecha']))->render()) !!}

                <div class="separador-exportar">
                    <a class="btn btn-sm btn-primarynew pull-right" href="{{ asset('cobrar-cuentas/todo/exportar')}}">Exportar
                        Datos</a>
                </div>
            </div><!--tab-content-->
        </div><!--docs section-->
    </div><!--container end-->
    </div><!--component-bg-->


    <script src="{{ asset('public/js/services/cobros.js')}}"></script>
    <script src="{{ asset('public/js/validaciones/validation_cobrospuntales.js')}}"></script>
    <script src="{{ asset('public/js/validaciones/validation_adjunto.js')}}"></script>
    <script src="{{ asset('public/js/validaciones/validation_marcapagado_pagar.js')}}"></script>

    <script src="{{ asset('public/js/validaciones/validation_editar_nomina_detalle.js')}}"></script>

    @yield('modal_adjuntar_individual')
    @yield('modal_editar_individual')
    @yield('modal_pagar_cuenta_individual')
    @yield('modal_eliminar_individual')

    @yield('modal_detalle_adjuntar_nomina')
    @yield('modal_detalle_editar')
    @yield('modal_detalle_eliminar')
    @yield('modal_detalle_pagar')
@endsection
