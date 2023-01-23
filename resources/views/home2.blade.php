@extends('layouts.default2')
@push('stylesheets')
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/select2/select2.css') }}" crossorigin="anonymous">
    <!-- fancybox CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/fancybox/jquery.fancybox.min.css') }}" crossorigin="anonymous">
@endpush

<div id="theme-options" class="is-open active">
    <a href="#" class="btn btn-primary theme-switcher tooltip-button" data-placement="left" >
        <i class="glyph-icon icon-linecons-cog icon-spin"></i>
    </a>
    <div id="theme-switcher-wrapper ">
        <div class="scroll-switcher">
            <div class="example-box-wrapper">
                <ul class="list-group row list-group-icons">
                    <li id="PanelCGM" class="col-md-3 col-xs-3 active">
                        <a href="#tab-example-1" data-toggle="tab" class="list-group-item tabMapa" title="Gestión de Monumentos"><img src="{{ URL::asset('img/icon1_red.png') }}"></a>
                    </li>
                    <li id="PanelCIRA" class="col-md-3 col-xs-3">
                        <a href="#tab-example-2" data-toggle="tab" class="list-group-item tabMapa" title="Certificaciones" ><img src="{{ URL::asset('img/icon2_red.png') }}"></a>
                    </li>
                    <li id="PanelCATASTRO" class="col-md-3 col-xs-3">
                        <a href="#tab-example-3" data-toggle="tab" class="list-group-item tabGeo" title="Catastro y Saneamiento Físico Legal" > <img src="{{ URL::asset('img/icon3_red.png') }}"></a>
                    </li>
                    <li id="PanelCIA" class="col-md-3 col-xs-3">
                        <a href="#tab-example-4" data-toggle="tab" class="list-group-item tabMapa" title="Calificaciones e Intervenciones Arqueológicas" > <img src="{{ URL::asset('img/icon4_red.png') }}"></a>
                    </li>
                </ul>
                <div class="tab-content" style="min-height: 150px; padding-top:0px" >
                    <div class="tab-pane fade active in" id="tab-example-1" style="padding-top:0px">
                        <ul class="reset-ul">
                            <li>
                                <label for="boxed-layout" class="labelWhite"><input type="checkbox" id="cbCOORDINACIONES" checked> Coordinaciones</label> <img src="{{ URL::asset('img/coordinaciones.png') }}">
                            </li>
                            <li>
                                <label for="boxed-layout" class="labelWhite"><input type="checkbox" id="cbMONUMENTOS" checked> Monumentos</label> <img src="{{ URL::asset('img/monumentos.png') }}">
                            </li>
                            <li>
                                <select id="selectNombre" class="js-example-placeholder-single" placeholder="Escriba una ubicación">
                                    <option>Seleccione un Monumento</option>
                                </select>
                                <p id="BuscarMapa" name="BuscarMapa" class="full_with btn btn-primary" style="border-color: white;background-color: #433d3a"> BUSCAR </p>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab-example-2" style="padding-top:0px">
                        <ul class="reset-ul">
                            <li class="labelWhite">
                                <label for="boxed-layout"><input type="checkbox" id="cbCIRAS" checked> CIRA</label> <img src="{{ URL::asset('img/ciras.png') }}">
                            </li>
                            <li class="labelWhite">
                                <label for="boxed-layout"><input type="checkbox" id="cbPMAS" checked> PMA</label> <img src="{{ URL::asset('img/pmas.png') }}">
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab-example-3" style="padding-top:0px">
                    </div>
                    <div class="tab-pane fade" id="tab-example-4" style="padding-top:0px">
                        <ul class="reset-ul">
                            <li class="labelWhite">
                                <label for="boxed-layout"><input type="checkbox" id="cbPIA" checked> PIA</label> <img src="{{ URL::asset('img/pia.png') }}">
                            </li>
                            <li class="labelWhite">
                                <label for="boxed-layout"><input type="checkbox" id="cbPEA" checked> PEA</label> <img src="{{ URL::asset('img/pea.png') }}">
                            </li>
                            <li class="labelWhite">
                                <label for="boxed-layout"><input type="checkbox" id="cbPRIA" checked> PRIA</label> <img src="{{ URL::asset('img/pria.png') }}">
                            </li>
                            <li class="labelWhite">
                                <label for="boxed-layout"><input type="checkbox" id="cbOTRO" checked> OTROS</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div id="panelTemporal" class="example-box-wrapper">
                <ul class="list-group list-group-separator row list-group-icons">
                    <li class="col-md-4 col-xs-4  active">
                        <a href="#tab-example-A" data-toggle="tab" class="list-group-item" title="Capas">
                            <i class="glyph-icon icon-database"></i>
                        </a>
                    </li>
                    <li class="col-md-4 col-xs-4">
                        <a href="#tab-example-B" data-toggle="tab" class="list-group-item" title="Punto Temporal">
                            <i class="glyph-icon icon-map-marker"></i>
                        </a>
                    </li>
                    <li class="col-md-4 col-xs-4">
                        <a href="#tab-example-C" data-toggle="tab" class="list-group-item" title="Punto Temporal">
                            <i class="glyph-icon icon-area-chart"></i>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab-example-A"  style="padding-top:0px">
                        <ul class="reset-ul">
                            <li>
                                <label class="labelWhite"><input type="checkbox" id="cbDistritos"> Distritos</label>
                            </li>
                            <li>
                                <label class="labelWhite"><input type="checkbox" id="cbProvincias"> Provincias</label>
                            </li>
                            <li>
                                <label class="labelWhite"><input type="checkbox" id="cbCartas"> Cartas</label>    
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab-example-B" style="padding-top:0px">
                        <div id="calculo2">
                            <dl class="dl-horizontal" style="margin-bottom: 0px;">
                                <dt style="color: white"><strong> X </strong></dt>
                                <dd><input type="number" style="color: black" id="xx" name="xx" step="any"></dd>
                                <dt style="color: white"><strong> Y </strong></dt>
                                <dd><input type="number" style="color: black" id="yy" name="yy" step="any"></dd>
                                <dt style="color: white"><strong> ZONA </strong></dt>
                                <dd><input type="number" style="color: black" id="zz" name="zz" ></dd>
                            </dl>
                            <br/>
                            <center>
                                <button id="PintarPunto" name="PintarPunto" class="btn btn-danger"><i class="glyphicon glyphicon-map-marker"></i> Pintar Punto Temporal</button>
                            </center>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-example-C" style="padding-top:0px">
                        <div class="form-group">
                            <form enctype="multipart/form-data" class="formulario">
                                <input name="archivo" type="file" id="imagen" class="labelWhite" /><br />
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
        </div>
    </div>
