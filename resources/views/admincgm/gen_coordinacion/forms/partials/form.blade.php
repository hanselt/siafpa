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

    
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('UBIG_varID', 'Ubicación Geográfica', ['class' => 'label_form']) }}
            <br>            
            <select id="Selectdepartamento" name="Selectdepartamento" style="width: 149px; height:34px">
                @foreach($depubigeos as $depubigeo)
                    @if(isset($Aubigeos))
                        @foreach($Aubigeos as $Aubigeo)
                            @if($Aubigeo->Departamento==$depubigeo->UBIG_varNombre)
                                <option value="{{$depubigeo->UBIG_varId}}" selected="">{{$depubigeo->UBIG_varNombre}}</option>
                            @else
                                <option value="{{$depubigeo->UBIG_varId}}">{{$depubigeo->UBIG_varNombre}}</option>
                            @endif   
                        @endforeach
                    @else
                        <option value="{{$depubigeo->UBIG_varId}}">{{$depubigeo->UBIG_varNombre}}</option>
                    @endif
                @endforeach
            </select>    
            <select id="Selectprovincia" name="Selectprovincia" style="width: 149px; height:34px">
                @if(isset($Aubigeos))
                        @foreach($Aubigeos as $Aubigeo)
                                <option value="{{$Aubigeo->ProvinciaId}}" selected="">{{$Aubigeo->Provincia}}</option>
                        @endforeach
                @endif                   
            </select>
            <select id="UBIG_varID" name="UBIG_varID" style="width: 149px; height:34px">
                @if(isset($Aubigeos))
                        @foreach($Aubigeos as $Aubigeo)
                                <option value="{{$Aubigeo->DistritoId}}" selected="">{{$Aubigeo->Distrito}}</option>
                        @endforeach
                @endif                            
            </select>
            @if($errors->has('UBIG_varID'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('UBIG_varID')}}</div>
            @endif
        </div>
    </div>


    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('PERS_varDNI', 'Encargado de la coordinación', ['class' => 'label_form']) }}

            <select class="form-control" id="PERS_varDNI" name="PERS_varDNI">                            
                            @foreach($personas as $persona)
                                @if(isset($Apersonas))
                                    
                                        @if($Apersonas->PERS_varDNI==$persona->PERS_varDNI)
                                        <option value="{{$persona->PERS_varDNI}}" selected="">{{$persona->PERS_varApPaterno}} {{$persona->PERS_varApMaterno}}, {{$persona->PERS_varNombres}}</option>
                                        @else
                                        <option value="{{$persona->PERS_varDNI}}">{{$persona->PERS_varApPaterno}} {{$persona->PERS_varApMaterno}}, {{$persona->PERS_varNombres}}</option>
                                        @endif
                                    
                                @else
                                <option value="{{$persona->PERS_varDNI}}">{{$persona->PERS_varApPaterno}} {{$persona->PERS_varApMaterno}}, {{$persona->PERS_varNombres}}</option>
                                @endif
                            @endforeach
            </select> 
            @if($errors->has('PERS_varDNI'))
            <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('PERS_varDNI')}}
            </div>
            @endif            
        </div>
    </div>
</div>

<div class="form-group">
        {{ Form::label('COOR_varNombre', 'Nombre de la Coordinación', ['class' => 'label_form']) }}
        {{ Form::text('COOR_varNombre', isset($coordinacion)?$coordinacion->COOR_varNombre:'', array('class' => 'form-control')) }}
        @if($errors->has('COOR_varNombre'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('COOR_varNombre')}}
        </div>
        @endif
</div>
<div class="form-group">
    {{ Form::label('COOR_varResenaHistorica', 'Reseña Histórica') }}
    {{ Form::textarea('COOR_varResenaHistorica', isset($coordinacion)?$coordinacion->COOR_varResenaHistorica:'', ['class' => 'form-control']) }}
    @if($errors->has('COOR_varResenaHistorica'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('COOR_varResenaHistorica')}}</div>
    @endif
</div>



<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('COOR_datFechaCreacion', 'Fecha de Creación', ['class' => 'label_form']) }}
            {{ Form::date('COOR_datFechaCreacion', isset($coordinacion)?$coordinacion->COOR_datFechaCreacion:'', array('class' => 'form-control')) }}
            @if($errors->has('COOR_datFechaCreacion'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('COOR_datFechaCreacion')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('COOR_varDireccion', 'Dirección de Sede', ['class' => 'label_form']) }}
            {{ Form::text('COOR_varDireccion', isset($coordinacion)?$coordinacion->COOR_varDireccion:'', array('class' => 'form-control')) }}
            @if($errors->has('COOR_varDireccion'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('COOR_varDireccion')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('COOR_varHorarioAtencion', 'Horario de Atención', ['class' => 'label_form']) }}
            {{ Form::text('COOR_varHorarioAtencion', isset($coordinacion)?$coordinacion->COOR_varHorarioAtencion:'', array('class' => 'form-control')) }}
            @if($errors->has('COOR_varHorarioAtencion'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('COOR_varHorarioAtencion')}}</div>
            @endif
        </div>
    </div>
