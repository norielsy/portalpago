$(function(){
    $(".btn_editar_contenido").on('click',function(){
        var id = $(this).attr('attr-id');
        var values = {
            "id": id,
            "_token": _token
        };

        $.ajax({
            url: url + "admincp/historial/contenido/buscar",
            type: "post",
            data: values ,
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != null){
                    $("#edit_titulo").val(obj.titulo);
                    $("#edit_mensaje").val(obj.texto);
                    $("#id_edit").val(id);
                    $("#modal_editar_contenido").modal('show');
                }
            }
        });


    });
});