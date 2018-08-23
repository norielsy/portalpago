@section('modal_eliminar')
    <div id="modal_delete" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Eliminar</h4>
                </div>
                {!! Form::open(['method' => 'POST','id' => 'form_registro_main','class'=>'form-signin wow fadeInUp','action' => 'Admin\DeudasController@eliminar']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            ¿Estás seguro que deseas eliminar la deuda?
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_delete" id="id_delete">
                    <input type="hidden" name="id_type" id="id_type">
                    <button class="btn btn-outline btn-danger" type="submit">Eliminar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection