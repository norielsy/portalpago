var _token = "";
var logoutUrl = url + 'logout'
var minutos = 5;

function validarRut(value, element, param) {
    rut = formatear_rut_dv(value);
    rut = rut.replaceAll('.', '');
    rut = rut.toLowerCase();
    var rexp = new RegExp(/^([0-9])+\-([kK0-9])+$/);
    if (rut.match(rexp)) {
        var RUT = rut.split("-");
        var elRut = RUT[0];
        var factor = 2;
        var suma = 0;
        var dv;
        for (i = (elRut.length - 1); i >= 0; i--) {
            factor = factor > 7 ? 2 : factor;
            suma += parseInt(elRut[i]) * parseInt(factor++);
        }
        dv = 11 - (suma % 11);
        if (dv == 11) {
            dv = 0;
        } else if (dv == 10) {
            dv = "k";
        }

        if (dv == RUT[1].toLowerCase()) {
            console.log('1');
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function validarFecha(value, element) {
    // put your own logic here, this is just a (crappy) example
    return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
}

function convertDate(inputFormat) {
    function pad(s) {
        return (s < 10) ? '0' + s : s;
    }

    var d = new Date(inputFormat);
    console.log(inputFormat);
    if (d != null) {
        d = new Date();
    }
    return [pad(d.getDate()), pad(d.getMonth() + 1), d.getFullYear()].join('/');
}

function convertirFechaInput(fecha) {
    var d = fecha.split('-');
    return d[2] + "/" + d[1] + "/" + d[0];
}


function formatear_rut_dv(rut) {

    rut = rut.replaceAll('-', '');
    rut = rut.replaceAll('.', '');

    ultimo_digito = rut.slice(-1);
    rut = rut.slice(0, -1);
    if (isNumber(rut)) {
        return separadorMiles(rut) + "-" + ultimo_digito;
    } else {
        return rut + "" + ultimo_digito;
    }

}

function formato_moneda(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}

function separadorMiles(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1.$2");
    return x;
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

String.prototype.replaceAll = function (str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (ignore ? "gi" : "g")), (typeof(str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
};

$(function () {


    $("body").on('click', '.cerrar_hover_p', function () {
        $('.rut_input_point').popover('hide')
    });
    $("#email_id").on('change keyup paste', function () {
        if ($(this).val().length > 0) {
            $("#confirmar_mail").css('visibility', 'visible').hide().fadeIn('slow').removeClass('hidden');
        } else {
            $("#confirmar_mail").fadeOut();
        }
    });
    $("#passwordp").on('change keyup paste', function () {
        if ($(this).val().length > 0) {
            $("#confirmar_clave").css('visibility', 'visible').hide().fadeIn('slow').removeClass('hidden');
        } else {
            $("#confirmar_clave").fadeOut();
        }
    });
    _token = $("#token_urf8881").val();

    var rut_login = $(".rut_data_main").val();
    if (rut_login != null) {
        $(".rut_data_main").val(formatear_rut_dv(rut_login));
    }


    $(".moneda").on('keyup', function () {
        var moneda = $(this).val().replace(/\./g, '');
        $(this).val(formato_moneda(moneda));
    });

    $('.banner').unslider({
        autoplay: true,
        arrows: false,
        nav: false,
        delay: 4000
    });

    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);

    $(".p_mi_cuenta").on('click', function () {
        $("#form_mi_cuenta").modal('show');
    });

    $(".p_mi_banco").on('click', function () {
        $(".loading2").show();
        $("#form_cuenta_bancaria").modal('show');
        $(".loading2").hide();
    });

    $("#modal_error_login").modal('show');
    $(".select2").select2();

    $(".btn_loading").on('click', function () {
        $(".loading2").show();
    });

    $(".datepicker").datepicker({
        dateFormat: 'dd/mm/yy',
        changeYear: true,
        changeMonth: true,
        /*maxDate: '+25d',
         minDate: '-25d',*/
    });

    $(".datepicker_all").datepicker({
        dateFormat: 'dd/mm/yy',
        changeYear: true,
        changeMonth: true
    });

    $("#from").datepicker({
        dateFormat: 'dd/mm/yy',
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        onClose: function (selectedDate) {
            $("#to").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#to").datepicker({
        dateFormat: 'dd/mm/yy',
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        onClose: function (selectedDate) {
            $("#from").datepicker("option", "maxDate", selectedDate);
        }
    });

    $("#from_edit").datepicker({
        dateFormat: 'dd/mm/yy',
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        onClose: function (selectedDate) {
            $("#to").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#to_edit").datepicker({
        dateFormat: 'dd/mm/yy',
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        onClose: function (selectedDate) {
            $("#from").datepicker("option", "maxDate", selectedDate);
        }
    });

    //$(".number").spinner();
    $(".decimal").spinner({
        step: 0.01,
        min: 0.01,
        max: 99
    });

    $("#btn_recuperar_pwd").on('click', function () {
        $(".loading2").show();
        $("#recuperar_password").modal('show');
        $(".loading2").hide();
    });

    $('body').on('keyup', '.rut_main', function (e) {
        //alert("ca");
        startTypingTimer($(e.target), ".rut_main");
    });

    $('body').on('keyup', '.rut_input_point', function (e) {
        startTypingTimer($(e.target), ".rut_input_point");
    });

    /*$('body').focusout(function(e){
        startTypingTimer( $(e.target) );
    });*/

    $("#change_views").on('change', function () {
        $("#formview").submit();
    });

    $('[data-id-vista]').click(function () {
        var id = $(this).data('id-vista');
        $.post(url + '/changeview', {view: id, _token: $('#token_urf8881').val()}).done(function (data) {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al cambiar cuenta');
            }
        })
    });
    $('.file.file_upload').fileinput({
        language: 'es',
        showUpload: false,
        showRemove: false
    });

    var typingTimeout;

    function startTypingTimer(input_field, tag) {
        //alert("a");
        if (typingTimeout != undefined)
            clearTimeout(typingTimeout);
        typingTimeout = setTimeout(function () {
            var valor = input_field.val();
            $("" + tag).val(formatear_rut_dv(valor));
        }, 1000);
    }

    $(window).scroll(function () {
        /*clearTimeout($.data(this, 'scrollTimer'));
        $.data(this, 'scrollTimer', setTimeout(function() {
            var scroll = $(window).scrollTop();
            localStorage.setItem('scrolls', scroll);
        }, 150));*/
    });

    $("#metodo_pago").on('change', function () {
        var id = $(this).val();
        if (id == 1) {
            $("#block_transaccion").show();
        } else {
            $("#block_transaccion").hide();
        }
    });

    $("#metodo_pago_nom").on('change', function () {
        var id = $(this).val();
        if (id == 1) {
            $("#block_transaccion_nom").show();
        } else {
            $("#block_transaccion_nom").hide();
        }
    });


    $(".delete_items").on('click', function () {
        $(".loading2").show();
        var id = $(this).attr('attr-id');
        $("#id_item_delete").val(id);
        $("#modal_delete_items").modal('show');
        $(".loading2").hide();
    });

    $(".delete_items_individual").on('click', function () {
        $(".loading2").show();
        var id = $(this).attr('attr-id');
        $("#id_item_delete_individual").val(id);
        $("#modal_delete_items_individual").modal('show');
        $(".loading2").hide();
    });


    $(".cerrar_publicidad").on('click', function () {
        var values = {
            "cerrar": 1,
            "_token": $("#get_token").val()
        };

        $.ajax({
            url: url + "cerrarpublicidad",
            type: "post",
            data: values,
            success: function (response) {
                $(".unslider").parent().remove();
                //console.log(response);
            }
        });
    });

    $(".btn_item_pagado").on('click', function () {
        $(".loading2").show();
        var id = $(this).attr('attr-id');
        var tipo = $(this).attr('attr-type');
        var values = {
            "id": id,
            "tipo": tipo,
            "_token": $("#get_token").val()
        };

        $.ajax({
            url: url + "buscarcuentapagar",
            type: "post",
            data: values,
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj != null) {
                    $("#nombre_banco_show").html(obj.banco.banco);
                    $("#tipo_cuenta_show").html(obj.banco.tipo_cuenta);
                    $("#nro_cuenta_show").html(obj.banco.nro_cuenta);
                    $("#rut_cuenta_show").html(obj.rut);
                    $("#nombre_razon_social_show").html(obj.reg_nombre);
                    $("#texto_ayuda_pago").val("Portal de pago: " + obj.codigo_transaccion);
                    $("#monto_deuda_show").html(formato_moneda(obj.monto));
                    $("#modal_item_pagado2").modal('show');
                }
                $(".loading2").hide();
            }
        });

    });


    $(".popup_pagar_cobros").on('click', function () {
        $(".loading2").show();
        var id = $(this).attr('attr-id');
        var values = {
            "id": id,
            "_token": $("#get_token").val()
        };
        $.ajax({
            url: url + "cuentas-cobrar-log/json",
            type: "post",
            data: values,
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj != null) {
                    $("#id_pago_pop").val(id);
                    $("#im_pop").val(obj.empresa);
                    $("#monto_pop").val(obj.monto);
                    $("#monto_pop_value").val(formato_moneda(obj.monto));
                    $("#modal_item_pagado_individual").modal('show');
                }
                $(".loading2").hide();
            }
        });

    });

    $(".popup_pagar_nominas").on('click', function () {
        $(".loading2").show();
        var id = $(this).attr('attr-id');
        var values = {
            "id": id,
            "_token": $("#get_token").val()
        };
        $.ajax({
            url: url + "buscarnomina/json",
            type: "post",
            data: values,
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj != null) {
                    $("#id_pago_pop_nom").val(obj.idnominasdetalle);
                    $("#im_pop_nom").val(obj.nombre);
                    $("#monto_pop_nom").val(obj.monto);
                    $("#monto_pop_nom_value").val(formato_moneda(obj.monto));

                    //op
                    $("#monto_pop").val(obj.monto);

                    $("#modal_item_pagado_nominas").modal('show');
                }
                $(".loading2").hide();
            }
        });

    });

    $(".editar_nominadetalle").on('click', function () {
        $(".loading2").show();
        var id = $(this).attr('attr-id');
        var values = {
            "id": id,
            "_token": $("#get_token").val()
        };
        $.ajax({
            url: url + "buscarnomina/json",
            type: "post",
            data: values,
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj != null) {
                    $("#id_nomina").val(obj.idnominasdetalle);
                    $("#id_nomina_detalle").val(obj.idnominas);
                    $("input[name=nombre]").val(obj.nombre);
                    $("input[name=rut]").val(obj.rut);
                    $("textarea[name=descripcion]").val(obj.descripcion);
                    $("input[name=email]").val(obj.email);
                    $("input[name=monto]").val(formato_moneda(obj.monto));
                    $("input[name=fecha_vencimiento]").datepicker("setDate", convertirFechaInput(obj.fecha_vencimiento));

                    $("input[name=rut_traspaso]").val(obj.rut_traspaso);
                    $("input[name=email_traspaso]").val(obj.email_traspaso);

                    $("#modal_edit_detalle_nomina").modal('show');
                }
                $(".loading2").hide();
            }
        });
    });

    $(".editar_cobros_puntuales").on('click', function () {
        $(".loading2").show();
        var id = $(this).attr('attr-id');
        var values = {
            "id": id,
            "_token": $("#get_token").val()
        };

        $.ajax({
            url: url + "cuentas-cobrar-log/json",
            type: "post",
            data: values,
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj != null) {
                    $("#id_cobro").val(obj.idCobros);
                    $("#modal_edit_cobro_puntual input[name=empresa]").val(obj.empresa);
                    $("#modal_edit_cobro_puntual input[name=rut_empresa]").val(obj.rut_empresa);
                    $("#modal_edit_cobro_puntual textarea[name=descripcion]").val(obj.descripcion);
                    $("#modal_edit_cobro_puntual input[name=email]").val(obj.email);
                    $("#modal_edit_cobro_puntual input[name=monto]").val(formato_moneda(obj.monto));
                    $("#modal_edit_cobro_puntual input[name=fecha_vencimiento]").datepicker("setDate", convertirFechaInput(obj.fecha_vencimiento));

                    $("input[name=rut_traspaso]").val(obj.rut_traspaso);
                    $("input[name=email_traspaso]").val(obj.email_traspaso);

                    $("#modal_edit_cobro_puntual").modal('show');
                }
                $(".loading2").hide();
            }
        });
    });

    $("#modal_adjuntar_nomina_masivo").modal('show');
    $("#ul_publicidad").show();
    $(".mostrar_ok").modal('show');


    /* INACTIVIDAD DEL SITIO */

    setTimeout(function () {
        console.log('a');
        if (rut_login != null) {
            console.log('b');
            window.location = logoutUrl;
            console.log('r');
        }
        console.log('up');
    }, minutos * 60 * 1000);
    /* FIN INACTIVIDAD DEL SITIO */
});
var email_cobro_individual = null;
$(document).ready(function () {
    console.log("entro ready");
    $(".cambiarpwd").click(function () {
        console.log("entro click");
        $("#modal_cambiar_password").modal('show');
    });

    if (location.pathname == "/cuentas-por-pagar") {
        if (location.hash != "") {
            console.log("cuentas por pagar");
            var hash = location.hash.split("_");
            if (hash[0] == "#verpago") {
                console.log("hash verpago", ".btn_item_pagado[attr-id='" + hash[1] + "']");
                $(".btn_item_pagado[attr-id='" + hash[1] + "']").click();
            }
        }
    }

    $("#rutCobroIndividual").blur(function () {
        $("#loading_email").removeClass('hide');
        $.get('/ajaxEmailByRut', $.param({rut: formatear_rut_dv($(this).val())})).done(function (response) {
            if (response.success) {
                var email = response.data;
                var emailSeparado = email.split('@');
                var strOrgLen = '', strRep = '', strDes = '', strRepLen = '';

                //strOrgLen = emailSeparado[0].length;

                strRep = emailSeparado[0].substring(1, emailSeparado[0].length);

                strRepLen = strRep.length;

                for (i = strRepLen; i > 0; i--)
                    strDes += '*';

                var resStr = emailSeparado[0].replace(strRep, strDes);
                //console.log('email', resStr)
                resStr += '@' + emailSeparado[1];
                email_cobro_individual = email;
                $("#email_hide").text(resStr);
                $("#check_email_container").removeClass('hide');
            } else {
                $("#email_hide").text('');
                $("#check_email_container").addClass('hide');
                email_cobro_individual = null
            }
            $("#loading_email").fadeOut();
        })
    });
    $("#btn_cobro_individual").click(function (e) {
        e.preventDefault();
        if ($("#check_email").prop('checked')) {
            $("#email_cobro").prop('type', 'password');
            $("#email_cobro").val(email_cobro_individual);
        }
        $("#form_cobrospuntuales_main").submit();
    })
});