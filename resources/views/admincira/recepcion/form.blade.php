<br>
@if(isset($Expediente))
<div class="row col-sm-8 col-xs-12 center-margin">
        
        <div class="col-xs-12 col-md-12">
            
            <div class="panel panel-info" style="border-color: #416b90">
            <div class="panel-heading" style="background-color: #416b90">
              <h3 class="panel-title" style="color: white"><center>{{ $Expediente->CONT_varTipo }}</center></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="/img/enviado.png" class="img-circle img-responsive"> 
                <br>
                <strong><p id="FechaVencimientoParrafo" style="color: #416b90"></p></strong>
                </div>

               
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Hoja de Ruta</td>

                        <td>{{ $Expediente->CONT_varHojaTramite }}</td>
                      </tr>
                      <tr>
                        <td width="20%">Proyecto</td>
                        <td width="80%"><a>{{ $Expediente->CONT_varNombreProyecto }}</a></td>
                      </tr>
                      <tr>
                        <td>Estado</td>
                        <td>{{ $Expediente->CONT_varEstado }}</td>
                      </tr>
                      <tr>
                        <td>Calificador</td>
                        <td>{{ $Calificador->PERS_varNombres }} {{ $Calificador->PERS_varApPaterno }} {{ $Calificador->PERS_varApMaterno }}</td>
                      </tr>
                      <tr>
                        <td>Abogado</td>
                        <td>{{ $Abogado->PERS_varNombres }} {{ $Abogado->PERS_varApPaterno }} {{ $Abogado->PERS_varApMaterno }}</td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                 
            
          </div>
        </div>

</div>
<script type="text/javascript">
    var FechaIngresoTD=new Date("{{$Expediente->CONT_datFechaIngresoTD}}");
    var FechaVencimiento=new Date();
    var nroantecedentes='{{$Expediente->CONT_intDiasTramite}}';
    var diasD=diasVencimiento('{{$Expediente->CONT_varTipo}}',nroantecedentes);
    FechaVencimiento=getBusinessDatesSum(FechaIngresoTD,diasD);
    var CadenaFechaV=cadenaDate(FechaVencimiento);

    var tdVenc=document.getElementById('FechaVencimientoParrafo').innerHTML='Vence: '+CadenaFechaV;
</script>
@endif
<!--LA HOJA DE RUTA ESTA INICIADA-->
@if(isset($Iniciado))
<div class="row col-sm-8 col-xs-12 center-margin">
        
        <div class="col-xs-12 col-md-12">
            
            <div class="panel panel-info" style="border-color: #cf4436">
            <div class="panel-heading" style="background-color: #cf4436">
              <h3 class="panel-title" style="color: white"><center>{{ $Mensaje }}</center></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="/img/noenviado.png" class="img-circle img-responsive"> 
                <br>
                <strong><p id="FechaVencimientoParrafo" style="color: #cf4436"></p></strong>
                </div>

               
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Hoja de Ruta</td>

                        <td>{{ $Iniciado->CONT_varHojaTramite }}</td>
                      </tr>
                      <tr>
                        <td width="20%">Proyecto</td>
                        <td width="80%"><a>{{ $Iniciado->CONT_varNombreProyecto }}</a></td>
                      </tr>
                      <tr>
                        <td>Estado</td>
                        <td>{{ $Iniciado->CONT_varEstado }}</td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                 
            
          </div>
        </div>

</div>
<script type="text/javascript">
    var FechaIngresoTD=new Date("{{$Iniciado->CONT_datFechaIngresoTD}}");
    var nroantecedentes='{{$Iniciado->CONT_intDiasTramite}}';
    var diasD=diasVencimiento('{{$Iniciado->CONT_varTipo}}',nroantecedentes);
    FechaVencimiento=getBusinessDatesSum(FechaIngresoTD,diasD);
    var CadenaFechaV=cadenaDate(FechaVencimiento);

    var tdVenc=document.getElementById('FechaVencimientoParrafo').innerHTML='Vence: '+CadenaFechaV;
</script>
@endif
<!--LA HOJA DE RUTA NO EXISTE-->
@if(isset($Error))
<div class="row col-sm-8 col-xs-12 center-margin">
        
        <div class="col-xs-12 col-md-12">
            
            <div class="panel panel-info" style="border-color: #cf4436">
            <div class="panel-heading" style="background-color: #cf4436">
              <h3 class="panel-title" style="color: white"><center>NO EXISTE</center></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="/img/noenviado.png" class="img-circle img-responsive" style="width: 50%"> 
                <br>
                <strong><p id="FechaVencimientoParrafo" style="color: #cf4436"></p></strong>
                </div>

               
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Hoja de Ruta</td>

                        <td>{{$Error}}</td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
                 
            
          </div>
        </div>

</div>
@endif