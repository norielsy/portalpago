$(function(){

    $(".modal_edit_p").on('click',function(){
        //alert('a');
        //console.log('b');
        var id = $(this).attr('attr-id');
        var values = {
            "id": id,
            "_token": _token
        };
        console.log('url', url + "admincp/publicidad/buscar")
        
        $.ajax({
            url: url + "admincp/publicidad/buscar",
            type: "post",
            data: values ,
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != null){
                    $("#titulo_edit").val(obj.titulo);
                    $("#from_edit").val(convertirFechaInput(obj.fecha_inicio));
                    $("#to_edit").val(convertirFechaInput(obj.fecha_termino));
                    $("#descripcion_edit").val(obj.descripcion);
                    $("#id_edit").val(id);
                    $(".modal_editar").modal('show');
                }
            }
        }).done(function (response) {
            var obj = JSON.parse(response);
            if(obj != null){
                $("#titulo_edit").val(obj.titulo);
                $("#from_edit").val(convertirFechaInput(obj.fecha_inicio));
                $("#to_edit").val(convertirFechaInput(obj.fecha_termino));
                $("#descripcion_edit").val(obj.descripcion);
                $("#id_edit").val(id);
                $(".modal_editar").modal('show');
            }
        });
     });

    $(".modal_elimitar").on('click',function(){
        console.log('b');
        var id = $(this).attr('attr-id');
        $("#id_delete").val(id);
        $("#modal_delete").modal('show');
    });
});