</div>


<div class="main-header bg-red font-inverse wow fadeInDown" style="height:60px">
    <div class="container">
        <a href="{{ asset("") }}" class="header-logo" title="Area Funcional De Patrimonio Arqueológico" style="background:url('{{ URL::asset('img/logo.png') }}'); margin-bottom:5px"></a><!-- .header-logo -->
        <div class="right-header-btn" style="float:right">
            <a href="{{ asset("acceder") }}" title="Salir" class="btn btn-sm btn-danger"><i class="glyph-icon icon-key"></i> Inicio</a>
        </div>
        <img class="img-responsive" src="{{ URL::asset('img/marco.png') }}" alt="Ministerio de Cultura" style="float:right; max-width: 400px; margin-top: 10px " />
    </div><!-- .container -->
</div><!-- .main-header -->
@section('content')

<div id="panelMapa">
    @include('layouts.partials.mapa')
</div>
<div id="htmlcatastro123" style="display: none;"></div>

<div id="parrafoError"> </div>
    @push('scripts')
        <script src="{{URL::asset('assets/plugins/select2/select2.js') }}"></script>
    @endpush

    <script  type="text/javascript">

        $(".tabMapa").on("click", function() {
            $("#panelMapa").show();
            $("#htmlcatastro123").hide();
            $("#panelTemporal").show();
        });
        $(".tabGeo").on("click", function() {
            $("#panelMapa").hide();
            $("#htmlcatastro123").show();
            $("#panelTemporal").hide();
            $('#theme-options').toggleClass('active');
        });
        
    </script>
@endsection
