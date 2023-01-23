<div class="main-header bg-red font-inverse wow fadeInDown" style="height:60px">
    <div class="container">
        <a href="{{ asset("") }}" class="header-logo" title="Area Funcional De Patrimonio Arqueológico" style="background:url('{{ URL::asset('img/logo.png') }}')"></a><!-- .header-logo -->
        <img class="img-responsive" src="{{ URL::asset('img/marco.png') }}" alt="Ministerio de Cultura" style="float:right; max-width: 400px; margin-top: 10px " />
        <div class="right-header-btn">
            <div class="search-btn">
                <a href="#" class="popover-button" title="Capas" data-placement="bottom" data-id="#popover-marca">
                    <i class="glyph-icon icon-reorder"  title="Capas"></i>
                </a>
                <div class="hide" id="popover-marca">
                    <div class="pad5A box-md">
                        <div class="input-group">
                            <label><input type="checkbox" id="cbCatastro"> Distritos</label>
                            <label><input type="checkbox" id=""> Provincias</label>
                            <label><input type="checkbox" id="cbZonas"> Laminas</label>
                            <label><input type="checkbox" id="cbCartas"> Cartas</label>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .header-logo -->
        <div class="right-header-btn">
            <div class="search-btn">
                <a href="#" class="popover-button" title="Punto Temporal" data-placement="bottom" data-id="#puntoT">
                    <i class="glyph-icon icon-map-marker" title="Punto Temporal"></i>
                </a>
                <div class="hide" id="puntoT">
                    <div id="calculo2">
                        <dl class="dl-horizontal" style="margin-bottom: 0px;">
                            <dt> X </dt>
                            <dd>X <input type="number" style="color: black" id="xx" name="" step="any"></dd>
                            <dt> Y </dt>
                            <dd><input type="number" style="color: black" id="yy" name="" step="any"></dd>
                            <dt>Zona</dt>
                            <dd><input type="number" style="color: black" id="zz" name=""></dd>
                        </dl>
                        <br/>
                        <center>
                            <p id="PintarPunto" name="PintarPunto" class="btn btn-danger"><i class="glyphicon glyphicon-map-marker"></i> Pintar Punto Temporal</p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-header-btn">
            <div class="search-btn">
                <a href="#" class="popover-button" title="KML" data-placement="bottom" data-id="#kml">
                    <i class="glyph-icon icon-area-chart" title="KML"></i>
                </a>
                <div class="hide" id="kml">
                    <div class="form-group">
                        <form enctype="multipart/form-data" class="formulario" style="color:white">
                            <input name="archivo" type="file" id="imagen" /><br />
                            <input type="button" value="Subir KML" class="btn btn-default"/>
                            <p id="CargarKml" name="CargarKml" type="button" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Cargar KML</p>
                        </form>
                        <!--div para visualizar mensajes-->
                        <div class="messages"></div>
                        <input type="hidden" name="" id="DirKMLtemp">                    

                        <!--div para visualizar en el caso de imagen-->
                        <div class="showImage style.display='none'" id="KmlTemp"></div>
                    </div>
                </div>
            </div>
        </div>



        {{-- <div class="right-header-btn">
            <div id="mobile-navigation">
                <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target=".header-nav"><span></span></button>
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
        </ul><!-- .header-nav --> --}}
    </div><!-- .container -->
</div><!-- .main-header -->