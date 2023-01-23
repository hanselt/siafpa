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
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                <a href="#" title="Components">Funcionarios <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ route('admin.admin_persona_create') }}">Agregar Funcionarios</a></li>
                    <li><a href="{{ route('admin.ver_personas_admin') }}">Ver Funcionarios</a></li>
                </ul>
            </li>
            <li>
                <a href="#" title="Components">Administradores <i class="glyph-icon icon-angle-down"></i></a>
                <ul>
                    <li><a href="{{ route('admin.admin_afpa_list') }}">Administradores AFPA</a></li>
                    <li><a href="{{ route('admin.admin_ciras_list') }}">Administradores Certificaciones</a></li>
                    <li><a href="{{ route('admin.admin_catastros_list') }}">Administradores Catastro</a></li>
                    <li><a href="{{ route('admin.admin_cgms_list') }}">Administradores Gestión de Monumentos</a></li>
                    <li><a href="{{ route('admin.admin_calificaciones_list') }}">Administradores Calificaciones</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ asset('admin/perfil') }}">Perfil</a>
            </li>
        </ul><!-- .header-nav -->
    </div><!-- .container -->
</div><!-- .main-header -->