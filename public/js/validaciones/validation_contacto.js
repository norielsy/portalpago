$(function(){

    var primero = 0;

    function validarRut_mas_login(value, element, param) {
        rut = formatear_rut_dv(value);
        rut = rut.replaceAll('.','');
        rut = rut.toLowerCase();
        var rexp = new RegExp(/^([0-9])+\-([kK0-9])+$/);
        if(rut.match(rexp)){
            var RUT		= rut.split("-");
            var elRut	= RUT[0];
            var factor	= 2;
            var suma	= 0;
            var dv;
            for(i=(elRut.length-1); i>=0; i--){
                factor = factor > 7 ? 2 : factor;
                suma += parseInt(elRut[i])*parseInt(factor++);
            }
            dv = 11 -(suma % 11);
            if(dv == 11){
                dv = 0;
            }else if (dv == 10){
                dv = "k";
            }

            if(dv == RUT[1].toLowerCase()){

                $('.login_fast').popover({
                    container: 'body',
                    placement : 'bottom',
                    trigger: 'click',
                    html: true,
                    content: function () {
                        var clone = $($(this).data('popover-content')).removeClass('hide');
                        return clone;
                    }
                });
                if(primero == 0){
                    $( ".login_fast" ).trigger( "click" );
                }
                primero = 1;
                $("#rut_hidden").val($("#rut").val());
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es obligatorio.",
        remote: "Por favor, rellena este campo.",
        email: "Por favor, escribe una dirección de correo válida",
        url: "Por favor, escribe una URL válida.",
        date: "Por favor, escribe una fecha válida.",
        dateISO: "Por favor, escribe una fecha (ISO) válida.",
        number: "Por favor, escribe un número entero válido.",
        digits: "Por favor, escribe sólo dígitos.",
        creditcard: "Por favor, escribe un número de tarjeta válido.",
        equalTo: "Por favor, escribe el mismo valor de nuevo.",
        accept: "Por favor, escribe un valor con una extensión aceptada.",
        maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
        minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
        rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
        range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
        max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
        min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
    });

    $("#motivo").on('change',function(){
        var texto = $(this).val();
        if(texto == "Reclamo"){
            $("#solicitud_esperada").show();
        }else{
            $("#solicitud_esperada").hide();
        }
    });

    $.validator.addMethod("rut", validarRut_mas_login, "El rut ingresado no es válido, Ej: 12.345.678-9");
    $('#form_contacto').validate({
        rules: {
            rut: {
                rut: true
            },
            nombre: {
                minlength: 3,
                maxlength: 100,
                required: true,
            },
            email:{
                required: true,
                email: true
            },
            celular:{
                minlength: 9,
                maxlength: 9,
                required: true,
                number: true
            },
            mensaje:{
                minlength: 3,
                maxlength: 500,
            }
        },
        messages: {
            celular: "Favor ingresa un numero valido con 9 dígitos (sólo números)."
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block has-error',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#form_contacto").submit(function(){
        var bol_ = $("#form_contacto").valid();
        if(bol_) {
            $(".loading2").show();
        }
    });

});