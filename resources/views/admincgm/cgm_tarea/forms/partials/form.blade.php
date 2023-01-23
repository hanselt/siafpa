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
            {{ Form::label('ACTI_intId', 'Actividad', ['class' => 'label_form']) }}
            <br>            
            <select id="ACTI_intId" name="ACTI_intId" class="form-control">
                @foreach($actividades as $actividad)
                    @if(isset($tarea))
                        @if($tarea->ACTI_intId==$actividad->ACTI_intId)
                        <option value="{{$actividad->ACTI_intId}}" selected="">{{$actividad->ACTI_intId}}: {{$actividad->ACTI_varDescripcion}}</option>
                        @else
                        <option value="{{$actividad->ACTI_intId}}">{{$actividad->ACTI_intId}}: {{$actividad->ACTI_varDescripcion}}</option>
                        @endif
                    @else                    
                        <option value="{{$actividad->ACTI_intId}}">{{$actividad->ACTI_intId}}: {{$actividad->ACTI_varDescripcion}}</option>
                    @endif
                @endforeach                
            </select>
            @if($errors->has('ACTI_intId'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('ACTI_intId')}}</div>
            @endif
            
        </div>
    </div>


    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('TARE_varUnidadMedida', 'Unidad de Medida', ['class' => 'label_form']) }}
            {{ Form::text('TARE_varUnidadMedida', isset($tarea)?$tarea->TARE_varUnidadMedida:'', array('class' => 'form-control')) }}
            @if($errors->has('TARE_varUnidadMedida'))
            <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                   aria-hidden="true"></i> {{$errors->first('TARE_varUnidadMedida')}}
            </div>
            @endif
                        
            </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('TARE_varDescripcion', 'Descripción') }}
    {{ Form::textarea('TARE_varDescripcion', isset($tarea)?$tarea->TARE_varDescripcion:'', ['class' => 'form-control']) }}
    @if($errors->has('TARE_varDescripcion'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('TARE_varDescripcion')}}</div>
    @endif
</div>      
            
    
      




