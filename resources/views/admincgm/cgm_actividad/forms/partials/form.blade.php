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
            {{ Form::label('Anio', 'Año', ['class' => 'label_form']) }}
            <br>            
            {{ Form::number('ACTI_intYear', isset($actividad)?$actividad->ACTI_intYear:'', array('class' => 'form-control','step'=>'any')) }}
            @if($errors->has('ACTI_intYear'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('ACTI_intYear')}}</div>
            @endif
            
        </div>
    </div>


    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('ACTI_varUnidadMedida', 'Unidad de Medida', ['class' => 'label_form']) }}
            {{ Form::text('ACTI_varUnidadMedida', isset($actividad)?$actividad->ACTI_varUnidadMedida:'', array('class' => 'form-control')) }}
            @if($errors->has('ACTI_varUnidadMedida'))
            <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                   aria-hidden="true"></i> {{$errors->first('ACTI_varUnidadMedida')}}
            </div>
            @endif
                        
            </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('ACTI_varDescripcion', 'Descripción') }}
    {{ Form::textarea('ACTI_varDescripcion', isset($actividad)?$actividad->ACTI_varDescripcion:'', ['class' => 'form-control']) }}
    @if($errors->has('ACTI_varDescripcion'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('ACTI_varDescripcion')}}</div>
    @endif
</div>      
            
    
      




