@extends('layouts.template_admin')

@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Ingresar forma de pago</h1>
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

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::open(['method' => 'POST','id' => 'form_agregar_pago','class'=>'form-signin wow fadeInUp']) !!}
                            <div class="form-group">
                                <label class="control-label">Forma de pago</label>
                                {!! Form::text('pago',null,['class' => 'form-control','placeholder' => 'Escriba la forma de pago']) !!}
                            </div>

                            <button class="btn btn-success pull-right" type="submit">Agregar</button>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/js/admin/validaciones/val_form_pago.js')}}"></script>
@endsection