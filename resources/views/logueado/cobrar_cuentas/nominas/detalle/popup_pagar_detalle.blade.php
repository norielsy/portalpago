@section('modal_detalle_pagar')
    <div id="modal_item_pagado_nominas" class="modal fade">
        <div class="modal-dialog">
            {!! Form::open(['method' => 'post','id' => 'form_item_pagado','class'=>'modal-content form-horizontal','action' => 'CobrarController@pagarcuenta_nominas']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registrar Pago</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="empresa">Nombre/Empresa</label>
                        <div class="col-sm-6">
                            {!! Form::text('im_pop',null,['class' => 'form-control','id' => 'im_pop_nom','readonly' => 'true']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="empresa">Fecha de pago</label>
                        <div class="col-sm-6">
                            {!! Form::text('fecha_pago_pop',null,['class' => 'form-control datepicker_all','id' => 'fecha_pago_pop_nom']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="empresa">Método de pago</label>
                        <div class="col-sm-6">
                            <select class="form-control input-sm " id="metodo_pago_nom" name="metodo_pago">
                                @foreach($metodo_pago as $item)
                                    <option value="{{$item->idTipoPago}}">{{$item->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" id="block_transaccion_nom">
                        <label class="col-sm-4 control-label" for="empresa">N° Transacción</label>
                        <div class="col-sm-6">
                            {!! Form::text('nro_transaccion_pop',null,['class' => 'form-control','id' => 'nro_transaccion_pop_nom']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="empresa">Monto ($)</label>
                        <div class="col-sm-6">
                            {!! Form::hidden('monto_pop','',['id' => 'monto_pop_nom']) !!}
                            {!! Form::text('',null,['class' => 'form-control','id' => 'monto_pop_nom_value','disabled' => true]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::hidden('id_pago_pop','',['id' => 'id_pago_pop_nom']) !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primarynew">Confirmar Pago</button>
            </div>
            {!! Form::close() !!}}
        </div>
    </div>
@endsection