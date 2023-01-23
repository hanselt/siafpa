@extends('templates.cira.layout')

@section('content')

<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box" >
            <h3 class="content-box-header bg-danger" id="tittle">Coordinación de Certificaciones<br>
            Control de tiempos en expedientes
            </h3>

            <div class="admin_responsive_table">
                <br>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <br>
                <table class="table" id="MyTable" name="MyTable">
                    <thead>
                    <tr>
                        <td>Hoja de Ruta</td>
                        <td>Tipo</td>
                        <td>Nombre del Proyecto</td>
                        <td>Fecha Ingreso TD</td>
                        <td>Fecha Vencimiento</td>
                        <td>Dias habiles</td>
                        <td>Estado</td>
                    <!-- <td><b>Horario</b></td> -->
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tiempos as $Ingreso)
                        <tr id="{{$Ingreso->CONT_varHojaTramite}}BG">
                            <td><p class="toExport">{{ $Ingreso->CONT_varHojaTramite }}</p></td>
                            <td><p class="toExport">{{ $Ingreso->CONT_varTipo }}</p></td>
                            <td><p class="toExport">{{ $Ingreso->CONT_varNombreProyecto }}</p></td>
                            <td><p style="display: none;" id="{{$Ingreso->CONT_varHojaTramite}}VHD"></p><p class="toExport" id="{{$Ingreso->CONT_varHojaTramite}}T"></p></td>
                            <td><p style="display: none;" id="{{$Ingreso->CONT_varHojaTramite}}VHV"></p><p class="toExport" id="{{$Ingreso->CONT_varHojaTramite}}V"></p></td>
                            <td><p class="toExport" id="{{$Ingreso->CONT_varHojaTramite}}D"></p></td>
                            <td><p  style="display: none;" class="toExport" id="{{$Ingreso->CONT_varHojaTramite}}ICO"></p><i  id="{{$Ingreso->CONT_varHojaTramite}}ICON" style="color: red" class="fa fa-book" aria-hidden="true"></i></a>
                            </td>
                            <script type="text/javascript">
                                //Timess();
                                var FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");
                               
                                var CadenaFecha=cadenaDate(FechaIngresoTD);
                                
                                var ordenEstado=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}ICO').innerHTML='A';

                                var FechaActual=new Date();
                                var numerodias=getBusinessDatesCount(FechaIngresoTD,FechaActual);
                                FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");
                                var tdFecha=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}VHD').innerHTML='('+listaFecha(FechaIngresoTD)+')';
                                //
                                var FechaVencimiento=new Date();
                                var nroantecedentes='{{$Ingreso->CONT_intDiasTramite}}';
                                var diasD=diasVencimiento('{{$Ingreso->CONT_varTipo}}',nroantecedentes);
                                
                                FechaVencimiento=getBusinessDatesSum(FechaIngresoTD,diasD);
                                var CadenaFechaV=cadenaDate(FechaVencimiento);
                                var tdVenc=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}V').innerHTML=CadenaFechaV;
                                var tdFechaV=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}VHV').innerHTML='('+listaFecha(FechaVencimiento)+')';
                                //
                                var tdFechas=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}T').innerHTML=CadenaFecha;
                                var tdDias=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}D').innerHTML=(numerodias);
                                if ("{{$Ingreso->CONT_varTipo}}"=="PMA" || "{{$Ingreso->CONT_varTipo}}"=="Levantamiento Obs. PMA" || "{{$Ingreso->CONT_varTipo}}"=="Reingreso PMA") {

                                    if (numerodias<4) {
                                        var tdIcono=document.getElementById("{{$Ingreso->CONT_varHojaTramite}}ICON").style.color="green";
                                        ordenEstado=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}ICO').innerHTML='A';
                                    }
                                    else{
                                        if (numerodias<8) {
                                            var tdIcono=document.getElementById("{{$Ingreso->CONT_varHojaTramite}}ICON").style.color="orange";
                                            ordenEstado=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}ICO').innerHTML='B';
                                        }
                                        else{
                                            var tdIcono=document.getElementById("{{$Ingreso->CONT_varHojaTramite}}ICON").style.color="red";
                                            var tdIconos=document.getElementById("{{$Ingreso->CONT_varHojaTramite}}BG").style.color="red";
                                            ordenEstado=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}ICO').innerHTML='C';
                                        }
                                    }
                                }
                                if ("{{$Ingreso->CONT_varTipo}}"=="CIRA" || "{{$Ingreso->CONT_varTipo}}"=="Levantamiento Obs. CIRA" || "{{$Ingreso->CONT_varTipo}}"=="Reingreso CIRA") {
                                    if (numerodias<8) {
                                        var tdIcono=document.getElementById("{{$Ingreso->CONT_varHojaTramite}}ICON").style.color="green";
                                        ordenEstado=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}ICO').innerHTML='A';
                                    }
                                    else{
                                        if (numerodias<16) {
                                            var tdIcono=document.getElementById("{{$Ingreso->CONT_varHojaTramite}}ICON").style.color="orange";
                                            ordenEstado=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}ICO').innerHTML='B';
                                        }
                                        else{
                                            var tdIcono=document.getElementById("{{$Ingreso->CONT_varHojaTramite}}ICON").style.color="red";
                                            var tdIconos=document.getElementById("{{$Ingreso->CONT_varHojaTramite}}BG").style.color="red";
                                            ordenEstado=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}ICO').innerHTML='C';
                                        }
                                    }                                        
                                }
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