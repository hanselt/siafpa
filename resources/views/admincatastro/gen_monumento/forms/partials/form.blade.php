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
        <div class="form-inline" id="UbigeoDes">
            {{ Form::label('UBIG_varID', 'Ubicacion Geografica', ['class' => 'label_form']) }}
            <br>
            <select id="Selectdepartamento" name="Selectdepartamento" style="width: 149px; height:34px"  class="form-control">
                @if(isset($depubigeos))
                 @foreach($depubigeos as $depubigeo)
                    @if(isset($monumento))
                            @if($monumento->Departamento==$depubigeo->UBIG_varNombre)
                                <option value="{{$depubigeo->UBIG_varId}}" selected="">{{$depubigeo->UBIG_varNombre}}</option>
                            @else
                                <option value="{{$depubigeo->UBIG_varId}}">{{$depubigeo->UBIG_varNombre}}</option>
                            @endif
                    @else
                        <option value='{{$depubigeo->UBIG_varId}}'>{{$depubigeo->UBIG_varNombre}}</option>
                    @endif
                @endforeach
               @endif
            </select>
            <select id="Selectprovincia" name="Selectprovincia" style="width: 149px; height:34px"  class="form-control">
                @if(isset($monumento))
                        <option value="{{$monumento->ProvinciaId}}" selected="">{{$monumento->Provincia}}</option>
                @endif
            </select>
            <select id="UBIG_varID" name="UBIG_varID" style="width: 149px; height:34px"  class="form-control">
                @if(isset($monumento))
                        <option value="{{$monumento->DistritoId}}" selected="">{{$monumento->Distrito}}</option>
                @endif
            </select>
            @if($errors->has('UBIG_varID'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('UBIG_varID')}}</div>
            @endif
        </div>
    </div>
    </div>


    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('COOR_intId', 'Coordinacion', ['class' => 'label_form']) }}
            <select id="COOR_intId" name="COOR_intId" class="form-control">
                @if(isset($coordinaciones))
                    @foreach($coordinaciones as $coordinacion)
                        @if(isset($monumento))
                            @if($monumento->COOR_intId==$coordinacion->COOR_intId)
                                <option value="{{$coordinacion->COOR_intId}}" selected="">{{$coordinacion->COOR_varNombre}}</option>
                            @else
                                <option value="{{$coordinacion->COOR_intId}}">{{$coordinacion->COOR_varNombre}}</option>
                            @endif
                        @else
                            <option value="{{$coordinacion->COOR_intId}}">{{$coordinacion->COOR_varNombre}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
            @if($errors->has('COOR_intId'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('COOR_intId')}}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('MONU_varTipo', 'Tipo', ['class' => 'label_form']) }}
            <select id="MONU_varTipo" name="MONU_varTipo" class="form-control">
                @if(isset($monumento))
                    @if($monumento->MONU_varTipo=='Monumento Arqueológico Prehispánico')
                    <option value="Monumento Arqueológico Prehispánico" selected="">Monumento Arqueológico Prehispánico</option>
                    <option value="Monumento Historico Virreinal y Republicano">Monumento Historico Virreinal y Republicano</option>
                    @else
                    <option value="Monumento Arqueológico Prehispánico">Monumento Arqueológico Prehispánico</option>
                    <option value="Monumento Historico Virreinal y Republicano" selected="">Monumento Historico Virreinal y Republicano</option>
                    @endif
                @else
                    <option value="Monumento Arqueológico Prehispánico">Monumento Arqueológico Prehispánico</option>
                    <option value="Monumento Historico Virreinal y Republicano">Monumento Historico Virreinal y Republicano</option>
                @endif
            </select>
            @if($errors->has('MONU_varTipo'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varTipo')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('MONU_varEstado', 'Estado', ['class' => 'label_form']) }}
            <select id="MONU_varEstado" name="MONU_varEstado" class="form-control">
            @if(isset($monumento))
                @if($monumento->MONU_varEstado=='Identificado')
                <option value="Identificado" selected="">Identificado</option>
                <option value="Registrado">Registrado</option>
                <option value="Saneado">Saneado</option>
                @else
                    @if($monumento->MONU_varEstado=='Registrado')
                        <option value="Identificado">Identificado</option>
                        <option value="Registrado" selected="">Registrado</option>
                        <option value="Saneado">Saneado</option>
                    @else
                        <option value="Identificado">Identificado</option>
                        <option value="Registrado">Registrado</option>
                        <option value="Saneado" selected="">Saneado</option>
                    @endif
                @endif
            @else
                <option value="Identificado">Identificado</option>
                <option value="Registrado">Registrado</option>
                <option value="Saneado">Saneado</option>
            @endif
            </select>
            @if($errors->has('MONU_varEstado'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varEstado')}}</div>
            @endif
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('MONU_varCategoria', 'Categoria', ['class' => 'label_form']) }}
            <select id="MONU_varCategoria" name="MONU_varCategoria" class="form-control">
            @if(isset($monumento))
                <option value="{{$monumento->MONU_varCategoria}}">{{$monumento->MONU_varCategoria}}</option>
            @else
                <option value="Sitio Arqueológico">Sitio Arqueológico</option>
                <option value="Sector Arqueológico">Sector Arqueológico</option>
                <option value="Elemento Arqueológico Aislado">Elemento Arqueológico Aislado</option>
                <option value="Paisaje Arqueológico">Paisaje Arqueológico</option>
                <option value="Paisaje Cultural Arqueológico">Paisaje Cultural Arqueológico</option>
                <option value="Parque Arqueológico">Parque Arqueológico</option>
                <option value="Santuario Histórico">Santuario Histórico</option>                
                <option value="Sitio Etnoarqueológico">Sitio Etnoarqueológico</option>
                <option value="Sitio Paleontológico">Sitio Paleontológico</option>
                <option value="Zona Arqueológica Monumental">Zona Arqueológica Monumental</option>
                <option value="Zona Arqueológica">Zona Arqueológica</option>
                <option value="Zona de Reserva Arqueológica">Zona de Reserva Arqueológica</option>                                
            @endif   
            </select>
            @if($errors->has('MONU_varCategoria'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varCategoria')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('MONU_varNombre', 'Nombre', ['class' => 'label_form']) }}
            {{ Form::text('MONU_varNombre', isset($monumento)?$monumento->MONU_varNombre:'', array('class' => 'form-control')) }}
            @if($errors->has('MONU_varNombre'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varNombre')}}</div>
            @endif
        </div>
    </div>
    
</div>

<div class="row" id="calculo">
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('MONU_varUTMX', 'Coordenada UTM X', ['class' => 'label_form']) }}
            {{ Form::number('MONU_varUTMX', 0, array('class' => 'form-control','step'=>'any')) }}
            @if($errors->has('MONU_varUTMX'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varUTMX')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('MONU_varUTMY', 'Coordenada UTM Y', ['class' => 'label_form']) }}
            {{ Form::number('MONU_varUTMY', 0, array('class' => 'form-control','step'=>'any')) }}
            @if($errors->has('MONU_varUTMY'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varUTMY')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('Zona', 'Zona Geografica', ['class' => 'label_form']) }}
            {{ Form::number('Zona', 0, array('class' => 'form-control','min'=>1,'max'=>60)) }}
            @if(isset($monumento))
                <script type="text/javascript">
                    var xy = new Array(2);
                    zone = Math.floor (({{$monumento->MONU_douCoordenadaLongitud}} + 180.0) / 6) + 1
                    zone = LatLonToUTMXY (DegToRad ({{$monumento->MONU_douCoordenadaLatitud}}), DegToRad ({{$monumento->MONU_douCoordenadaLongitud}}), zone, xy);
                    document.getElementById("MONU_varUTMX").value=xy[0];
                    document.getElementById("MONU_varUTMY").value=xy[1];
                    document.getElementById("Zona").value=zone;
                </script>
            @endif
            @if($errors->has('Zona'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('Zona')}}</div>
            @endif
            
        </div>

    </div>
    
    
    {{ Form::hidden('MONU_varDU',isset($monumento)?$monumento->MONU_varDU:'',array('id'=>'MONU_varDU')) }}
</div>
<div class="row">
    <div class="col-xs-12 col-md-6">
    {{ Form::label('MONU_douCoordenadaLatitud', 'Latitud', ['class' => 'label_form']) }}
    {{ Form::text('MONU_douCoordenadaLatitud',isset($monumento)?$monumento->MONU_douCoordenadaLatitud:'',array('id'=>'MONU_douCoordenadaLatitud','readonly','class' => 'form-control')) }}
    @if($errors->has('MONU_douCoordenadaLatitud'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_douCoordenadaLatitud')}}</div>
    @endif
    </div>
    <div class="col-xs-12 col-md-6">
    {{ Form::label('MONU_douCoordenadaLongitud', 'Longitud', ['class' => 'label_form']) }}
    {{ Form::text('MONU_douCoordenadaLongitud',isset($monumento)?$monumento->MONU_douCoordenadaLongitud:'',array('id'=>'MONU_douCoordenadaLongitud','readonly','class' => 'form-control')) }}
    @if($errors->has('MONU_douCoordenadaLongitud'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_douCoordenadaLongitud')}}</div>
    @endif
    </div>
</div>




@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            var MAP = new Array("Sitio Arqueológico","Elemento Arqueológico Aislado","Paisaje Arqueológico","Paisaje Cultural Arqueológico","Parque Arqueológico","Santuario Histórico",'Sector Arqueológico',"Sitio Paleontológico","Sitio Etnoarqueológico","Zona Arqueológica Monumental","Zona Arqueológica","Zona de Reserva Arqueológica");            
            var MHV = new Array("Ambiente Monumental","Ambiente Urbano Monumental","Arquitectura Civil Domestica","Arquitectura Civil Pública","Arquitectura Industrial","Arquitectura Religiosa","Centro Histórico","Zona Histórica Monumental","Zona Monumental");
            
            $('#Selectdepartamento').on('change',function(e){
                // actualizar lista de cuentas presupuestales
                var dep= e.target.value;
                $('#Selectprovincia').empty();
                $('#UBIG_varID').empty();
                //$('#provincia').append('<option value="ninguno">'+dep+'</option>');


                $.get('/admincatastro/prov?departamento='+dep,function (data){
                    data.forEach(function(element,index){
                        $('#Selectprovincia').append(
                                '<option value="'+ element.UBIG_varId+' "> '+element.UBIG_varNombre+'</option>');
                    });

                });

            });

            //sdasd
            $('#MONU_varTipo').on('change',function(e){
                // actualizar lista de cuentas presupuestales
                var TipoS= e.target.value;
                $('#MONU_varCategoria').empty();
                //$('#provincia').append('<option value="ninguno">'+dep+'</option>');

                var CategoriaSelect = document.getElementById('MONU_varCategoria');
                if (TipoS=="Monumento Arqueológico Prehispánico") {
                    for(var i = 0; i < MAP.length; i++){
                        CategoriaSelect.options.add(new Option(MAP[i], MAP[i]));
                    }  
                }
                else
                {
                    for(var i = 0; i < MHV.length; i++){
                        CategoriaSelect.options.add(new Option(MHV[i], MHV[i]));
                    }                      
                }
            });
            $('#UbigeoDes').on('focusout',function(e){
                // actualizar lista de cuentas presupuestales
                var Dep=$('#Selectdepartamento :selected').text();
                var Dis=$('#UBIG_varID :selected').text();
                var Prov=$('#Selectprovincia :selected').text();
                //$('#provincia').append('<option value="ninguno">'+dep+'</option>');MONU_varDU;UbigeoDes

                document.getElementById('MONU_varDU').value=Dep+' -'+Prov+' -'+Dis;
                

            });
            //asda
            $('#Selectprovincia').on('change',function(e){
                // actualizar lista de cuentas presupuestales
                var provi= e.target.value;
                $('#UBIG_varID').empty();
                //$('#provincia').append('<option value="ninguno">'+dep+'</option>');


                $.get('/admincatastro/dist?provincia='+provi,function (data){
                    data.forEach(function(element,index){
                        $('#UBIG_varID').append(
                                '<option value="'+ element.UBIG_varId+' "> '+element.UBIG_varNombre+'</option>');
                    });

                });

            });
            $('#calculo').on('focusout',function(e){
                latlon = new Array(2);
                var x, y, zone, southhemi;
                x=$('#MONU_varUTMX').val();
                y=$('#MONU_varUTMY').val();
                zone=$('#Zona').val();
                southhemi=true;

                UTMXYToLatLon (x, y, zone, southhemi, latlon);

                document.getElementById("MONU_douCoordenadaLongitud").value=RadToDeg (latlon[1])
                document.getElementById("MONU_douCoordenadaLatitud").value=RadToDeg (latlon[0]);
            });

        });
    </script>
@endsection