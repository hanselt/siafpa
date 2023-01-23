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
            {{ Form::label('MONU_intId', 'Monumentos', ['class' => 'label_form']) }}                   
            <select class="form-control" id="MONU_intId" name="MONU_intId">
                @if(isset($monumentos))
                    @foreach($monumentos as $monumento)
                        @if(isset($atrimestral))
                            @foreach($atrimestral as $Aubigeo)
                                @if($atrimestral->MONU_intId==$monumento->MONU_intId)
                                    <option value="{{$monumento->MONU_intId}}" selected="">{{$monumento->MONU_varCategoria}}, {{$monumento->MONU_varNombre}}</option>
                                @else
                                    <option value="{{$monumento->MONU_intId}}">{{$monumento->MONU_varCategoria}}, {{$monumento->MONU_varNombre}}</option>
                                @endif   
                            @endforeach
                        @else
                            <option value="{{$monumento->MONU_intId}}">{{$monumento->MONU_varCategoria}}, {{$monumento->MONU_varNombre}}</option>
                        @endif
                    @endforeach
                @endif
                @if(isset($monumentotri))
                    <option value="{{$monumentotri->MONU_intId}}">{{$monumentotri->MONU_varCategoria}}, {{$monumentotri->MONU_varNombre}}</option>
                @endif
            </select>
            @if($errors->has('MONU_intId'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_intId')}}</div>
            @endif
            
        </div>
    </div>


    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('ACCI_intId', 'Acción', ['class' => 'label_form']) }}
            @if(isset($accion))
            <select name="ACCI_intId" id="ACCI_intId" class="form-control" value="{{$accion->ACCI_intId}}">
                
                <option value="{{$accion->ACCI_intId}}" selected="">{{$accion->ACCI_varDescripcion}}</option>
                
            </select>
            @endif
            @if($errors->has('ACCI_intId'))
            <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                   aria-hidden="true"></i> {{$errors->first('ACCI_intId')}}
            </div>
            @endif                  
            </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('ATRI_intTrimestre', 'Trimestre', ['class' => 'label_form']) }}
            {{ Form::number('ATRI_intTrimestre', isset($atrimestral)?$atrimestral->ATRI_intTrimestre:'', array('class' => 'form-control','min'=>1,'max'=>4)) }}
            @if($errors->has('ATRI_intTrimestre'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('ATRI_intTrimestre')}}</div>
            @endif
            @if(Session::has('msg'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{Session::get('msg')}}</div>
                
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('ATRI_douDimension', isset($accion)?('Dimensión: '.$accion->ACCI_varUnidadMedida):'(metrado, cantidades, etc)', ['class' => 'label_form']) }}
            {{ Form::number('ATRI_douDimension', isset($atrimestral)?$atrimestral->ATRI_douDimension:'', array('class' => 'form-control','min'=> 0.01,'step'=>0.01)) }}
            @if($errors->has('ATRI_douDimension'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('ATRI_douDimension')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            {{ Form::label('ATRI_douCostoUnitario', 'Costo Unitario', ['class' => 'label_form']) }}
            {{ Form::number('ATRI_douCostoUnitario', isset($atrimestral)?$atrimestral->ATRI_douCostoUnitario:'', array('class' => 'form-control','min'=> 0.01,'step'=>0.01)) }}
            @if($errors->has('ATRI_douCostoUnitario'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('ATRI_douCostoUnitario')}}</div>
            @endif
        </div>
    </div>
</div>
<div class="row">

    
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('ATRI_varPlanes', 'Planes', ['class' => 'label_form']) }}                   
            {{ Form::text('ATRI_varPlanes', isset($atrimestral)?$atrimestral->ATRI_varPlanes:'', array('class' => 'form-control')) }}
            @if($errors->has('ATRI_varPlanes'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('ATRI_varPlanes')}}</div>
            @endif
            
        </div>
    </div>


    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('ATRI_intEjecucionPresupuestal', 'Ejecución Presupuestal %', ['class' => 'label_form']) }}
            {{ Form::number('ATRI_intEjecucionPresupuestal', isset($atrimestral)?$atrimestral->ATRI_intEjecucionPresupuestal:'', array('class' => 'form-control','min'=> 1,'max'=>100,'step'=>0.01)) }}
            
            @if($errors->has('ATRI_intEjecucionPresupuestal'))
            <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                   aria-hidden="true"></i> {{$errors->first('ATRI_intEjecucionPresupuestal')}}
            </div>
            @endif
                        
            </div>
    </div>

</div>

