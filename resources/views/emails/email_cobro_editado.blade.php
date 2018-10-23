<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>

<body style="width: 100% !important;height: 100%;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;     font-family: arial,sans-serif; paddding:0; margin:0;">
    <table style="width:100%; height:100%; background: #efefef;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none; padding-top:30px; ">
        <tr>
            <td class="container"
            style="display:block; clear:both!important; margin:0 auto!important; max-width:580px!important;">

            <!-- Message start -->
            <table style="width:100%; border-collapse:collapse; background:#fff; padding: 30px 35px;">
                <tr>
                    <td align="center" class="masthead">
                        <img style="max-width: 100%;margin: 0 auto; display: block; "
                        src="http://www.portaldepagos.cl/resources/views/emails/images/6.jpg">
                    </td>
                </tr>
                <tr>
                    <td style="padding: 30px 35px;">
                        <h2 style="font-size:28px; margin-bottom:20px; line-height: 1.25;">{{$nombre}}</h2>
                        <p style="font-size: 16px; font-weight:normal; margin-bottom:20px;">Se ha actualizado su cuenta por pagar: </p>
                        <table style="width:100%; border-collapse:collapse; background:#fff; padding: 30px 35px; text-align: left;">
                            <thead>
                                <tr>
                                    <th>Nombre / Razón Social</th>
                                    <th>Vencimiento</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$empresa}}</td>
                                    <td>{{$fecha_vencimiento}}</td>
                                    <td>{{$monto}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <p> Para más información sobre el monto y formas de pago, ingresa a: </p>


                        @if(!empty($resgistrado) && $cobro_id)
                        <table style="width:100%;">
                            <tr>
                                <td align="center">
                                    <p style="font-size: 16px; font-weight:normal; margin-bottom:20px;">
                                        <a href="http://www.portaldepagos.cl/cuentas-por-pagar#verpago_{{$cobro_id}}"
                                        style="width:200px; border-radius: 4px; font-weight:bold; padding:15px 20px 15px; text-decoration:none; background:#71bc37; color:#fff; display: inline-block;">Consultar
                                    Pagos Pendiente</a>
                                </p>
                            </td>
                        </tr>
                    </table>
                    @else
                    <table style="width:100%;">
                        <tr>
                            <td align="center">
                                <p style="font-size: 16px; font-weight:normal; margin-bottom:20px;">
                                    <a href="http://www.portaldepagos.cl/consultar"
                                    style="width:200px; border-radius: 4px; font-weight:bold; padding:15px 20px 15px; text-decoration:none; background:#71bc37; color:#fff; display: inline-block;">Consultar
                                Pagos Pendientes</a>
                            </p>
                        </td>
                    </tr>
                </table>
                @endif

            </td>
        </tr>
        <tr>
            <td>
                <div style="text-align: center; padding:15px; font-size: 10px;">
                    <p><strong>Este es un mensaje automático:</strong> Si el pago ya fue realizado, no considere
                    este mensaje.</p>

                </div>
            </td>
        </tr>
    </table>

</td>
</tr>

<tr>
    <td class="container"
    style="display:block; clear:both!important; margin:0 auto!important; max-width:580px!important;">

    <!-- Message start -->
    <table style="width:100%; border-collapse:collapse;">
        <tr>
            <td class="footer" style="background:#efefef; padding:30px 35px;" align="center">
                <p style="margin-bottom:0; text-align:center; font-size:14px;">Portal de Pagos.
                    <strong>Fácil</strong> para quien paga. <strong>Eficiente</strong> para quien cobra.<br/>
                </p>
                <p><a style="color:#888; text-decoration:none;" href="http://www.portaldepagos.cl">portaldepagos.cl</a>
                </p>
            </td>
        </tr>
    </table>


</td>
</tr>
</table>
<br>
<div style="text-align: justify; padding:30px; font-size: 10px;">
    <strong>Aviso Legal:</strong> La información generada en este e-mail no es de responsabilidad de Portal de Pagos -
    Soluciones de Pagos SPA. Si no estás de acuerdo con el monto, fecha de vencimiento o cualquier otra información
    sobre este cobro, solicitamos contactar directamente a la empresa o persona que lo generó.

</div>


</body>
</html>
