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
                <a href="{{ route('home') }}">Inicio</a>
            </li>
            <li>
                <a href="#" title="Components">Monumentos <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ route('admin_monumento_create') }}">Agregar Monumentos</a></li>
                    <li><a href="{{ route('ver_monumentos_admin') }}">Ver Monumentos</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('admincatastro/perfil') }}" title="Components"> Perfil</a>
            </li>
        </ul><!-- .header-nav -->
    </div><!-- .container -->
</div><!-- .main-header -->