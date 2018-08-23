<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>


<body style="width: 100% !important;height: 100%;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;     font-family: arial,sans-serif; paddding:0; margin:0;">
<table style="width:100%; height:100%; background: #efefef;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none; padding-top:30px; ">
    <tr>
        <td class="container" style="display:block; clear:both!important; margin:0 auto!important; max-width:580px!important;">

            <!-- Message start -->
            <table style="width:100%; border-collapse:collapse; background:#fff; padding: 30px 35px;">
                <tr>
                    <td align="center" class="masthead">
                        <img style="max-width: 100%;margin: 0 auto; display: block; " src="http://www.portaldepagos.cl/resources/views/emails/images/6.jpg">
                    </td>
                </tr>
                <tr>
                    <td style="padding: 30px 35px;">

                        <h2 style="font-size:28px; margin-bottom:20px; line-height: 1.25;">Vencimento de cobro</h2>
                        <p style="font-size: 16px; font-weight:normal; margin-bottom:20px;">Hola <em style="color:#71bc37; font-weight:bold;">{{$nombre}}</em></p>
                      

                        <p style="font-size: 16px; font-weight:normal; margin-bottom:20px;"><p>Tienes nuevos cobros por vencer:<strong> {{$dias}}</strong></p>
                        <p>Para más información entra a tu cuenta: </p>

                        <table style="width:100%;">
                            <tr>
                                <td align="center">
                                    <p style="font-size: 16px; font-weight:normal; margin-bottom:20px;">
                                        <a href="http://portaldepagos.cl" style="width:200px; border-radius: 4px; font-weight:bold; padding:15px 20px 15px; text-decoration:none; background:#71bc37; color:#fff; display: inline-block;">Ingresar</a>
                                    </p>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>

        </td>
    </tr>
     <tr>
       <td class="container" style="display:block; clear:both!important; margin:0 auto!important; max-width:580px!important;">

            <!-- Message start -->
            <table style="width:100%; border-collapse:collapse;">
                <tr>
                    <td class="footer" style="background:#efefef; padding:30px 35px;" align="center">
                        <p style="margin-bottom:0; text-align:center; font-size:14px;">Portal de Pagos. <strong>Fácil</strong> para quien paga. <strong>Eficiente</strong> para quien cobra.<br/>
</p>
                        <p><a style="color:#888; text-decoration:none;" href="http://www.portaldepagos.cl">portaldepagos.cl</a></p>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>


</body>
</html>