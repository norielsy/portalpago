@section('modal_agregar')
    <div id="modal_agregar_cobradores" class="modal fade modal_new_g1" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['method' => 'get','class'=>'modal-content form-horizontal','id' => 'form_new_cobrador']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nuevo Usuario</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="rut_empresa">Rut</label>
                        <div class="col-sm-6">
                            {!! Form::text('rut_cobrador',null,['class' => 'form-control rut_input_point','id' => 'rut_cobrador']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="empresa">Perfil</label>
                        <div class="col-sm-6">
                            {!! Form::select('perfil',$categorias_popup,null,['class' => 'form-control','id' => 'perfil_cobrador']) !!}
                        </div>
                    </div>
                    <div class="tabla_op1">
                        <table class="table listado-deudas table-hover top50">
                            <thead>
                            <tr>
                                <th> Funciones (solo con su rut) </th>
                                <th> Consultivo </th>
                                <th>Operativo</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Consultar Deudores</td>
                                <td><i class="fa fa-check-square-o"></i></td>
                                <td><i class="fa fa-check-square-o"></i></td>
                            </tr>
                            <tr>
                                <td>Consultar Deudas</td>
                                <td><i class="fa fa-check-square-o"></i></td>
                                <td><i class="fa fa-check-square-o"></i></td>
                            </tr>
                            <tr>
                                <td>Crear Cobro</td>
                                <td><i class="fa fa-circle-o"></i></td>
                                <td><i class="fa fa-check-square-o"></i></td>
                            </tr>
                            <tr>
                                <td>Editar Cobro</td>
                                <td><i class="fa fa-circle-o"></i></td>
                                <td><i class="fa fa-check-square-o"></i></td>
                            </tr>
                            <tr>
                                <td>Eliminar Cobro</td>
                                <td><i class="fa fa-circle-o"></i></td>
                                <td><i class="fa fa-check-square-o"></i></td>
                            </tr>
                            <tr>
                                <td>Cargar Nóminas de cobro</td>
                                <td><i class="fa fa-circle-o"></i></td>
                                <td><i class="fa fa-check-square-o"></i></td>
                            </tr>
                            <tr>
                                <td>Editar Nóminas de cobro</td>
                                <td><i class="fa fa-circle-o"></i></td>
                                <td><i class="fa fa-check-square-o"></i></td>
                            </tr>
                            <tr>
                                <td>Eliminar Nóminas de cobro</td>
                                <td><i class="fa fa-circle-o"></i></td>
                                <td><i class="fa fa-check-square-o"></i></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button> <button type="button" id="verificar_cobrador" class="btn btn-primarynew">Agregar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


    <div id="modal_advertencia_cobros" class="modal fade modal_new_g1" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['method' => 'get','class'=>'modal-content form-horizontal']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Advertencia</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="text-center alert-info alert_pr">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        <span id="mensaje_json_show"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div id="modal_no_registrado" class="modal fade modal_new_g1" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['method' => 'get','class'=>'modal-content form-horizontal','id' => 'form_send_email']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Usuario no registrado</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="text-center alert-info alert_pr">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        El usuario registrado no existe. ¿deseas envíar una notificación de registro?
                    </div>
                    <br/>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="rut_empresa">Email</label>
                        <div class="col-sm-6">
                            {!! Form::text('email',null,['class' => 'form-control','id' => 'email_notificacion_registro']) !!}
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btn_enviar_email" class="btn btn-success">Enviar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection