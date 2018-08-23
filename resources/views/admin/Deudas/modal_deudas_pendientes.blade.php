@section('modal_deuda_pendiente')
    <div id="editar-deuda" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            {!! Form::open(['method' => 'POST','id' => 'form_registro_main','class'=>'form-signin wow fadeInUp','action' => 'Admin\DeudasController@editar']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"># ID de la deuda</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rut Deudor</label>
                                <input name="rut_deudor_pen" id="rut_deudor_pen" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nombre Empresa Deudora</label>
                                <input name="empresa_deudor_pen" id="empresa_deudor_pen" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email_pen" id="email_pen" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea rows="5" name="descripcion_pen" id="descripcion_pen" class="form-control"></textarea>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha de vencimiento</label>
                                <input name="fecha_vencimiento_pen" id="fecha_vencimiento_pen" class="form-control datepicker_all">
                            </div>
                            <div class="form-group">
                                <label>Monto</label>
                                <input name="monto_pen" id="monto_pen" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Rut Cobrador</label>
                                <input name="rut_cobrador_pen" id="rut_cobrador_pen" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label>Empresa Cobradora</label>
                                <input name="empresa_cobrador_pen" id="empresa_cobrador_pen" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nómina asociada <span class="small">(Si corresponde)</span></label>
                                <input class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_edit" id="id_edit">
                    <input type="hidden" name="tipo_edit" id="tipo_edit">
                    <button class="btn btn-outline btn-success" type="submit">Editar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection