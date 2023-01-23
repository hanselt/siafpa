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
@if(Auth::user()->nivel==3)

<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box" style="background-color:#F2F7F8">
            <h3 class="content-box-header bg-danger" style="background-color: #cf4436" id="tittle">Coordinación de Certificaciones<br>
            Asignación de abogados para expedientes calificados
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
                        <!--13- nov-->
                        <td>Abogado</td>
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
                                <p style="display: none;" class="toExport">Selección de abogado</p>
                                <select id="{{$Ingreso->CONT_varHojaTramite}}ABG">
                                @foreach($Abogados as $Abogado)
                                <option value="{{$Abogado->PERS_varDNI}}">{{$Abogado->PERS_varNombres}},{{$Abogado->PERS_varApPaterno}} {{$Abogado->PERS_varApMaterno}}</option>
                                @endforeach
                                </select>
                            </td>
                            <td>
                                <p style="display: none;" class="toExport">Asignación</p>   
                                <a id="{{$Ingreso->CONT_varHojaTramite}}A" href="calificador/{{$Ingreso->CONT_varHojaTramite}}/accion.php" alt="Asignar" title="Calificar" onclick="return confirm('Esta asignando abogado al expediente {{$Ingreso->CONT_varHojaTramite}}');"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                            </td>
                            <!--13- nov-->
                            <script type="text/javascript">
                                var FechaAsignacion=new Date("{{$Ingreso->CONT_datFechaAsignacionArqlgo}}");
                                var FechaIngresoTD=new Date("{{$Ingreso->CONT_datFechaIngresoTD}}");                                                                
                                var FechaVencimiento=new Date();
                                var nroantecedentes='{{$Ingreso->CONT_intDiasTramite}}';
                                var diasD=diasVencimiento('{{$Ingreso->CONT_varTipo}}',nroantecedentes);
                                FechaVencimiento=getBusinessDatesSum(FechaIngresoTD,diasD);
                                //tiempó
                                CadenaFecha=cadenaDate(FechaVencimiento);
                                var tdVencI=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}VV').innerHTML=listaFecha(FechaVencimiento);
                                var tdVenc=document.getElementById('{{$Ingreso->CONT_varHojaTramite}}V').innerHTML=CadenaFecha;

                                $('#{{$Ingreso->CONT_varHojaTramite}}A').on('click',function(e){
                                    var DniAbogado=$("#{{$Ingreso->CONT_varHojaTramite}}ABG").val();
                                    var Route="abogado/{{$Ingreso->CONT_varHojaTramite}}/";
                                    var DD=DniAbogado;
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