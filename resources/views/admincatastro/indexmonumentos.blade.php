@extends('layouts.default')
@section('nav')
  @include('admincatastro.menu')
@endsection
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box" style="background-color:#F2F7F8">
            <h3 class="content-box-header bg-danger">
                Administracion de Monumentos
            </h3>

            <div class="admin_responsive_table">
                <a href="{{ route('admin_monumento_create') }}" class="btn btn-primary">Agregar Monumento</a>
                <br>
                <br>
                <table class="table" id="MyTable" name="MyTable">
                    <thead>
                    <tr>
                        <td><b><font size="2"> Departamento<br>Provincia<br>Distrito</font></b></td>
                        <td><b><font size="2"> Coordinación</font></b></td>
                        <td><b><font size="2"> Estado</font></b></td>
                        <td><b><font size="2"> Tipo</font></b></td>
                        <td><b><font size="2"> Categoría.</font></b></td>
                        <td><b><font size="2"> Nombre</font></b></td>
                        <td><b><font size="2"> Coordenadas</font></b></td>
                        <td><b><font size="2">Declaratoria</font></b></td>
                        <td><b><font size="2">Delimitación</font></b></td>
                        <!--<td><b>Etimol.</b></td>-->
                        <td><b><font size="2">KML</font></b></td>
                        <td></td>
                    <!-- <td><b>Horario</b></td> -->

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($monumentos as $monumento)
                        <tr>
                            <td><font size="1">{{ $monumento->MONU_varDU }}</font></td>
                            <td><font size="2">{{ $monumento->COOR_varNombre }}</font></td>
                            <td><font size="2">{{ $monumento->MONU_varTipo }}</font></td>
                            <td><font size="2">{{ $monumento->MONU_varEstado }}</font></td>
                            <td><font size="2">{{ $monumento->MONU_varCategoria }}</font></td>
                            <td><font size="2">{{ $monumento->MONU_varNombre }}</font></td>                                                        
                            <!--<td><font size="2">{{ substr($monumento->MONU_varDescripcionArquitectura, 0, 20) }}</font></td>-->
                        <!-- <td><font size="2">{{ $monumento->MONU_varEtimologia }}</font></td>-->                            
                            <td><font size="2"><div id="{{ $monumento->MONU_intId }}" name="{{ $monumento->MONU_intId }}"></div></font></td>
                            <script>
                                  var xy = new Array(2);
                                  zone = Math.floor (({{ $monumento->MONU_douCoordenadaLongitud }} + 180.0) / 6) + 1
                                  zone = LatLonToUTMXY (DegToRad ({{ $monumento->MONU_douCoordenadaLatitud }}), DegToRad ({{ $monumento->MONU_douCoordenadaLongitud }}), zone, xy);
                                  var str1="X:"+parseFloat(xy[0])+"<br>";
                                  var str2="Y:"+parseFloat(xy[1])+"<br>";
                                  var str3="Zona: "+parseFloat(zone);
                                  var texto=str1+str2+str3;
                                  document.getElementById("{{ $monumento->MONU_intId }}").innerHTML=texto;
                            </script>
                            @if($monumento->MONU_varDirArchivoREDeclaratoria!='')
                            <td> 
                            <center><a  target="_blank" class="fa fa-file-excel-o fa-2x" href="{{$monumento->MONU_varDirArchivoREDeclaratoria }}"></a></center>
                            </td>
                            @else
                            <td> <center><a  target="_blank" class="fa fa-file-o fa-2x" ></a></center></td>
                            @endif

                            @if($monumento->MONU_varDirArchivoREDelimitacion!='')
                            <td> <center><a target="_blank" class="fa fa-file-pdf-o fa-2x" href="{{$monumento->MONU_varDirArchivoREDelimitacion }}"></a></center></td>
                            @else
                            <td> <center><a  target="_blank" class="fa fa-file-o fa-2x" ></a></center></td>
                            @endif

                            @if($monumento->MONU_varDirArchivoKML!='')
                            <td> <center><a target="_blank" class="fa fa-file-code-o fa-2x" href="{{$monumento->MONU_varDirArchivoKML }}"></a></center></td>
                            @else
                            <td> <center><a  target="_blank" class="fa fa-file-o fa-2x" ></a></center></td>
                            @endif
                        <!--<td>{{ substr($monumento->MONU_varHorarioAtencion, 0, 10) }}</td>-->
                            <td>
                                <a href="{{ route('admincatastro.admin_archivos_create',$monumento->MONU_intId) }}" alt="Edit" title="Agregar Archivos" ><i class="fa fa-map-o" aria-hidden="true"></i></a>
                                <a href="{{ route('admincatastro.admin_monumento_edit',$monumento->MONU_intId) }}" alt="Editar" title="Editar" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="#" alt="Delete" title="Eliminar" onclick="return confirm('Are you sure you want to delete? ');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>


@endsection