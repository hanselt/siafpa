<div class="main-header bg-red font-inverse wow fadeInDown">
    <div class="container">
        <a href="{{ asset("") }}" class="header-logo" title="Area Funcional De Patrimonio Arqueológico" style="background:url('{{ URL::asset('img/logo.png') }}')"></a><!-- .header-logo -->
        <div class="right-header-btn">
            <div id="mobile-navigation">
                <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target=".header-nav"><span></span></button>
            </div>
            <div class="search-btn">
                <a href="#" class="popover-button" title="Search" data-placement="bottom" data-id="#popover-search">
                    <i class="glyph-icon icon-search"></i>
                </a>
                <div class="hide" id="popover-search">
                    <div class="pad5A box-md">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search terms here ...">
                            <span class="input-group-btn">
                                <a class="btn btn-primary" href="#">Search</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .header-logo -->
        <ul class="header-nav collapse">
            <li>
                <a href="#" title="Homepages">
                    Inicio
                    <i class="glyph-icon icon-angle-down"></i>
                </a>
                <ul>
                    <li><a href="#">Quienes Somos</a></li>
                    <li><a href="#">Misión</a></li>
                    <li><a href="#">Visión</a></li>
                    <li><a href="#">Objetivos</a></li>
                </ul>
            </li>
            <li>
                <a href="#" title="Components">
                    Información
                    <i class="glyph-icon icon-angle-down"></i>
                </a>
                <ul>
                    <li><a href="#">Preguntas Frecuentes</a></li>
                    <li><a href="#">Informacion acerca del Area de Catastro</a></li>
                    <li><a href="#">Informacion acerca del Area de Gestion de Monumentos</a></li>
                    <li><a href="#">Informacion acerca del Area de Certificacions</a></li>
                    <li><a href="#">Informacon acerca de la Coordinacion de Calificaciones e Intervenciones Arqueologicas</a></li>
                </ul>
            </li>
        </ul><!-- .header-nav -->
    </div><!-- .container -->
</div><!-- .main-header -->