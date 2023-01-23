@extends('templates.cira.layout')
@section('content')
@if(Auth::user()->nivel==3)
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box">
            <h3 class="content-box-header bg-danger" id="tittle">Coordinación de Certificaciones<br>
            Calificación de expedientes
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
                        <td>Estado</td>
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
                            <td><p style="display: none;" id="{{$Ingreso->CONT_varHojaTramite}}VV"><p id="{{$Ingreso->CONT_varHojaTramite}}V" class="toExport"></p id=""></td>
                            <td>
                                <p style="display: none;" class="toExport">Proceso de revisión</p>   
                                <select id="{{$Ingreso->CONT_varHojaTramite}}SELECT">
                                    <option value="Procedente">Procedente</option>
                                    <option value="Improcedente">Improcedente</option>
                                    <option value="Observado">Observado</option>
                                </select>
                            </td>
                            <td>
                                <p style="display: none;" class="toExport">Calificar</p>     
                                <a id="{{$Ingreso->CONT_varHojaTramite}}A" href="calificador/{{$Ingreso->CONT_varHojaTramite}}/accion.php" alt="Asignar" title="Calificar" onclick="return confirm('Esta calificando el exp {{$Ingreso->CONT_varHojaTramite}}');"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                            </td>
                            <script type="text/javascript">
                                var FechaAsignacion=new Date("{{$Ingreso->CONT_datFechaAsignacionArqlgo}}");
                                var FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");                                                                
                                var FechaVencimiento=new Date();
                                var nroantecedentes='{{$Ingreso->CONT_intDiasTramite}}';
                                var diasD=diasVencimiento('{{$Ingreso->CONT_varTipo}}',nroantecedentes);
                                FechaVencimiento=getBusinessDatesSum(FechaIngresoTD,diasD);
                                //tiempó
                                var CadenaFecha=cadenaDate(FechaVencimiento);
                                var tdVencI=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}VV').innerHTML=listaFecha(FechaVencimiento);
                                var tdVenc=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}V').innerHTML=CadenaFecha;

                                $('#{{$Ingreso->CONT_varHojaTramite}}A').on('click',function(e){
                                    var Estado=$("#{{$Ingreso->CONT_varHojaTramite}}SELECT").val();
                                    var Route="calificacion/{{$Ingreso->CONT_varHojaTramite}}/";
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