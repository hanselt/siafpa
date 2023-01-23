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
            {{ Form::label('UBIG_varID', 'Ubigeo', ['class' => 'label_form']) }}
            {{ Form::number('UBIG_varID', isset($monumento)?$monumento->UBIG_varID:'', array('class' => 'form-control')) }}
            @if($errors->has('UBIG_varID'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('UBIG_varID')}}</div>
            @endif
        </div>
    </div>


    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('COOR_intId', 'Coordenadas de Ubicacion', ['class' => 'label_form']) }}
            {{ Form::number('COOR_intId', isset($monumento)?$monumento->COOR_intId:'', array('class' => 'form-control')) }}
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
            {{ Form::label('MONU_varNombre', 'Nombre del Monumento', ['class' => 'label_form']) }}
            {{ Form::text('MONU_varNombre', isset($monumento)?$monumento->MONU_varNombre:'', array('class' => 'form-control')) }}
            @if($errors->has('MONU_varNombre'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varNombre')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('MONU_varCategoria', 'Categoria del Monumento', ['class' => 'label_form']) }}
            {{ Form::text('MONU_varCategoria', isset($monumento)?$monumento->MONU_varCategoria:'', array('class' => 'form-control')) }}
            @if($errors->has('MONU_varCategoria'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varCategoria')}}</div>
            @endif
        </div>
    </div>
</div>




<div class="form-group">
    {{ Form::label('MONU_varDescripcion', 'Descripcion') }}
    {{ Form::textarea('MONU_varDescripcion', isset($monumento)?$monumento->MONU_varDescripcion:'', ['class' => 'form-control']) }}
    @if($errors->has('MONU_varDescripcion'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('MONU_varDescripcion')}}</div>
    @endif
</div>

<div class="form-group">
    {{ Form::label('MONU_varDescripcionArquitectura', 'Descripcion Arquitectura') }}
    {{ Form::textarea('MONU_varDescripcionArquitectura', isset($monumento)?$monumento->MONU_varDescripcionArquitectura:'', ['class' => 'form-control']) }}
    @if($errors->has('MONU_varDescripcionArquitectura'))
        <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                               aria-hidden="true"></i> {{$errors->first('MONU_varDescripcionArquitectura')}}</div>
    @endif
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('MONU_varEtimologia', 'Etimologia', ['class' => 'label_form']) }}
            {{ Form::text('MONU_varEtimologia', isset($monumento)?$monumento->MONU_varEtimologia:'', array('class' => 'form-control')) }}
            @if($errors->has('MONU_varEtimologia'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varEtimologia')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('MONU_varHorarioAtencion', 'Horario de Atencion', ['class' => 'label_form']) }}
            {{ Form::text('MONU_varHorarioAtencion', isset($monumento)?$monumento->MONU_varHorarioAtencion:'', array('class' => 'form-control')) }}
            @if($errors->has('MONU_varHorarioAtencion'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varHorarioAtencion')}}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('MONU_varUTMX', 'Coordenada UTM X', ['class' => 'label_form']) }}
            {{ Form::number('MONU_varUTMX', isset($monumento)?$monumento->MONU_varUTMX:'', array('class' => 'form-control')) }}
            @if($errors->has('MONU_varUTMX'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varUTMX')}}</div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('MONU_varUTMY', 'Coordenada UTM Y', ['class' => 'label_form']) }}
            {{ Form::number('MONU_varUTMY', isset($monumento)?$monumento->MONU_varUTMY:'', array('class' => 'form-control')) }}
            @if($errors->has('MONU_varUTMY'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varUTMY')}}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            {{ Form::label('MONU_varDirArchivoKML', 'Archivo KML', ['class' => 'label_form']) }}
            {{ Form::text('MONU_varDirArchivoKML', isset($monumento)?$monumento->MONU_varDirArchivoKML:'', array('class' => 'form-control')) }}
            @if($errors->has('MONU_varDirArchivoKML'))
                <div class="red-text text-darken-2"><i class="fa fa-exclamation-triangle"
                                                       aria-hidden="true"></i> {{$errors->first('MONU_varDirArchivoKML')}}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">

</div>





<div class="form-group">
    <button class="btn btn-primary" type="submit" name="action">Guardar</button>
</div>
