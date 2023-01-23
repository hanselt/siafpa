<div class="main-header bg-red font-inverse wow fadeInDown">
    <div class="container">
        <a href="{{ asset("") }}" class="header-logo" title="Area Funcional De Patrimonio Arqueológico" style="background:url('{{ URL::asset('img/logo.png') }}')"></a><!-- .header-logo -->
        <div class="right-header-btn">
            <div id="mobile-navigation">
                <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target=".header-nav"><span></span></button>
            </div>
        </div><!-- .header-logo -->
        <ul class="header-nav collapse">
            <li>
                <a href="admincgm.home">Inicio</a>
            </li>
            <li>
                <a href="admincgm.ver_actividades_admin" title="Components">Actividades</a>
            </li>
            <li>
                <a href="admincgm.ver_atrimestrales_admin" title="Components">Acciones trimestrales</a>
            </li>
            <li>
                <a href="{{ route('ver_monumentos_admin') }}" title="Components">Monumentos</a>
            </li>
            <li>
                <a href="{{ url('admincgm/perfil') }}" title="Components"> Perfil</a>
            </li>
        </ul><!-- .header-nav -->
    </div><!-- .container -->
</div><!-- .main-header -->
