$(function(){
    $(".popup_adjuntar_individual").on('click',function(){
        $("#id_adjuntar_individual").val($(this).attr('attr-id'));
        $("#modal_adjuntar_individual").modal('show');
    });

    $(".popup_adjuntar_nomina").on('click',function(){
        $("#id_adjuntar_nomina").val($(this).attr('attr-id'));
        $("#modal_adjuntar_nomina").modal('show');
    });
});
