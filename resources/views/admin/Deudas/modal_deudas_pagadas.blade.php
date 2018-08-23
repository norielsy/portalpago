@section('modal_deuda_pagadas')
    <div id="detalle-pago" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"># ID deuda pagada</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Rut Deudor</label>
                                <input disabled="" id="rut_deudor" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Nombre Empresa Deudora</label>
                                <input disabled="" id="empresa_deudor" class="form-control">
                            </div>


                            <div class="form-group">
                                <label>Fecha de vencimiento</label>
                                <input  disabled="" id="fecha_vencimiento" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nómina asociada <span class="small">(Si corresponde)</span></label>
                                <input disabled="" id="nomina_asociada" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea disabled="" id="descripcion" rows="3" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rut Cobrador</label>
                                <input disabled="" id="rut_cobrador" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Empresa Cobradora</label>
                                <input disabled="" id="empresa" class="form-control">
                            </div>


                            <div class="form-group">
                                <label>Fecha de pago</label>
                                <input disabled="" id="fecha_pago" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Monto</label>
                                <input disabled="" id="monto" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>N° transacción</label>
                                <input disabled="" id="nro_transaccion" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection