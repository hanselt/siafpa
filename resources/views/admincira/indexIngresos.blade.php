@extends('templates.cira.layout')
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box">
            <h3 class="content-box-header bg-danger" >
                Lista de Ingresos en la Coordinacion de Certificaciones
            </h3>

            <div class="admin_responsive_table">
                
                <br>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <br>
                <table class="table" id="selectTable" name="selectTable">
                    <thead>
                    <tr>
                        <td>Hoja de Ruta</td>
                        <td>Tipo</td>
                        <td>Nombre del Proyecto</td>
                        <td>Días transcurridos</td>
                        <td>Calificador</td>
                        <td>Acción</td>
                    <!-- <td><b>Horario</b></td> -->
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ListaIngresos as $Ingreso)
                        <tr>
                            <td><font size="2">{{ $Ingreso->CONT_varHojaTramite }}</font></td>
                            <td><font size="2">{{ $Ingreso->CONT_varTipo }}</font></td>
                            <td><font size="2">{{ $Ingreso->CONT_varNombreProyecto }}</font></td>
                            <td><p id="{{$Ingreso->CONT_varHojaTramite}}D"></p></td>
                            <td>
                            <select id="{{$Ingreso->CONT_varHojaTramite}}">
                            @foreach($Calificadores as $Calificador) 
                            <option value="{{$Calificador->PERS_varDNI}}">{{$Calificador->PERS_varNombres}}, {{$Calificador->PERS_varApPaterno}} {{$Calificador->PERS_varApMaterno}}</option>
                            @endforeach
                            </select>
                            </td>  
                            <td>   
                                <a id="{{$Ingreso->CONT_varHojaTramite}}A" href="calificador/{{$Ingreso->CONT_varHojaTramite}}/accion.php" alt="Asignar" title="Calificar" onclick="return confirm('Desea asignar el calificador');"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                            </td>
                            <script type="text/javascript">                            
                            $('#{{$Ingreso->CONT_varHojaTramite}}A').on('click',function(e){
                                var DNI=$("#{{$Ingreso->CONT_varHojaTramite}}").val();
                                var Route="calificador/{{$Ingreso->CONT_varHojaTramite}}/";
                                var DD=DNI;
                                var cadena=Route.concat(DD);
                                $("#{{$Ingreso->CONT_varHojaTramite}}A").attr("href", cadena);
                            });
                            var FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");
                            var FechaActual=new Date();
                            var numerodias=getBusinessDatesCount(FechaIngresoTD,FechaActual);
                            var tdDias=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}D').innerHTML=(numerodias);    
                            </script>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>


@endsection