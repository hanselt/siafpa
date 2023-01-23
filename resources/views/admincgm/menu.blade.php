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
                <a href="#" title="Components">Coordinaciones <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ route('admin_coordinacion_create') }}">Agregar Coordinación</a></li>
                    <li><a href="{{ route('ver_coordinaciones_admin') }}">Ver Coordinaciones</a></li>
                    <li><a href="{{ route('ver_monumentos_admin') }}">Ver Monumentos</a></li>
                </ul>
            </li>
            <li>
                <a href="#" title="Components">Actividades <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ route('admin_actividad_create') }}">Agregar Actividades</a></li>
                    <li><a href="{{ route('ver_actividades_admin') }}">Ver Actividades</a></li>
                </ul>
            </li>
            <li>
                <a href="#" title="Components">Tareas <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ route('admin_tarea_create') }}">Agregar Tareas</a></li>
                    <li><a href="{{ route('ver_tareas_admin') }}">Ver Tareas</a></li>
                </ul>
            </li>
            <li>
                <a href="#" title="Components">Acciones <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ route('admin_accion_create') }}">Agregar Acciones</a></li>
                    <li><a href="{{ route('ver_acciones_admin') }}">Ver Acciones</a></li>
                </ul>
            </li>
            <li>
                <a href="#" title="Components">Acciones trimestrales <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ route('ver_atrimestrales_admin') }}">Ver Acciones Trimestrales</a></li>
                    <li><a href="{{ route('ver_resumen_admin') }}">Ver Resumen Acciones Trimestrales</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('admincgm/perfil') }}" title="Components"> Perfil</a>
            </li>
        </ul><!-- .header-nav -->
    </div><!-- .container -->
</div><!-- .main-header -->