@section('modal_eliminar_individual')
    <div id="modal_delete_items_individual" class="modal fade">
        <div class="modal-dialog">
            {!! Form::open(['method' => 'DELETE','class'=>'modal-content','action' => 'CobrarController@eliminarcobro']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Eliminar Cobro</h4>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que deseas eliminar el cobro?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="idcobro" id="id_item_delete_individual" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Eliminar</button>
            </div>
            {!! Form::close() !!}}
        </div>
    </div>
@endsection