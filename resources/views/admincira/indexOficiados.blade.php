<!--13 nov-->
@extends('templates.cira.layout')
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box">
            <h3 class="content-box-header bg-danger"  id="tittle">Coordinación de Certificaciones<br>
            Lista de Expedientes para Oficiar
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
                        <td>Emisión de Oficio</td>
                        <td>Tiempo de Expediente en CC</td>
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
                            <td>
                                <input type="Date" id="{{$Ingreso->CONT_varHojaTramite}}FECHA" min="" max=""  value="{{\Carbon\Carbon::now()->toDateString()}}">                                
                            </td>
                            <td><p id="{{$Ingreso->CONT_varHojaTramite}}T" class="toExport"></p id=""></td>
                            <td><p style="display: none;" id="{{$Ingreso->CONT_varHojaTramite}}VHD"></p><p id="{{$Ingreso->CONT_varHojaTramite}}V" class="toExport"></p id=""></td>
                            <td>  
                                <a href="#" alt="Asignar" id="{{$Ingreso->CONT_varHojaTramite}}A" title="Recepcionar Exp." onclick="return confirm('Esta oficiando el expediente {{$Ingreso->CONT_varHojaTramite}}');"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                            </td>
                            <script type="text/javascript">
                                

                                var FechaAsignacion=new Date("{{$Ingreso->CONT_datFechaEmisionCC}}");
                                var FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");
                                
                                var FechaActual=new Date();
                                var numerodias=getBusinessDatesCount(FechaIngresoTD,FechaActual);

                                var tdDias=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}T').innerHTML=(numerodias);
                                //getBusinessDatesSum
                                var FechaVencimiento=new Date();
                                var nroantecedentes='{{$Ingreso->CONT_intDiasTramite}}';
                                var diasD=diasVencimiento('{{$Ingreso->CONT_varTipo}}',nroantecedentes);
                                FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");
                                FechaVencimiento=getBusinessDatesSum(FechaIngresoTD,diasD);
                    
                                
                                CadenaFechaV=cadenaDate(FechaVencimiento);
                                //
                                var tdVenc=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}V').innerHTML=CadenaFechaV;
                                var tdFecha=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}VHD').innerHTML=listaFecha(FechaVencimiento);
                                $("#{{$Ingreso->CONT_varHojaTramite}}FECHA").focusout(function(){
                                    $(this).css("background-color", "#FFFFFF");
                                });
                                $('#{{$Ingreso->CONT_varHojaTramite}}A').on('click',function(e){
                                    var fecha=$("#{{$Ingreso->CONT_varHojaTramite}}FECHA").val();
                                    if (fecha=='') {alert('Ingrese una fecha para el expediente :'+'{{$Ingreso->CONT_varHojaTramite}}');$('#{{$Ingreso->CONT_varHojaTramite}}FECHA').focus();}
                                    else{
                                        fecha=$("#{{$Ingreso->CONT_varHojaTramite}}FECHA").val();
                                        var fechaControl=new Date(fecha);
                                        var FechaVencimiento=new Date();
                                        var nroantecedentes='{{$Ingreso->CONT_intDiasTramite}}';
                                        var diasD=diasVencimiento('{{$Ingreso->CONT_varTipo}}',nroantecedentes);
                                        FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");
                                        FechaVencimiento=getBusinessDatesSum(FechaIngresoTD,diasD);
                                        FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");
                                        if (fechaControl>FechaVencimiento) {
                                            alert('Debe oficiar antes de la fecha de vencimiento');
                                            $('#{{$Ingreso->CONT_varHojaTramite}}FECHA').focus();
                                        }
                                        else{
                                            if (fechaControl<FechaIngresoTD) {
                                                alert('Seleccione una fecha mayor a la de ingreso en la AFACGD: '+cadenaDate(FechaIngresoTD));
                                                $('#{{$Ingreso->CONT_varHojaTramite}}FECHA').focus();
                                            }
                                            else{
                                                var Route="oficiar/{{$Ingreso->CONT_varHojaTramite}}/";
                                                var DD=fecha;
                                                var cadena=Route.concat(DD);
                                                $("#{{$Ingreso->CONT_varHojaTramite}}A").attr("href", cadena);
                                                window.location.href = cadena;};
                                            }
                                    }
                                });
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