<!--13 nov-->
@extends('layouts.default')
@section('nav')
    @if(Auth::user()->nivel==1)
    @include('admincalificacion.menu')
    @elseif(Auth::user()->nivel==2)
    @include('admincalificacion.menu2')
    @elseif(Auth::user()->nivel==3)
    @include('admincalificacion.menu3')
    @elseif(Auth::user()->nivel==4)
    @include('admincalificacion.menu4')
    @endif
@endsection
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box" style="background-color:#F2F7F8">
            <h3 class="content-box-header bg-danger" style="background-color: #cf4436" id="tittle">Coordinación de Certificaciones<br>
            Lista de Expedientes Observados
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
                        <td>Fecha de envío a CC</td>
                        <td>Tiempo de Expediente</td>
                        <td>Vencimiento</td>
                        <td>Acción</td>
                    <!-- <td><b>Horario</b></td> -->
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ListaExpedientes as $Ingreso)
                        <tr id="{{$Ingreso->CONT_varHojaTramite}}BG">
                            <td><p class="toExport">{{ $Ingreso->CONT_varHojaTramite }}</p></td>
                            <td><p class="toExport">{{ $Ingreso->CONT_varTipo }}</p></td>
                            <td><p class="toExport">{{ $Ingreso->CONT_varNombreProyecto }}</p></td>
                            <td><p style="display: none;" id="{{$Ingreso->CONT_varHojaTramite}}DATV"></p><p id="{{$Ingreso->CONT_varHojaTramite}}DAT" class="toExport"></p></td>
                            <td><p id="{{$Ingreso->CONT_varHojaTramite}}T" class="toExport"></p></td>
                            <td><p style="display: none;" id="{{$Ingreso->CONT_varHojaTramite}}VHD"></p><p id="{{$Ingreso->CONT_varHojaTramite}}V" class="toExport"></p></font></td>
                            <td>
                                <p style="display: none;" class="toExport">Recepcionar en CCIA</p>   
                                <a href="recepcionarObs/{{$Ingreso->CONT_varHojaTramite}}" alt="Asignar" title="Recepcionar Exp."><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                            </td>
                            <script type="text/javascript">
                                var FechaAsignacion=new Date("{{$Ingreso->CONT_datFechaEmisionCCIA}}");
                                

                                var CadenaFecha=cadenaDate(FechaAsignacion);
                                var tdFecha=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}DAT').innerHTML=CadenaFecha;
                                var tdFecha=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}DATV').innerHTML=listaFecha(FechaAsignacion);
                                var FechaActual=new Date();
                                var numerodias=getBusinessDatesCount(FechaAsignacion,FechaActual);
                                var tdDias=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}T').innerHTML=(numerodias);
                                //getBusinessDatesSum
                                var FechaVencimiento=new Date();
                                var nroantecedentes='{{$Ingreso->CONT_intDiasTramite}}';
                                var diasD=diasVencimiento('{{$Ingreso->CONT_varTipo}}',nroantecedentes);
                                var FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");
                                FechaVencimiento=getBusinessDatesSum(FechaIngresoTD,diasD);
                                var CadenaFechaV=cadenaDate(FechaVencimiento);
                                var tdVenc=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}V').innerHTML=CadenaFechaV;
                                var tdFecha=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}VHD').innerHTML=listaFecha(FechaVencimiento);
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