</div>




<div class="row" id="calculo">
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('COOR_varUTMX', 'Coordenada UTM X (Este)', ['class' => 'label_form']) }}
            {{ Form::number('COOR_varUTMX', isset($coordinacion)?$coordinacion->COOR_varUTMX:'', array('class' => 'form-control','step'=>'any')) }}
            @if($errors->has('COOR_varUTMX'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('COOR_varUTMX')}}</div>
            @endif
            
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('COOR_varUTMY', 'Coordenada UTM Y (Norte)', ['class' => 'label_form']) }}
            {{ Form::number('COOR_varUTMY', isset($coordinacion)?$coordinacion->COOR_varUTMY:'', array('class' => 'form-control','step'=>'any')) }}            
            @if($errors->has('COOR_varUTMY'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('COOR_varUTMY')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('Zona', 'Zona Geográfica', ['class' => 'label_form']) }}
            {{ Form::number('Zona', isset($coordinacion)?$coordinacion->Zona:'', array('class' => 'form-control')) }}
            @if(isset($coordinacion))
                <script type="text/javascript">
                    var xy = new Array(2);
                    zone = Math.floor (({{ $coordinacion->COOR_varCoordenadaLongitud }} + 180.0) / 6) + 1
                    zone = LatLonToUTMXY (DegToRad ({{ $coordinacion->COOR_varCoordenadaLatitud }}), DegToRad ({{ $coordinacion->COOR_varCoordenadaLongitud }}), zone, xy);
                    document.getElementById("COOR_varUTMX").value=xy[0];
                    document.getElementById("COOR_varUTMY").value=xy[1];
                    document.getElementById("Zona").value=zone;
                </script>
            @endif
            @if($errors->has('Zona'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('Zona')}}</div>
            @endif
        </div>
    </div>    
            {{ Form::hidden('CoordenadaLatitud',isset($coordinacion)?$coordinacion->COOR_varCoordenadaLatitud:'',array('id'=>'CoordenadaLatitud')) }}
            {{ Form::hidden('CoordenadaLongitud',isset($coordinacion)?$coordinacion->COOR_varCoordenadaLongitud:'',array('id'=>'CoordenadaLongitud')) }}        
    
      
</div>




@section('scripts')
<script type="text/javascript">
$( document ).ready(function() {    
    $('#Selectdepartamento').on('change',function(e){
        // actualizar lista de cuentas presupuestales
        var dep= e.target.value;
        $('#Selectprovincia').empty();
        $('#UBIG_varID').empty();
        //$('#provincia').append('<option value="ninguno">'+dep+'</option>');


        $.get('/admincgm/prov?departamento='+dep,function (data){
            data.forEach(function(element,index){
                $('#Selectprovincia').append(
                      '<option value="'+ element.UBIG_varId+' "> '+element.UBIG_varNombre+'</option>');
            });            
            
        });        

    });


    $('#Selectprovincia').on('change',function(e){
        // actualizar lista de cuentas presupuestales
        var provi= e.target.value;
        $('#UBIG_varID').empty();
        //$('#provincia').append('<option value="ninguno">'+dep+'</option>');


        $.get('/admincgm/dist?provincia='+provi,function (data){
            data.forEach(function(element,index){
                $('#UBIG_varID').append(
                      '<option value="'+ element.UBIG_varId+' "> '+element.UBIG_varNombre+'</option>');
            });            
            
        });        

    });
    $('#calculo').on('focusout',function(e){
                    latlon = new Array(2);
                    var x, y, zone, southhemi;
                    x=$('#COOR_varUTMX').val();
                    y=$('#COOR_varUTMY').val();
                    zone=$('#Zona').val();
                    southhemi=true;
                            
                    UTMXYToLatLon (x, y, zone, southhemi, latlon);                              
                      
                    document.getElementById("CoordenadaLongitud").value=RadToDeg (latlon[1])
                    document.getElementById("CoordenadaLatitud").value=RadToDeg (latlon[0]);
                    });

});
</script>
@endsection