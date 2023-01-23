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
                <a href="#">Ingresos<i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ asset('/admincira/crear/cira') }}">Agregar Ingresos</a></li>
                    <li><a href="{{ asset('/admincira/ver-cc') }}">Ver Ingresos</a></li>
                    <li><a href="{{ asset('/admincira/crear/ciraantecedente') }}">Agregar Antecedentes</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Recepción<i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ asset('/admincira/ver-observados') }}">Recepcionar Observados</a></li>
                    <li><a href="{{ asset('/admincira/recepcionCertificaciones') }}">Recepcionar Calificados</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Derivación<i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ asset('/admincira/ver-oficiados') }}">Oficiar Observados</a></li>
                    <li><a href="{{ asset('/admincira/enviar-afpa') }}">Derivar AFPA</a></li>
                </ul>
            </li>
            <li>
                <a href="#" title="Components">CIRA <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ asset('/admincira/cira') }}">Ver CIRAs</a></li>
                    <li><a href="{{ asset('/admincira/cargarcira') }}">Cargar excel CIRA</a></li>
                </ul>
            </li>
            <li>
                <a href="#" title="Components">PMA <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ asset('/admincira/pma') }}">Ver PMAs</a></li>
                    <li><a href="{{ asset('/admincira/cargarpma') }}">Cargar excel PMA</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ asset('admincira/perfil') }}" title="Components">Perfil</a>
            </li>
        </ul><!-- .header-nav -->
    </div><!-- .container -->
</div><!-- .main-header -->