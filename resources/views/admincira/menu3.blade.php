<div class="main-header bg-red font-inverse wow fadeInDown" style="background-color: #e74c3c">
    <div class="container">
        <a href="{{ asset("") }}" class="header-logo" title="Area Funcional De Patrimonio Arqueológico" style="background:url('{{ URL::asset('img/logo.png') }}')"></a><!-- .header-logo -->
        <div class="right-header-btn">
            <div id="mobile-navigation">
                <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target=".header-nav"><span></span></button>
            </div>
        </div><!-- .header-logo -->
        <ul class="header-nav collapse">
            <li>
                <a href="{{ asset('admincira/home') }}">Inicio</a>
            </li>
            <li>
                <a href="#" title="Components">Expedientes <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ asset('/admincira/ver-exp') }}">Recepción</a></li>
                    <li><a href="{{ asset('/admincira/ver-calificacion') }}">Calificación</a></li>
                    <li><a href="{{ asset('/admincira/ver-abogados') }}">Asignar Abogado</a></li>
                </ul>
            </li>
            <li>
                <a href="#" title="Components">CIRA <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ asset('/admincira/cira') }}">Ver CIRAs</a></li>
                </ul>
            </li>
            <li>
                <a href="#" title="Components">PMA <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ asset('/admincira/pma') }}">Ver PMAs</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ asset('admincira/perfil') }}" title="Components">Perfil</a>
            </li>
        </ul><!-- .header-nav -->
    </div><!-- .container -->
</div><!-- .main-header -->