@section('menu_cobros')
    <ul class="nav nav-tabs">
        <li @if($menu_cobro == 2) class="active" @endif><a href="{{ URL::action('CobrarController@puntales')}}">Cargar cobro individual</a></li>
        <li @if($menu_cobro == 1) class="active" @endif><a href="{{ URL::action('CobrarController@index')}}">Cargar nómina de cobros</a></li>

        <li @if($menu_cobro == 3) class="active" @endif><a href="{{ URL::action('CobrarController@todo')}}">Cobros Pendientes</a></li>
        <li @if($menu_cobro == 5) class="active" @endif><a href="{{ URL::action('CobrarController@pagadas')}}">Cobros realizados</a></li>
    </ul>
@endsection
