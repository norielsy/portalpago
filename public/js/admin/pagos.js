$(function(){
    $(".delete_item").on('click',function(){
        var id = $(this).attr('attr-id');
        $("#id_delete").val(id);
        $("#modal_delete").modal('show');
    });

    $(".modal_edit").on('click',function(){
        var id = $(this).attr('attr-id');
        var values = {
            "id": id,
            "_token": _token
        };
        $.ajax({
            url: url + "admincp/pagos/buscar",
            type: "post",
            data: values ,
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != null){
                    $("#edit_pago").val(obj.descripcion);
                    $("#id_edit").val(id);
                    $("#modal_editar").modal('show');
                }
            }
        });
    });

    //CUENTA

    $(".delete_item_cuenta").on('click',function(){
        var id = $(this).attr('attr-id-cuenta');
        $("#id_delete_cuenta").val(id);
        $("#modal_delete_cuenta").modal('show');
    });

    $(".modal_edit_cuenta").on('click',function(){
        var id = $(this).attr('attr-id-cuenta');
        var values = {
            "id": id,
            "_token": _token
        };
        $.ajax({
            url: url + "admincp/pagos/cuenta/buscar",
            type: "post",
            data: values ,
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != null){
                    $("#edit_pago_cuenta").val(obj.descripcion);
                    $("#id_edit_cuenta").val(id);
                    $("#modal_editar_cuenta").modal('show');
                }
            }
        });
    })
});
