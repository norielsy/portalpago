@extends('template')

@section('title')
Consultar Cobros | Portal de Pagos
@endsection

@section('content')
<!--breadcrumbs start-->

<section class="bgx">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h1>
                    Pagos Pendientes
                </h1>
            </div>

        </div>
        <div class="form-wrapper">

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

                    {!! Form::open(['id' => 'consultar_deuda', 'method' => 'post','class' => 'form-consulta-deuda','action' => 'HomeController@resultados', ]) !!}
                    <h2 class="form-signin-heading">Consulta tus pagos pendientes</h2>

                    <div class="login-wrap">
                        <div class="form-group">
                            <label>Rut</label>
                            <input type="text" name="rut" id="rut_main" placeholder="Ingrese su rut"
                            class="form-control rut_input_point">
                        </div>

                        {!! app('captcha')->display() !!}

                        <label class="checkbox">
                            <div class="text-center">
                                <a href="javascript:;" id="btn_recuperar_pwd"></a>
                            </div>
                        </label>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primarynew btn-block btn-consultar">
                                Consultar
                            </button>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>

        <!-- cierre form-wrapper-->
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center feature-head">
                    <h3 class="">
                        ¿Aún no utilizas Portal de Pagos?
                        <span class="top15 hidden-lg hidden-md"></span>
                        <a href="registro" class="btn btn-registro">
                            Regístrate ahora
                        </a>
                    </h3>
                </div>

            </div>
        </div>

    </div>
</section>


@endsection
