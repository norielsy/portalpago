@extends('layouts.template_admin')

@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Ingresar nuevo usuario </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Complete los campos para ingresar un nuevo usuario.
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
                    {!! Form::open(['method' => 'POST','id' => 'form_registro_main','class'=>'form-signin wow fadeInUp']) !!}
                    <div class="row">
                        <div class="col-lg-6">
                            <h3>Responsable de la cuenta</h3>


                                <div class="form-group">
                                    <label class="control-label">Nombre</label>
                                    {!! Form::text('nombre',null,['class' => 'form-control','placeholder' => 'Nombres']) !!}
                                </div>

                                <div class="form-group">
                                    <label>Apellido</label>
                                    {!! Form::text('apellido',null,['class' => 'form-control','placeholder' => 'Apellidos']) !!}

                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    {!! Form::text('email',null,['class' => 'form-control','placeholder' => 'Email']) !!}

                                </div>

                                <div class="form-group">
                                    <label>Teléfono Fijo</label>
                                    {!! Form::text('telefono',null,['class' => 'form-control','placeholder' => 'Teléfono Fijo']) !!}

                                </div>
                                <!--
                                <div class="form-group">
                                    <label>Celular</label>
                                    {!! Form::text('celular',null,['class' => 'form-control','placeholder' => 'Celular']) !!}
                                </div>
                                -->

                                <div class="form-group">
                                    <label>Clave</label>
                                    {!! Form::password('passwordp',['class' => 'form-control','id' => 'passwordp2','placeholder' => 'Clave']) !!}

                                </div>

                                <div class="form-group">
                                    <label>Confirmar Clave</label>
                                    {!! Form::password('passwordp_confirmation',['class' => 'form-control','placeholder' => 'Confirmar Clave']) !!}
                                </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->

                        <div class="col-lg-6">
                            <h3>Información de la empresa</h3>

                            <div class="form-group">
                                <label>Rut</label>
                                {!! Form::text('rut',null,['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>Nombre / Razón social</label>
                                {!! Form::text('razon_social',null,['class' => 'form-control']) !!}

                            </div>

                            <div class="form-group">
                                <label>Dirección</label>
                                {!! Form::text('direccion',null,['class' => 'form-control','placeholder' => 'Calle, avenida u otro']) !!}
                            </div>

                            <div class="form-group">
                                <label>Región</label>
                                <select class="form-control input-sm " name="IDRegion">
                                    @foreach($regiones as $region)
                                        <option value="{{$region->IDRegion}}">{{$region->region}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Giro</label>
                                <select class="form-control input-sm " name="idrubros">
                                    @foreach($rubros as $rubro)
                                        <option value="{{$rubro->idrubros}}">{{$rubro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tipo de usuario</label>
                                <select class="form-control" name="tipo_usuario">
                                    <option value="0">Cobrador / Deudor</option>
                                    <option value="operativo">Operativo</option>
                                    <option value="consultivo">Consultivo</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Rut asociado</label>
                                <input type="text" name="rut_hijo" class="form-control">
                                <p class="help-block small">*Solo para usuarios operativos o consultivos</p>
                            </div>


                            <button class="btn btn-success pull-right" type="submit">Ingresar usuario</button>
                            <button class="btn btn-default pull-right" style="margin-right:20px;" type="reset">Limpiar campos</button>

                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

@endsection