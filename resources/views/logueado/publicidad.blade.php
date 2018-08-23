@section('content_publicidad')
    <?php $pu = \App\Extras\Portal::listPublicidad(); ?>
    @if(Session::get('cerrar_publicidad') != 1 && count($pu) > 0)
        <div class="row">

            <div id="demo" class="banner">

                @if(count($pu) > 0)
                    <ul style="display: none;" id="ul_publicidad">
                        @foreach($pu as $imagen)
                            <li>
                                <?php $link = !empty($imagen['link']) ? $imagen['link'] : 'javascript:;'; ?>
                                <a href={{$link}} target="_blank" >
                                    <img src="{{ asset("public/images/p/". $imagen["path_imagen"])}}" class="img-responsive"/>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <a href="javascript:;" class="verde pull-right cerrar_publicidad" > Cerrar Publicidad. <i class="fa fa-times"></i></a>
            </div>
        </div>
    @endif

    <?php $anuncio = \App\Extras\Portal::mostrarAnuncio(); ?>
    @if($anuncio != null)
        <div class="alert alert-info fade in top10">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="Cerrar">×</a>
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <strong>{{$anuncio[0]['mensaje']}}</strong>
        </div>
    @endif

@endsection