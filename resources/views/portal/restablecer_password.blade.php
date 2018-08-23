@extends('template')

@section('title')
    Restablecer contraseña | Portal de Pagos
    @endsection

@section('content')
            <!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <h1 class="top10">
                        Restablecer clave
                    </h1>
                </div>

            </div>
        </div>
    </div>

    <div class="container password_restablecer">

        @if( $errors->count() > 0 )
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['method' => 'POST','action' => 'HomeController@reset_post_password']) !!}
                <div class="form-group">
                    <label>Nueva clave</label>
                    <input type="password" name="pwd1" class="form-control">
                </div>

                <div class="form-group">
                    <label>Confirmar clave</label>
                    <input type="password" name="pwd1_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <input type="hidden" name="f" value="{{$email}}">
                    <button type="submit" class="btn btn-success">Restablecer clave</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection