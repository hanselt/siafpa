@extends('templates.cira.layout')
@section('content')
@if(Auth::user()->nivel==4)
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box">
            <h3 class="content-box-header bg-danger" id="tittle">Coordinación de Certificaciones<br>
            Expedientes para emitir Opinión legal
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
                        <td>Vencimiento</td>
                        <td>Estado<br>(Calificador)</td>
                        <td>Opinión Legal</td>
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
                            <td><p style="display: none;" id="{{$Ingreso->CONT_varHojaTramite}}HIDDEN"></p><p id="{{$Ingreso->CONT_varHojaTramite}}V" class="toExport"></p></td>
                            <td><p id="{{$Ingreso->CONT_varHojaTramite}}CAL" class="toExport" align="center"></p></td>
                            <td>
                                <p style="display: none;" class="toExport">Proceso de revisión</p> 
                                <select id="{{$Ingreso->CONT_varHojaTramite}}SELECT">
                                    <option value="Procedente">Procedente</option>
                                    <option value="Improcedente">Improcedente</option>
                                    <option value="Observado">Observado</option>
                                    <option value="Decaído">Decaído</option>
                                </select>
                            </td>
                            <td>
                                <p style="display: none;" class="toExport">Emitir Opinión Legal</p>    
                                <a id="{{$Ingreso->CONT_varHojaTramite}}A" href="AbogadoCalificar/{{$Ingreso->CONT_varHojaTramite}}/accion.php" alt="Asignar" title="Calificar" onclick="return confirm('Esta calificando el exp {{$Ingreso->CONT_varHojaTramite}}');"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                            </td>
                            <script type="text/javascript">

                                var FechaAsignacion=new Date("{{$Ingreso->CONT_datFechaAsignacionArqlgo}}");
                                var FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");
                                var FechaVencimiento=new Date();
                                var tipoExp='{{$Ingreso->CONT_varTipo}}';
                                var nroantecedentes='{{$Ingreso->CONT_intDiasTramite}}';
                                var diasD=diasVencimiento(tipoExp,nroantecedentes);
                                FechaVencimiento=getBusinessDatesSum(FechaIngresoTD,diasD);
                                //tiempó
                                CadenaFecha=cadenaDate(FechaVencimiento);
                                var tdVenc=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}V').innerHTML=CadenaFecha;
                                var tiempoVenc=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}HIDDEN').innerHTML=listaFecha(FechaVencimiento);
                                //estado anterior
                                var str='{{$Ingreso->CONT_varEstado}}';
                                var EstadoProy=str.split('/');
                                var EstadoPP=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}CAL').innerHTML=EstadoProy[0];
                                //.style.color="orange";
                                var colorBG;
                                if (EstadoProy[0]=='Procedente') {
                                    colorBG=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}BG').style.color="#424242";
                                }
                                else {}
                                //
                                $('#{{$Ingreso->CONT_varHojaTramite}}A').on('click',function(e){
                                    var Estado=$("#{{$Ingreso->CONT_varHojaTramite}}SELECT").val();
                                    var Route="AbogadoCalificar/{{$Ingreso->CONT_varHojaTramite}}/";
                                    var DD=Estado;
                                    var cadena=Route.concat(DD);
                                    $("#{{$Ingreso->CONT_varHojaTramite}}A").attr("href", cadena);
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
@else
        <div class="hero-box poly-bg-5 hero-box-smaller font-inverse" style="background:url('{{ URL::asset('img/poly-bg/poly-bg-5.jpg') }}')">
            <div class="container">
                <h2 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Advertencia</h2>
                <p class="hero-text wow bounceInUp" data-wow-duration="0.9s" data-wow-delay="0.2s">Acceso Restringido.</p>
            </div>
        </div>
@endif


@endsection