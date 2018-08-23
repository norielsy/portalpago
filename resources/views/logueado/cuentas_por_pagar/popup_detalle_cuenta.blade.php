@section('modal_detalle_pagar_cuenta')
    <div id="modal_item_pagado2" class="modal fade" role="dialog">
        <div class="modal-dialog sp">
            {!! Form::open(['method' => 'post','id' => 'form_item_pagado','class'=>'modal-content form-horizontal','action' => 'PagarController@pagarcuenta']) !!}
            <div class="modal-header how-to">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pagar Cuenta vía Transferencia Electrónica</h4>
            </div>
            <div class="modal-body sp">
                <div class="row">
                    <div class="col-sm-12">
                        <p>Para realizar el pago de tu cuenta vía transferencia electrónica:
                        <br>1) Ingresa a la página de tu banco, seleccionando la opción de “transferencia”
                        <br>2) Utiliza los siguientes datos en tu transferencia:</p>
                        <table class="table table-bordered table-striped table-condensed table-responsive pptable">
                            <tbody>
                                <tr>
                                    <td>
                                        Banco a transferir
                                    </td>
                                    <td>
                                        <span id="nombre_banco_show"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Rut
                                    </td>
                                    <td>
                                        <span id="rut_cuenta_show"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nombre/Razon Social
                                    </td>
                                    <td>
                                        <span id="nombre_razon_social_show"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tipo Cuenta
                                    </td>
                                    <td>
                                        <span id="tipo_cuenta_show"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Número de cuenta
                                    </td>
                                    <td>
                                        <span id="nro_cuenta_show"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Monto
                                    </td>
                                    <td>
                                        <span id="monto_deuda_show"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p>3) En <strong>“e-mail del destinatario”</strong>, ingrese: <strong>pago@portaldepagos.cl</strong> </p>


                        4) En el campo <strong>“comentario”</strong>, favor ingresar el siguiente código (copiar y pegar):
                        <textarea style="background:#ccc; text-align:center; color:#333; font-weight:bold; margin-top:10px;" class="form-control text-codigo" id="texto_ayuda_pago" cols="30" rows="1"></textarea>

                        <div class="ready">¡Listo!</div>

                        <div class="alert alert-info">
                        <strong>Recuerda</strong>
                        <p><i class="fa fa-arrow-right" aria-hidden="true"></i>  Registraremos el pago sólo cuando recibamos el comprobante desde tu banco.</p>
                        <p><i class="fa fa-arrow-right" aria-hidden="true"></i>  <strong> No puedes reenviarlo desde otro e-mail.</strong></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                    {!! Form::hidden('id_pago_pop','',['id' => 'id_pago_pop']) !!}
                {!! Form::hidden('tipo_pago','',['id' => 'id_tipo_pago']) !!}
                <button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
