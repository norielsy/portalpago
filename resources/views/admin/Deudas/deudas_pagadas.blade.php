@extends('layouts.template_admin')
@include('admin.Deudas.modal_deudas_pagadas')
@include('admin.Deudas.eliminar')
@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Deudas pagadas</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {!! Session::get('message') !!}
        </div>
    @endif

    @if( $errors->count() > 0 )
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12 buscador_admin">
            {!! Form::open(['method' => 'get','class'=>'form-inline']) !!}
            <div class="form-group">
                <label>Rut Deudor</label>
                {!! Form::text('rut_deudor',Request::input('rut_deudor'),['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Rut Cobrador</label>
                {!! Form::text('rut_cobrador',Request::input('rut_cobrador'),['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label>Desde</label>
                {!! Form::text('desde',Request::input('desde'),['class' => 'form-control','id' => 'from']) !!}
            </div>

            <div class="form-group">
                <label>Hasta</label>
                {!! Form::text('hasta',Request::input('hasta'),['class' => 'form-control','id' => 'to']) !!}
            </div>

            <button type="submit" class="btn btn-default">Buscar</button>
            {!! Form::close() !!}
        </div>
        <?php $queryString = http_build_query(Request::all()); ?>
        <a class="btn btn-success" href="{{asset('admincp/pagadas/exportar?'.$queryString)}}">Exportar</a>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Para el ícono VER MÁS para detalles.

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Rut deudor</th>
                                <th>Rut cobrador</th>
                                <th>Empresa</th>
                                <th>Monto</th>
                                <th>Fecha pago</th>
                                <th>Tipo</th>
                                <th>Ver detalle</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($tabla as $fila)
                                    <tr>
                                        <td>{{$fila->idCobros}}</td>
                                        <td>{{$fila->rut}}</td>
                                        <td>{{$fila->rut_cobrador}}</td>
                                        <td>{{$fila->empresa}}</td>
                                        <td>{{App\Extras\Utilidades::Moneda($fila->monto)}}</td>
                                        <td>{{App\Extras\Utilidades::ImprimirFecha($fila->fecha_pago)}}</td>
                                        <td>
                                            @if($fila->tipo == 1)
                                                Individual
                                            @elseif($fila->tipo == 2)
                                                Nómina
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:;" attr-id="{{$fila->idCobros}}" attr-type="{{$fila->tipo}}" class="detalle_item_pagadas">
                                                <i class="icono-verde fa fa-plus-square"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="delete_item" attr-id="{{$fila->idCobros}}" attr-type="{{$fila->tipo}}">
                                                <i class="icono-verde fa fa-minus-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! str_replace('/?', '?',$tabla->appends(Request::only(['rut_deudor','rut_cobrador']))->render()) !!}
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <script src="{{ asset('public/js/admin/deudas.js')}}"></script>
    @yield('modal_deuda_pagadas')
    @yield('modal_eliminar')
@endsection
