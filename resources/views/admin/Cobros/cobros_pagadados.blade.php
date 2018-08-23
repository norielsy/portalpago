@extends('layouts.template_admin')

@section('title')
    Admin Portal de Pago
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Listado de usuarios</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Para ver más detalles presione EDITAR

                    <span class="tipos-usuarios pull-right"><i class="fa fa-user usuario-deudor"></i> Deudor | <i class="fa fa-user usuario-cobrador"></i> Cobrador | <i class="fa fa-user usuario-operador"></i> Operador | <i class="fa fa-user usuario-consultor"></i> Consultor</span>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Rut</th>
                                <th>Empresa</th>
                                <th>Email</th>
                                <th>Tipo de usuario</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>111</td>
                                <td>222</td>
                                <td>333</td>
                                <td>@email.cl</td>
                                <td> <i title="Deudor" class="fa fa-user usuario-deudor"></i> </td>
                                <td><a href="#" data-toggle="modal" data-target="#myModal"><i class="icono-verde fa fa-pencil-square-o "></i></a></td>
                                <td><a href="#"><i class="icono-verde fa fa-minus-square"></i></a></td>

                            </tr>
                            <tr>
                                <td>111</td>
                                <td>222</td>
                                <td>333</td>
                                <td>@email.cl</td>
                                <td>
                                    <i class="fa fa-user usuario-cobrador"></i>
                                    <i class="fa fa-user usuario-operador"></i>

                                </td>
                                <td><a href="#"><i class="icono-verde fa fa-pencil-square-o "></i></a></td>
                                <td><a href="#"><i class="icono-verde fa fa-minus-square"></i></a></td>

                            </tr>
                            <tr>
                                <td>111</td>
                                <td>222</td>
                                <td>333</td>
                                <td>@email.cl</td>
                                <td>
                                    <i class="fa fa-user usuario-deudor"></i>
                                    <i class="fa fa-user usuario-cobrador"></i>
                                </td>
                                <td><a href="#"><i class="icono-verde fa fa-pencil-square-o "></i></a></td>
                                <td><a href="#"><i class="icono-verde fa fa-minus-square"></i></a></td>

                            </tr>
                            <tr>
                                <td>111</td>
                                <td>222</td>
                                <td>333</td>
                                <td>@email.cl</td>
                                <td> <i class="fa fa-user usuario-consultor"></i> </td>
                                <td><a href="#"><i class="icono-verde fa fa-pencil-square-o "></i></a></td>
                                <td><a href="#"><i class="icono-verde fa fa-minus-square"></i></a></td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection
