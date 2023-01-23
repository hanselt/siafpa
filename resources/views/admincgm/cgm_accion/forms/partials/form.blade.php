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
            {{ Form::label('TARE_intId', 'Tarea', ['class' => 'label_form']) }}
            <br>            
            <select id="TARE_intId" name="TARE_intId" class="form-control">
                @foreach($tareas as $tarea)
                    @if(isset($accion))
                        @if($accion->TARE_intId==$tarea->TARE_intId)
                        <option value="{{$tarea->TARE_intId}}" selected="">{{$tarea->TARE_intId}}: {{$tarea->TARE_varDescripcion}}</option>
                        @else
                        <option value="{{$tarea->TARE_intId}}">{{$tarea->TARE_intId}}: {{$tarea->TARE_varDescripcion}}</option>
                        @endif
                    @else                    
                        <option value="{{$tarea->TARE_intId}}">{{$tarea->TARE_intId}}: {{$tarea->TARE_varDescripcion}}</option>
                    @endif
                @endforeach                
            </select>
            @if($errors->has('TARE_intId'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('TARE_intId')}}</div>
            @endif
            
        </div>
    </div>


    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('ACCI_varUnidadMedida', 'Unidad de Medida', ['class' => 'label_form']) }}
            {{ Form::text('ACCI_varUnidadMedida', isset($accion)?$accion->ACCI_varUnidadMedida:'', array('class' => 'form-control')) }}
            @if($errors->has('ACCI_varUnidadMedida'))
            <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                   aria-hidden="true"></i> {{$errors->first('ACCI_varUnidadMedida')}}
            </div>
            @endif
                        
            </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('ACCI_varDescripcion', 'Descripción') }}
    {{ Form::textarea('ACCI_varDescripcion', isset($accion)?$accion->ACCI_varDescripcion:'', ['class' => 'form-control']) }}
    @if($errors->has('ACCI_varDescripcion'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('ACCI_varDescripcion')}}</div>
    @endif
</div>      
            
    
      




