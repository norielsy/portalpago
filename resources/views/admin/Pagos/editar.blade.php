@section('modal_editar')
    <div id="modal_editar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['method' => 'POST','id' => 'form_editar_pago','class'=>'form-signin','action' => 'Admin\PagosController@editar']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="titulo">Forma de pago</label>
                                <div class="col-sm-10">
                                    {!! Form::text('pago',null,['class' => 'form-control','id' => 'edit_pago','placeholder' => '']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_edit" id="id_edit">
                    <button class="btn btn-outline btn-success" type="submit">Editar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script src="{{ asset('public/js/admin/validaciones/val_editar_pago.js')}}"></script>
@endsection