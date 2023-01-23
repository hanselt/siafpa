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
            {{ Form::label('PERS_varDNI', 'DNI (Documento Nacional de Identidad)', ['class' => 'label_form']) }}
            {{ Form::text('PERS_varDNI', isset($persona)?$persona->PERS_varDNI:'', array('class' => 'form-control')) }}
            @if($errors->has('PERS_varDNI'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('PERS_varDNI')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('PERS_varRna', 'Registro Nacional de Arqueologos', ['class' => 'label_form']) }}
            {{ Form::text('PERS_varRna', isset($persona)?$persona->PERS_varRna:'', array('class' => 'form-control')) }}
            @if($errors->has('PERS_varRna'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('PERS_varRna')}}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('PERS_varTipo', 'Profesión', ['class' => 'label_form']) }}
            {{ Form::select('PERS_varTipo', array('Arqueólogo' => 'Arqueólogo','Antropólogo' => 'Antropólogo','Historiador' =>'Historiador','Ingeniero' =>'Ingeniero','Otros' =>'Otros'),isset($persona)?$persona->PERS_varTipo:'Otros',['class' => 'form-control'],['style'=>'width:457px; height:34px']) }}
            
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('PERS_varCargo', 'Cargo', ['class' => 'label_form']) }}
            {{ Form::text('PERS_varCargo', isset($persona)?$persona->PERS_varCargo:'', array('class' => 'form-control')) }}
            @if($errors->has('PERS_varCargo'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('PERS_varCargo')}}</div>
            @endif
        </div>
    </div>

</div>


<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('PERS_varNombres', 'Nombre(s)', ['class' => 'label_form']) }}
            {{ Form::text('PERS_varNombres', isset($persona)?$persona->PERS_varNombres:'', array('class' => 'form-control')) }}
            @if($errors->has('PERS_varNombres'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('PERS_varNombres')}}
                </div>
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('PERS_varApPaterno', 'Apellido Paterno', ['class' => 'label_form']) }}
            {{ Form::text('PERS_varApPaterno', isset($persona)?$persona->PERS_varApPaterno:'', array('class' => 'form-control')) }}
            @if($errors->has('PERS_varApPaterno'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('PERS_varApPaterno')}}
                </div>
            @endif
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('PERS_varApMaterno', 'Apellido Materno', ['class' => 'label_form']) }}
            {{ Form::text('PERS_varApMaterno', isset($persona)?$persona->PERS_varApMaterno:'', array('class' => 'form-control')) }}
            @if($errors->has('PERS_varApMaterno'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('PERS_varApMaterno')}}
                </div>
            @endif
        </div>
    </div>
</div>


<div class="form-group">
    {{ Form::label('PERS_varGradoAcademico', 'Grado Académico', ['class' => 'label_form']) }}
    {{ Form::text('PERS_varGradoAcademico', isset($persona)?$persona->PERS_varGradoAcademico:'', array('class' => 'form-control')) }}
    @if($errors->has('PERS_varGradoAcademico'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('PERS_varGradoAcademico')}}
        </div>
    @endif
</div>


<div class="form-group">
    {{ Form::label('PERS_varDescription', 'Descripción') }}
    {{ Form::textarea('PERS_varDescription', isset($persona)?$persona->PERS_varDescription:'', ['class' => 'form-control']) }}
    @if($errors->has('PERS_varDescription'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('PERS_varDescription')}}</div>
    @endif
</div>






