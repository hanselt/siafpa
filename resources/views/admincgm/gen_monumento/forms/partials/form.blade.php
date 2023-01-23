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
            {{ Form::label('MONU_varCategoria', 'Categoria', ['class' => 'label_form']) }}
            {{ Form::text('MONU_varCategoria', isset($monumento)?$monumento->MONU_varCategoria:'', array('class' => 'form-control','disabled')) }}
            @if($errors->has('MONU_varCategoria'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varCategoria')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('MONU_varNombre', 'Nombre', ['class' => 'label_form']) }}
            {{ Form::text('MONU_varNombre', isset($monumento)?$monumento->MONU_varNombre:'', array('class' => 'form-control','disabled')) }}
            @if($errors->has('MONU_varNombre'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varNombre')}}</div>
            @endif
        </div>
    </div>
    
</div>
<div class="form-group">
    
    {{ Form::label('MONU_varDescripcion', 'Descripción') }}
    {{ Form::textarea('MONU_varDescripcion', isset($monumento)?$monumento->MONU_varDescripcion:'', ['class' => 'form-control']) }}
    @if($errors->has('MONU_varDescripcion'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('MONU_varDescripcion')}}</div>
    @endif
    

</div>
<div class="form-group">
    
    {{ Form::label('MONU_varDescripcionArquitectura', 'Descripción de Arquitectura') }}
    {{ Form::textarea('MONU_varDescripcionArquitectura', isset($monumento)?$monumento->MONU_varDescripcionArquitectura:'', ['class' => 'form-control']) }}
    @if($errors->has('MONU_varDescripcionArquitectura'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('MONU_varDescripcionArquitectura')}}</div>
    @endif
    
</div>

<div class="form-group">
    
    {{ Form::label('MONU_varEtimologia', 'Etimología') }}
    {{ Form::textarea('MONU_varEtimologia', isset($monumento)?$monumento->MONU_varEtimologia:'', ['class' => 'form-control']) }}
    @if($errors->has('MONU_varEtimologia'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('MONU_varEtimologia')}}</div>
    @endif
    
</div>

<div class="form-group">
            {{ Form::label('MONU_varHorarioAtencion', 'Horario de Atención', ['class' => 'label_form']) }}
            {{ Form::text('MONU_varHorarioAtencion',  isset($monumento)?$monumento->MONU_varHorarioAtencion:'', array('class' => 'form-control','step'=>'any')) }}
            @if($errors->has('MONU_varHorarioAtencion'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varHorarioAtencion')}}</div>
            @endif
</div>
<div class="form-group">
            {{ Form::label('MONU_varDirVideo', 'URL de Video', ['class' => 'label_form']) }}
            {{ Form::text('MONU_varDirVideo',  isset($monumento)?$monumento->MONU_varDirVideo:'', array('class' => 'form-control','step'=>'any')) }}
            @if($errors->has('MONU_varDirVideo'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varDirVideo')}}</div>
            @endif
</div>