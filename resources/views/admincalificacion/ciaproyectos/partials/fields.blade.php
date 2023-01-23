{{ Form::hidden('PROY_varHojaTramite', 'PROY_varHojaTramite') }}
<div class="col-lg-6">
    <div class="form-group">
        {!! Form::label('PROY_datFechaIngreso', 'Fecha Ingreso', ['for' => 'PROY_datFechaIngreso'] ) !!}
        {!! Form::text('PROY_datFechaIngreso', null , ['class' => 'form-control', 'id' => 'PROY_datFechaIngreso', 'placeholder' => 'Fecha Ingreso...' ]  ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('PROY_varNombre', 'Nombre', ['for' => 'PROY_varNombre'] ) !!}
        {!! Form::text('PROY_varNombre', null , ['class' => 'form-control', 'id' => 'PROY_varNombre', 'placeholder' => 'Proyecto...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PROY_varTipo', 'Tipo', ['for' => 'PROY_varTipo'] ) !!}
        {!! Form::text('PROY_varTipo', null , ['class' => 'form-control', 'id' => 'PROY_varTipo', 'placeholder' => 'Tipo...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PROY_varRubro', 'Rubro', ['for' => 'PROY_varRubro'] ) !!}
        {!! Form::text('PROY_varRubro', null , ['class' => 'form-control', 'id' => 'PROY_varRubro', 'placeholder' => 'Rubro...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PROY_varEmpresa', 'Empresa', ['for' => 'PROY_varEmpresa'] ) !!}
        {!! Form::text('PROY_varEmpresa', null , ['class' => 'form-control', 'id' => 'PROY_varEmpresa', 'placeholder' => 'Empresa...' ]  ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('PROY_varPlazoEjecucion', 'Plazo ejecución', ['for' => 'PROY_varPlazoEjecucion'] ) !!}
        {!! Form::text('PROY_varPlazoEjecucion', null , ['class' => 'form-control', 'id' => 'PROY_varPlazoEjecucion', 'placeholder' => 'Plazo ejecucion...' ]  ) !!}
    </div>


</div>
<div class="col-lg-6">
    <div class="form-group">
        {!! Form::label('PROY_varResumenProyecto', 'Resumen', ['for' => 'PROY_varResumenProyecto'] ) !!}
        {!! Form::text('PROY_varResumenProyecto', null , ['class' => 'form-control', 'id' => 'PROY_varResumenProyecto', 'placeholder' => 'Resumen Proyecto...' ]  ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('PROY_douCoordenadaX', 'UTM-X', ['for' => 'PROY_douCoordenadaX'] ) !!}
        {!! Form::text('PROY_douCoordenadaX', null , ['class' => 'form-control', 'id' => 'PROY_douCoordenadaX', 'placeholder' => 'Coordenadas...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PROY_douCoordenadaY', 'UTM-Y', ['for' => 'PROY_douCoordenadaY'] ) !!}
        {!! Form::text('PROY_douCoordenadaY', null , ['class' => 'form-control', 'id' => 'PROY_douCoordenadaY', 'placeholder' => 'Coordenadas...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PROY_varResulucionAprobacion', 'Resolución Aprobación', ['for' => 'PROY_varResulucionAprobacion'] ) !!}
        {!! Form::text('PROY_varResulucionAprobacion', null , ['class' => 'form-control', 'id' => 'PROY_varResulucionAprobacion', 'placeholder' => 'Resolucion...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PROY_datFechaRDAprobacion', 'Fecha Aprobación', ['for' => 'PROY_datFechaRDAprobacion'] ) !!}
        {!! Form::text('PROY_datFechaRDAprobacion', null , ['class' => 'form-control', 'id' => 'PROY_datFechaRDAprobacion', 'placeholder' => 'RD Aprobacion...' ]  ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('PROY_varDirArchivo', 'Archivo Adjunto', ['for' => 'PROY_varDirArchivo'] ) !!}
        {!! Form::text('PROY_varDirArchivo', null , ['class' => 'form-control', 'id' => 'PROY_varDirArchivo', 'placeholder' => 'No contiene archivo...' ]  ) !!}
    </div>
</div>
