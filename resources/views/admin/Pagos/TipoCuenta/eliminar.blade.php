@section('modal_eliminar_cuenta')
    <div id="modal_delete_cuenta" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Eliminar</h4>
                </div>
                {!! Form::open(['method' => 'POST','id' => 'form_registro_main','class'=>'form-signin wow fadeInUp','action' => 'Admin\PagosController@eliminar_cuenta']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            ¿Estás seguro que deseas eliminar el tipo de cuenta?
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_delete_cuenta" id="id_delete_cuenta">
                    <input type="hidden" name="id_type_cuenta" id="id_type_cuenta">
                    <button class="btn btn-outline btn-danger" type="submit">Eliminar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection