<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ingresar</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('public/admin/bower_components/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('public/admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('public/admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('public/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">
    <div class="row">

        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                @if( $errors->count() > 0 )
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel-heading">
                    <h3 class="panel-title">Bienvenido</h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(['method' => 'POST','action' => 'Admin\AdminController@login_post']) !!}
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" name="rut" id="rut_main" type="text" placeholder="Ingrese su rut">
                            </div>
                            <div class="form-group">
                                <input type="password" name="passwordp" placeholder="Password" id="inputPassword" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-lg btn-success btn-block">Ingresar</button>
                        </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="{{ asset('public/admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script type="text/javascript" src="{{ asset('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Metis Menu Plugin JavaScript -->
<script type="text/javascript" src="{{ asset('public/admin/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script type="text/javascript" src="{{ asset('public/admin/dist/js/sb-admin-2.js')}}"></script>

</body>
</html>

