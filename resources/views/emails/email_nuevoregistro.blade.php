<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <style type="text/css">
    .detalle_deuda{
        margin-top: 20px;
    }
    .header{ margin-top: 20px; }
    .center{ text-align: center; }
    .footer{ border-top: 1px solid #CCC; padding-top: 10px; margin-top: 10px; }
</style>
</head>
<body>

    <div class="container">
        <div class="row">

            <div class="header">
                <p>El(la) señor(a) {{$nombre}}, ...</p>
            </div>
            <div class="detalle_deuda">
                <div role="alert" class="alert alert-info">
                    Registrate en el siguiente enlace <a href="http://www.portaldepagos.cl/registro">Registrarme ahora!</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
