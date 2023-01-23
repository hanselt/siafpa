<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Area Funcional de Patrimonio Arqueologico</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="{{URL::asset('js/bootstrap.min.js') }}" crossorigin="anonymous"></script>
    
    <style type="text/css">
        body {
            background-image: url("{{ URL::asset('img/bg_dark.jpg') }}");
            background-color: #424242;
            font-family: monospace;
        }
        .container{
            width: 100%;
        }
        h2{
            color: #000000;
            text-align: center;
            border-bottom: solid thick #222;

        }
        h1{
            color: red;
            text-align: center;
        }
        dt{
            color: #000000;
        }
        input[type=text] {
            background: #292929;
            border: none;
            border-bottom: 1px solid red;
            color: #ddd;
            font-size: smaller;
        }
        img{
            border: 10px solid #222;
        }
    </style>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h2>MONUMENTOS ARQUEOLÓGICOS</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h1>RAQCHI</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <dl class="dl-horizontal">
                <dt>Nombre Proyecto</dt>
                <dd><input type="text" class="form-control" value="SOLICITA CIRA POLVORIN ACC RC40 01, PROVINCIA CAL..."></dd>
                <dt>Hoja Tramite</dt>
                <dd><input type="text" class="form-control" value="2015-10279"></dd>
                <dt>Fecha Recepción TD</dt>
                <dd><input type="text" class="form-control" value="01-12-2015"></dd>
                <dt>Fecha Recepción CIRA</dt>
                <dd><input type="text" class="form-control" value="02-12-2015"></dd>
                <dt>Administrador</dt>
                <dd><input type="text" class="form-control" value="RODRIGUES DE CARVALHO, RODNEY - GASODUCTO SUR PERU"></dd>
                <dt>Provincia</dt>
                <dd><input type="text" class="form-control" value="Calca"></dd>
                <dt>Distrito</dt>
                <dd><input type="text" class="form-control" value="Coya"></dd>
                <dt>Localidad</dt>
                <dd><input type="text" class="form-control" value="Coya"></dd>
            </dl>
        </div><!-- ./col -->
        <div class="col-xs-12 col-sm-6">
            <dl class="dl-horizontal">
                <dt>Extención Superficie</dt>
                <dd><input type="text" class="form-control" value="Área Total de 0.527451  ha. con un Perímetro Total.."></dd>
                <dt>Tipo de Obra</dt>
                <dd><input type="text" class="form-control" value="Habilitación de áreas"></dd>
                <dt>Resultado</dt>
                <dd><input type="text" class="form-control" value="EMITIDO"></dd>
                <dt>Motivo Desestimación</dt>
                <dd><input type="text" class="form-control" value="NO CORRESPONDE"></dd>
                <dt>Nro Cira</dt>
                <dd><input type="text" class="form-control" value="27-08-2017"></dd>
                <dt>Fecha Expedic. CIRA</dt>
                <dd><input type="text" class="form-control" value="05-01-2016"></dd>
                <dt>Fecha Notificación</dt>
                <dd><input type="text" class="form-control" value="05-01-2016"></dd>
                <dt>Archivo Cira</dt>
                <dd><input type="text" class="form-control" value=""></dd>
            </dl>
        </div><!-- ./col -->
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <img src="img/image.jpg" class="img-responsive"></a>
        </div><!-- ./col -->
        <div class="col-xs-12 col-sm-6">
            <a href="#" class="btn btn-danger full_with"><i class="glyphicon glyphicon-book"></i> Descargar PDF</a>
        </div><!-- ./col -->
    </div>
</div>
</body>
</html>
