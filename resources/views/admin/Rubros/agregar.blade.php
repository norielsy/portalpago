@extends('layouts.template_admin')

@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Ingresar Rubro </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Rubro</label>
                                    {!! Form::text('rubro',null,['class' => 'form-control','placeholder' => 'Ingresar nombre del rubro']) !!}
                                </div>
                            </div>
                            <button class="btn btn-success pull-right" type="submit">Agregar</button>
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