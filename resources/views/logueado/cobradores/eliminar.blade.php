@section('modal_eliminar')
    <div id="modal_eliminar" class="modal fade modal_new_g1" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            {!! Form::open(['method' => 'post','class'=>'modal-content form-horizontal','action' => 'CobradoresController@delete']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar Usuario</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="text-center">¿Estás seguro que deseas eliminar este usuario?</div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="id_delete">
                <button class="btn btn-default" type="button" data-dismiss="modal" aria-label="Close">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection