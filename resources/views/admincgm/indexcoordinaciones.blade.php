@extends('layouts.default')
@section('nav')
   
@endsection
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box table-responsive">
            <h3 class="content-box-header bg-danger">Panel de Administración de Coordinaciones</h3>
            <a href="coordinacion/create" class="btn btn-black">Agregar Coordinacion</a>
            <table class="table table-striped table-hover" id="MyTable">
                <thead>
                <tr>
                    <td><b>ID</b></td>
                    <td><b>Ubicación Geográfica</b></td>
                    <td><b>Encargado</b></td>
                    <td><b>Nombre</b></td>
                    <td><b>Fecha de Creación</b></td>
                    <td><b>Dirección</b></td>
                    <td><b>Horario de atención</b></td>
                    <td><b>Coordenadas referenciales</b></td>
                    <td><b></b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($coordinaciones as $coordinacion)
                    <tr>
                        <td>{{ $coordinacion->COOR_intId }}</td>                            
                        <td><div id="{{ $coordinacion->UBIG_varID }}" name="{{ $coordinacion->UBIG_varID }}"></div></td>
                        <script>
                            $.get('/admincgm/nomubigeo?ubigeo='+'{{$coordinacion->UBIG_varID}}',function (data){
                                 document.getElementById("{{$coordinacion->UBIG_varID}}").innerHTML=data;
                            });                                        
                        </script>
                        <td>{{ $coordinacion->PERS_varApPaterno }} {{ $coordinacion->PERS_varApMaterno }}, {{ $coordinacion->PERS_varNombres }}</td>
                        <td>{{ $coordinacion->COOR_varNombre }}</td>
                        <td>{{ $coordinacion->COOR_datFechaCreacion }}</td>
                        <td>{{ $coordinacion->COOR_varDireccion }}</td>
                        <td>{{ $coordinacion->COOR_varHorarioAtencion }}</td>
                        <td><div id="{{ $coordinacion->COOR_intId }}" name="{{ $coordinacion->COOR_intId }}"></div></td>
                        <script>
                              var xy = new Array(2);
                              zone = Math.floor (({{ $coordinacion->COOR_varCoordenadaLongitud }} + 180.0) / 6) + 1
                              zone = LatLonToUTMXY (DegToRad ({{ $coordinacion->COOR_varCoordenadaLatitud }}), DegToRad ({{ $coordinacion->COOR_varCoordenadaLongitud }}), zone, xy);
                              var str1="X:"+parseFloat(xy[0])+"<br>";
                              var str2="Y:"+parseFloat(xy[1])+"<br>";
                              var str3="Zona: "+parseFloat(zone);
                              var texto=str1+str2+str3;
                              document.getElementById("{{ $coordinacion->COOR_intId }}").innerHTML=texto;
                        </script>
                        <td><a href="{{ route('admincgm.admin_coordinacion_edit', $coordinacion->COOR_intId ) }}" alt="Edit" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="delete" alt="Delete" title="Delete" onclick="return confirm('Are you sure you want to delete? ');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection