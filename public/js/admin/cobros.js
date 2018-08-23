$(function(){

    /* COBROS */
    $('body').on('keypress','#id_rut_cobrador',function(e){
        startTypingTimer( $(e.target) );
    });

    $('body').on('paste','#id_rut_cobrador',function(e){
        startTypingTimer( $(e.target) );
    });

    var typingTimeout;
    function startTypingTimer(input_field){
        if (typingTimeout != undefined)
            clearTimeout(typingTimeout);
        typingTimeout = setTimeout( function(){
            var rut = input_field.val();
            buscar(rut);
        }, 500);
    }

    function buscar(rut){
        $("#ok_rut_input").hide();
        $("#error_rut_input").hide();
        var values = {
            "rut": rut,
            "_token": _token
        };

        $.ajax({
            url: url + "admincp/cobros/buscar",
            type: "post",
            data: values ,
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != null){
                    $("#ok_rut_input").show();
                    $("#nombre_empresa").val(obj.nombre);
                }else{
                    $("#error_rut_input").show();
                    $("#nombre_empresa").val("");
                }
            }
        });
    }

    /* NOMINAS */

    $('body').on('keypress','#id_rut_cobrador2',function(e){
        startTypingTimer( $(e.target) );
    });

    $('body').on('paste','#id_rut_cobrador2',function(e){
        startTypingTimer( $(e.target) );
    });

    var typingTimeout;
    function startTypingTimer(input_field){
        if (typingTimeout != undefined)
            clearTimeout(typingTimeout);
        typingTimeout = setTimeout( function(){
            var rut = input_field.val();
            buscar(rut);
        }, 500);
    }

    function buscar(rut){
        $("#ok_rut_input2").hide();
        $("#error_rut_input2").hide();
        var values = {
            "rut": rut,
            "_token": _token
        };

        $.ajax({
            url: url + "admincp/cobros/buscar",
            type: "post",
            data: values ,
            success: function (response) {
                var obj = JSON.parse(response);
                if(obj != null){
                    $("#ok_rut_input2").show();
                    $("#nombre_empresa2").val(obj.nombre);
                }else{
                    $("#error_rut_input2").show();
                    $("#nombre_empresa2").val("");
                }
            }
        });
    }



});