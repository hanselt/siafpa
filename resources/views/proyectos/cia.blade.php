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
            color: #d9534f;
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
            <h2>Calificación e Intervenciones Arqueológicas</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h1>{{$Proyecto->PROY_varTipo}}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <dl class="dl-horizontal">
                <dt>Nombre Proyecto</dt>
                <dd><input type="text" class="form-control" value="{{$Proyecto->PROY_varNombre}}"></dd>
                <dt>Hoja Tramite</dt>
                <dd><input type="text" class="form-control" value="{{$Proyecto->PROY_varHojaTramite}}"></dd>
                <dt>Departamento</dt>
                <dd><input type="text" class="form-control" value="{{$Proyecto->UBIG_varDepartamento}}"></dd>
                <dt>Provincia</dt>
                <dd><input type="text" class="form-control" value="{{$Proyecto->UBIG_varProvincia}}"></dd>
                <dt>Distrito</dt>
                <dd><input type="text" class="form-control" value="{{$Proyecto->UBIG_varDistrito}}"></dd>
                <dt>Calificador</dt>
                <dd><input type="text" class="form-control" value="{{$Persona->PERS_varNombres}}, {{$Persona->PERS_varApPaterno}} {{$Persona->PERS_varApMaterno}}"></dd>                
                <dt>Fecha Ingreso</dt>
                <dd><input type="text" class="form-control" value="{{substr($Proyecto->PROY_datFechaIngreso,0,10)}}"></dd>
                <dt>Tipo</dt>
                <dd><input type="text" class="form-control" value="{{$Proyecto->PROY_varTipo}}"></dd>
            </dl>
        </div><!-- ./col -->
        <div class="col-xs-12 col-sm-6">
            <dl class="dl-horizontal">
                <dt>Rubro</dt>
                <dd><input type="text" class="form-control" value="{{$Proyecto->PROY_varRubro}}"></dd>
                <dt>Empresa</dt>
                <dd><input type="text" class="form-control" value="{{$Proyecto->PROY_varEmpresa}}"></dd>                
                <dt>Resolución Aprobación</dt>
                <dd><input type="text" class="form-control" value="{{$Proyecto->PROY_varResolucionAprobacion}}"></dd>
                <dt>Fecha Res. Calificac</dt>
                <dd><input type="text" class="form-control" value="{{$Proyecto->PROY_varFechaNotResCalificacion}}"></dd>
                <dt>Fecha RD Aprobac</dt>
                <dd><input type="text" class="form-control" value="{{substr($Proyecto->PROY_datFechaRDAprobacion,0,10)}}"></dd>
                <dt>Plazo Ejecución</dt>
                <dd><input type="text" class="form-control" value="{{$Proyecto->PROY_varPlazoEjecucion}}"></dd>
            </dl>
        </div><!-- ./col -->
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            
        </div><!-- ./col -->
        <div class="col-xs-12 col-sm-6">
            @if(strlen($Proyecto->PROY_varDirArchivo)>1)
                <a href="/{{$Proyecto->PROY_varDirArchivo}}" class="btn btn-danger full_with"><i class="glyphicon glyphicon-book"></i> Descargar PDF</a>
            @else
                <a href="#" class="btn btn-danger full_with"><i class="glyphicon glyphicon-book"></i> Descargar PDF</a>
            @endif
            
        </div><!-- ./col -->
    </div>
</div>
</body>
</html>
