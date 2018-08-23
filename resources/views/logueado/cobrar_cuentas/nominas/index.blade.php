@extends('template')
@include('logueado.cobrar_cuentas.nominas.popup_eliminar_nomina')
@section('title')
    Quiero Cobrar | Portal de Pagos
@endsection

@section('content')
    <!--container start-->
    <div class="component-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 hidden-lg hidden-md hidden-sm top25">
                    <a class="btn btn-main btn-block custom-btn" href="{{asset("cobrar-cuentas/individuales")}}">Cargar cobro
                        individual</a>
                    <a class="btn btn-main btn-block custom-btn disabled" disabled="disabled"
                       href="{{asset("cobrar-cuentas/nominas")}}">Cargar Nómina de cobros</a>
                </div>
            </div>

            @include('logueado.publicidad')
            @yield('content_publicidad')

            <h1 class="main-text">Cargar Nóminas</h1>

            <div class="bs-docs-section">
                @include('logueado.cobrar_cuentas.menu_cobros')
                {{--@yield('menu_cobros')--}}

                <div class="tab-content">
                    <div id="nominas" class="tab-pane fade in active">

                        <div class="row well">
                            <div class="col-xs-12">
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
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        {!! Session::get('ok') !!}
                                    </div>
                                @endif

                                @if(Session::has('error_excel'))
                                    <br/>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        {!! Session::get('error_excel') !!}
                                    </div>
                                @endif

                                @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == 0 || \Illuminate\Support\Facades\Session::get('permiso_cobrador') == 2)

                                    @if(Session::get('nro_cuenta') != null || Session::get('nro_cuenta') != "")
                                        {!! Form::open(['method' => 'POST','class'=>'add_cobros_v1','id' => 'nomina_form','files' => true]) !!}

                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label" for="empresa"> <b>1.</b> Nombre
                                                    Nómina</label>

                                                {!! Form::text('empresa',null,['class' => 'form-control','placeholder' => 'Nombre de nómina']) !!}


                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="inputEmail3"><b>2.</b> Adjuntar Nómina</label>
                                                <!--<input type="file" id="exampleInputFile">-->
                                                {!! Form::file('excel', ['class' => 'file file_upload', 'data-show-preview' =>"false", 'id' => 'file_nomina']) !!}

                                                <p class="text-info">
                                                    <small>Formatos: excel, extensión: xls, xlsx - Tamaño máximo:
                                                        1mb
                                                    </small>
                                                </p>
                                                <div class="row">
                                                    <a class="btn btn-link btn"
                                                       href="{{ asset('public/examples/ejemplo_nomina.xlsx')}}"><i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                         Descargar nómina ejemplo</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><b>3.</b> Adjuntar documento de respaldo (opcional)
                                                    <a href="#" data-toggle="tooltip" data-placement="right" title="Puede agregar documentos como Factura, Orden de compra, Gasto común, etc."><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
                                                {!! Form::file('voucher', ['class' => 'file file_upload', 'data-show-preview' =>"false",]) !!}

                                                <p class="text-info">
                                                    <small>Puede agregar documentos como Factura, Orden de compra, Gasto común, etc.</small>
                                                    </p>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>
                                <div class="col-lg-2 col-md-2 col-xs-12 col-sm-3 pull-right">
                                                <div class="form-group">
                                                        <button class="btn btn-primarynew btn-sm btn-block" type="submit">
                                                            Agregar Cobros
                                                        </button>

                                                </div>

                                            </div>

                            </div>
                            {!! Form::close() !!}
                            @else
                                @include('logueado.cobrar_cuentas.advertencia_banco')
                                @yield('alerta_banco')
                            @endif
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">


                            <h3>Nóminas Actuales</h3>


                            @if($cobros->total() >= 11 || Request::get('empresa') || Request::get('rut') != "")
                                {!! Form::open(['method' => 'GET','class'=>'form-inline form-buscar-tabla']) !!}
                                <div class="form-group">
                                    <label for="exampleInputName2">Nombre</label>
                                    {!! Form::select('empresa',['' => 'Seleccione Nombre/empresa'] + $empresas,$item_seleccionado,['class' => 'form-control input-sm border-radius']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Rut</label>
                                    {!! Form::text('rut',$buscar_rut,['class' => 'form-control']) !!}
                                </div>
                                <button class="btn btn-sm btn-primarynew btn-filtro" type="submit">Filtrar</button>
                                {!! Form::close() !!}
                            @endif

                            <table class="table listado listado-nominas table-hover">
                                <thead>
                                <tr>
                                    {{--<th> #</th>--}}
                                    <!--<th>Rut</th>-->
                                    <th>Nombre</th>
                                    <!--<th>Descripción</th>-->
                                    <th class="text-center">Fecha de carga</th>
                                <!--<th>Fecha vencimiento
                                <a href="{{URL::route('cobrarcuentas',array('fecha' => 'desc','page' => Request::get('page')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-desc"></i>
                                </a>
                                <a href="{{URL::route('cobrarcuentas',array('fecha' => 'asc','page' => Request::get('page')))}}">
                                    <i class="icono-verde fa fa-sort-numeric-asc"></i>
                                </a>
                            </th>-->
                                    <th class="text-center">Subido por</th>
                                    <th class="text-center">Ver detalle</th>
                                    <th class="text-center">Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cobros as $cobro)
                                    <tr>
                                        {{--<td>{{$cobro->idnominas}}</td>--}}
                                    <!--<td>{{$cobro->rut}}</td>-->
                                        <td>{{$cobro->empresa}}</td>
                                    <!--<td>{{$cobro->descripcion}}</td>-->
                                        <td class="text-center">{{App\Extras\Utilidades::ImprimirFecha($cobro->created_at)}}</td>
                                    <!--<td>{{App\Extras\Utilidades::ImprimirFecha($cobro->fecha_vencimiento)}}</td>-->
                                        <td class="text-center">
                                            @if($cobro->apellido != null)
                                                {{$cobro->nombre.' '.$cobro->apellido}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ asset('cobrar-cuentas/nominas/detalle/'.($cobro->idnominas))}}">
                                                <i class="icono-verde fa fa-plus-circle"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            @if(\Illuminate\Support\Facades\Session::get('idvista_cobrador') == 0 || \Illuminate\Support\Facades\Session::get('permiso_cobrador') == 2)
                                                <a class="delete_items" href="javascript:;"
                                                   attr-id="{{$cobro->idnominas}}">
                                                    <i class="icono-verde fa fa-minus-square"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! str_replace('/?', '?',$cobros->appends(Request::only(['fecha','empresa']))->render()) !!}
                            <div class="separador-exportar">
                                <a class="btn btn-sm btn-primarynew pull-right"
                                   href="{{ asset('cobrar-cuentas/todo/exportar')}}">Exportar Datos</a>
                            </div>
                        </div>
                    </div>


                </div> <!-- nominas -->

            </div><!--tab-content-->

        </div><!--docs section-->
    </div><!--container end-->
    </div><!--component-bg-->

    @yield('modal_eliminar_nomina')
    @if(Session::has('ok_doc'))
        @include('logueado.cobrar_cuentas.nominas.popup_adjunto_masivo')
        @yield('modal_adjuntar_nomina_masivo')
    @endif
    <script src="{{ asset('public/js/validaciones/validation_nomina.js')}}"></script>
@endsection
