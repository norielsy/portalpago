@section('form_noregistrado')
    <div id="form_noregistrado" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            {!! Form::open(['method' => 'POST','id' => 'form_edit_no_usuario_main','action' => 'Admin\UsuarioController@editar_no_registrado']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"># ID cliente deudor</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rut Deudor</label>
                                <input class="form-control" id="nor_rut" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                {!! Form::text('email',null,['class' => 'form-control','id' => 'nor_email']) !!}
                            </div>
                            <div class="form-group">
                                <label>Ingresado por</label>
                                <input class="form-control" id="nor_ingresado_por" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Deudas Asociadas</label>
                                <input class="form-control" id="total_deudas_noregistrado" disabled="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre Empresa</label>
                                {!! Form::text('nombre_empresa',null,['class' => 'form-control','id' => 'nor_empresa']) !!}
                            </div>
                            <div class="form-group">
                                <label>Fecha de registro</label>
                                <input class="form-control" id="nor_fecha_registro" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Empresa</label>
                                <input class="form-control" id="nor_empresa" disabled="">
                            </div>

                            <div class="form-group">
                                <label>Último Log.</label>
                                <input class="form-control" id="disabledInput" disabled="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="rut_noregistrado" id="rut_noregistrado">
                    <button class="btn btn-outline btn-success" type="submit">Editar</button> 
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection