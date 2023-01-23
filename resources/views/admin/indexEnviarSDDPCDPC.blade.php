@extends('layouts.default')
@section('nav') 
    @if(Auth::user()->nivel==1)
    @include('admin.menu_admin')
    @elseif(Auth::user()->nivel==2)
    @include('admin.menu_afpa')
    @endif
@endsection
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box" style="background-color:#F2F7F8">
            <h3 class="content-box-header bg-danger" style="background-color: #cf4436" id="tittle">Área Funcional de Patrimonio Arqueológico<br>
            Lista de expedientes para enviar a Sub Dirección
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
                        <td>Fecha de Asignación</td>
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
                            <td><p style="display: none;" id="{{$Ingreso->CONT_varHojaTramite}}HIDDEN"></p><p id="{{$Ingreso->CONT_varHojaTramite}}DAT" class="toExport"></p></td>
                            <td><p id="{{$Ingreso->CONT_varHojaTramite}}T" class="toExport"></p></td>
                            <td><p style="display: none;" id="{{$Ingreso->CONT_varHojaTramite}}HIDDENV"></p><p id="{{$Ingreso->CONT_varHojaTramite}}V" class="toExport"></p></td>
                            <td>   
                                <p style="display: none;" class="toExport">Enviar a SDDPCDPC</p>
                                <a href="enviar_sdd/{{$Ingreso->CONT_varHojaTramite}}" alt="Asignar" title="Enviar a Sub Dirección."><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                            </td>
                            <script type="text/javascript">
                                var FechaAsignacion=new Date("{{$Ingreso->CONT_datFechaAsignacionArqlgo}}");
                                var FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");
                                var CadenaFecha=cadenaDate(FechaAsignacion);
                                var tdFecha=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}DAT').innerHTML=CadenaFecha;
                                var tdFecha2=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}HIDDEN').innerHTML=listaFecha(FechaAsignacion);
                                var FechaActual=new Date();
                                
                                var numerodias=getBusinessDatesCount(FechaAsignacion,FechaActual);
                                var tdDias=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}T').innerHTML=(numerodias);
                                //getBusinessDatesSum
                                var FechaVencimiento=new Date();
                                var tipoExp='{{$Ingreso->CONT_varTipo}}';
                                var nroantecedentes='{{$Ingreso->CONT_intDiasTramite}}';
                                var diasD=diasVencimiento(tipoExp,nroantecedentes);
                                FechaVencimiento=getBusinessDatesSum(FechaIngresoTD,diasD);
                                var CadenaFechaV=cadenaDate(FechaVencimiento);

                                var tdVenc=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}V').innerHTML=CadenaFechaV;
                                var tdVenc2=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}HIDDENV').innerHTML=listaFecha(FechaVencimiento);
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