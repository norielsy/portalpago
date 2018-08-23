@extends('layouts.template_admin')

@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Ingresar cobro individual</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Para ingresar un nuevo cobro debe asignar un usuario existente.
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

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        {!! Form::open(['method' => 'POST','id' => 'form_cobrospuntuales','class'=>'form-signin wow fadeInUp']) !!}
                            <div class="col-lg-6">

                                    <div class="form-group  has-feedback">
                                        <label>Rut Cobrador</label>
                                        {!! Form::text('rut_cobrador',null,['class' => 'form-control','id' => 'id_rut_cobrador']) !!}
                                        <span class="glyphicon glyphicon-ok form-control-feedback" id="ok_rut_input" style="display:none" aria-hidden="true"></span>
                                        <span class="glyphicon glyphicon-remove form-control-feedback" id="error_rut_input" style="display:none" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre Empresa</label>
                                        <input class="form-control" id="nombre_empresa2" disabled>

                                    </div>

                                    <div class="form-group">
                                        <label>Rut deudor</label>
                                        {!! Form::text('rut_empresa',null,['class' => 'form-control']) !!}

                                    </div>

                                    <div class="form-group">
                                        <label>Empresa Deudora</label>
                                        {!! Form::text('empresa',null,['class' => 'form-control']) !!}

                                    </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email Deudor</label>
                                    {!! Form::text('email',null,['class' => 'form-control']) !!}

                                </div>

                                <div class="form-group">
                                    <label>Monto Deuda</label>
                                    {!! Form::text('monto',null,['class' => 'form-control']) !!}

                                </div>

                                <div class="form-group">
                                    <label>Fecha vencimiento</label>
                                    {!! Form::text('fecha_vencimiento',null,['class' => 'form-control datepicker_all']) !!}

                                </div>

                                <div class="form-group">
                                    <label>Descripción</label>
                                    {!! Form::textarea('descripcion',null,['class' => 'form-control','rows' => '4']) !!}
                                </div>

                                <button class="btn btn-success" type="submit">Ingresar</button>
                                <button class="btn btn-default" type="reset">Limpiar campos</button>


                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        {!! Form::close() !!}
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <script src="{{ asset('public/js/admin/cobros.js')}}"></script>
    <script src="{{ asset('public/js/admin/validaciones/val_agregar_individual.js')}}"></script>
@endsection