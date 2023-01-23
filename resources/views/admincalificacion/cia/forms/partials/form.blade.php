@if (Session::has('message'))
    <div class="text-danger">
        {{Session::get('message')}}
    </div>
@endif
@if (Session::has('status'))
    <div class="text-danger">
        {{Session::get('status')}}
    </div>
@endif


<div class="row">
    <div class="col-xs-12 col-md-3">
        <div class="form-group">
            {{ Form::label('CONT_varTipo', 'Tipo', ['class' => 'label_form']) }}
            {{ Form::select('CONT_varTipo', array('PEA' => 'PEA','Levantamiento Obs. PEA' =>'Levantamiento Obs. PEA','Reingreso PEA' =>'Reingreso PEA','Otros' =>'Otros'),isset($cir_control)?$cir_control->CONT_varTipo:'PEA',['class' => 'form-control','id'=>'selectTipo']) }}
            @if($errors->has('CONT_varTipo'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('CONT_varTipo')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="form-group">
            {{ Form::label('CONT_varHojaTramite', 'Hoja de Ruta', ['class' => 'label_form']) }}
            {{ Form::number('CONT_varHojaTramite', isset($cia)?$cia->CONT_varHojaTramite:'', array('class' => 'form-control')) }}
            @if($errors->has('CONT_varHojaTramite'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('CONT_varHojaTramite')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="form-group">
            {{ Form::label('CONT_datFechaRecepcionTD', 'Fecha de Ingreso en TD', ['class' => 'label_form']) }}
            {{ Form::date('CONT_datFechaRecepcionTD', isset($cia)?$cia->CONT_datFechaRecepcionTD:\Carbon\Carbon::now(), array('class' => 'form-control','max'=>'24-10-2017')) }}

            @if($errors->has('CONT_datFechaRecepcionTD'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('CONT_datFechaRecepcionTD')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="form-group">
            {{ Form::label('CONT_datFechaIngresoCCIA', 'Fecha de Ingreso en Certificaciones', ['class' => 'label_form']) }}
            {{ Form::date('CONT_datFechaIngresoCCIA', isset($cia)?$cia->CONT_datFechaIngresoCCIA:\Carbon\Carbon::now(), array('class' => 'form-control','readonly')) }}

            @if($errors->has('CONT_datFechaIngresoCCIA'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('CONT_datFechaIngresoCCIA')}}</div>
            @endif
        </div>
    </div>
    
</div>
<div class="form-group">
    
    {{ Form::label('CONT_varNombreProyecto', 'Nombre del Proyecto') }}
    {{ Form::text('CONT_varNombreProyecto', isset($cia)?$cia->CONT_varNombreProyecto:'', ['class' => 'form-control']) }}
    @if($errors->has('CONT_varNombreProyecto'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('CONT_varNombreProyecto')}}</div>
    @endif
    

</div>


<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('CONT_varAdministradorEmpresa', 'Administrador / Remitente', ['class' => 'label_form']) }}
            {{ Form::text('CONT_varAdministradorEmpresa', isset($cia)?$cia->CONT_varAdministradorEmpresa:'', array('class' => 'form-control')) }}
            @if($errors->has('CONT_varAdministradorEmpresa'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('CONT_varAdministradorEmpresa')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('CONT_varAntecedente', 'Antecedente (Si existe)', ['class' => 'label_form']) }}
            {{ Form::select('CONT_varAntecedente', array('Ninguno' => 'Ninguno'),isset($cir_control)?$cir_control->CONT_varAntecedente:'Ninguno',['class' => 'form-control','id'=>'selectAntecedente']) }}
            @if($errors->has('CONT_varAntecedente'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('CONT_varAntecedente')}}</div>
            @endif
        </div>
    </div>            
</div>
<!--14 nov-->
<script type="text/javascript">
    $(document).ready(function(){
            var HR="";
            var HRcambio=false;
            $('#CONT_varHojaTramite').on('focusout',function(e){
                HR=$('#CONT_varHojaTramite').val();
            });
            
            $('#selectTipo').on('change',function(e){
                
                var TipoCC=e.target.value;
                HR=$('#CONT_varHojaTramite').val();
                if (TipoCC=='PEA' || TipoCC=='Otros') {
                    $('#selectAntecedente').empty();
                    $('#selectAntecedente').append(
                            '<option value="Ninguno">Ninguno</option>');
                }                
                
                if (HR.length==9) {
                    //Realizar Acción
                    if(TipoCC=='Levantamiento Obs. PEA' || TipoCC=='Reingreso PEA'){
                        //listar antecedentes PMAs
                        $('#selectAntecedente').empty();
                        $.get('/admincalificacion/cias?cia='+HR,function (data){
                            if(data.length>0){
                            data.forEach(function(element,index){
                                //ArrPmas.push(element.CONT_varHojaTramite);
                                $('#selectAntecedente').append(
                            '<option value="'+ element.CONT_varHojaTramite+' "> '+element.CONT_varHojaTramite+'</option>');                                    
                            })}
                            else{
                                $('#selectAntecedente').append(
                            '<option value="Ninguno"> Ninguno </option>')
                            }
                        });

                    }
                    
                }
            });
            $('#CONT_datFechaRecepcionTD').focusout(function(e){
                var day = new Date( e.target.value ).getUTCDay();
                var daten= new Date(e.target.value);
                if (day==0 || day==6) {
                    
                    if (day==0) {
                        alert('La fecha seleccionada es un DOMINGO, seleccione un dia habil de la semana');
                    }
                    else{
                        alert('La fecha seleccionada es un SABADO, seleccione un dia habil de la semana');             
                    }; 
                    document.getElementById("CONT_datFechaRecepcionTD").value='today';
                }
            });

    });
    
</script>