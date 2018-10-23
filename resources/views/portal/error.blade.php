@extends('template')

@section('title')
Error 404 | Portal de Pagos
@endsection

@section('content')

<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h1 class="top10 white">
                    Error 404
                </h1>
            </div>

        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center feature-head wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;" data-wow-animation-name="fadeInDown">
                <h1 class="">Lo sentimos, ha ocurrido un error</h1>
                <strong>Si continua, por favor contactenos a traves de atencion@portaldepagos.cl</strong>
                <br>
                <br>
                <table style="width:100%;">
                    <tr>
                        <td align="center">
                            <p style="font-size: 16px; font-weight:normal; margin-bottom:20px;">
                                <a href="http://www.portaldepagos.cl/"
                                style="width:200px; border-radius: 4px; font-weight:bold; padding:15px 20px 15px; text-decoration:none; background:#71bc37; color:#fff; display: inline-block;">
                            Volver al inicio</a>
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
