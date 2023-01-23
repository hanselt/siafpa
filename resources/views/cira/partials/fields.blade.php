{{ Form::hidden('CIRA_varHojaTramite', 'CIRA_varHojaTramite') }}
<div class="col-lg-6">
    <div class="form-group">
        {!! Form::label('CIRA_datFechaRecepcionCIRA', 'Fecha Recepción',['for' => 'CIRA_datFechaRecepcionCIRA'] ) !!}
        {!! Form::text('CIRA_datFechaRecepcionCIRA', null , ['class' => 'form-control', 'id' => 'CIRA_datFechaRecepcionCIRA', 'placeholder' => 'Fecha Ingreso...' ]  ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('CIRA_varNombreProyecto', 'Nombre', ['for' => 'CIRA_varNombreProyecto'] ) !!}
        {!! Form::text('CIRA_varNombreProyecto', null , ['class' => 'form-control', 'id' => 'CIRA_varNombreProyecto', 'placeholder' => 'Cira...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('CIRA_varTipoObra', 'Tipo Obra', ['for' => 'CIRA_varTipoObra'] ) !!}
        {!! Form::text('CIRA_varTipoObra', null , ['class' => 'form-control', 'id' => 'CIRA_varTipoObra', 'placeholder' => 'Tipo...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('CIRA_varAdministradorEmpresa', 'Administrador', ['for' => 'CIRA_varAdministradorEmpresa'] ) !!}
        {!! Form::text('CIRA_varAdministradorEmpresa', null , ['class' => 'form-control', 'id' => 'CIRA_varAdministradorEmpresa', 'placeholder' => 'Rubro...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('CIRA_varNroCira', 'Nro. CIRA', ['for' => 'CIRA_varNroCira'] ) !!}
        {!! Form::text('CIRA_varNroCira', null , ['class' => 'form-control', 'id' => 'CIRA_varNroCira', 'placeholder' => 'Resumen Proyecto...' ]  ) !!}
    </div>

</div>
<div class="col-lg-6">
    
    <div class="form-group">
        {!! Form::label('PMA_douCoordenadaX', 'UTM-X', ['for' => 'PMA_douCoordenadaX'] ) !!}
        {!! Form::text('PMA_douCoordenadaX', null , ['class' => 'form-control', 'id' => 'PMA_douCoordenadaX', 'placeholder' => 'Coordenadas...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PMA_douCoordenadaY', 'UTM-Y', ['for' => 'PMA_douCoordenadaY'] ) !!}
        {!! Form::text('PMA_douCoordenadaY', null , ['class' => 'form-control', 'id' => 'PMA_douCoordenadaY', 'placeholder' => 'Coordenadas...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('CIRA_varResultado', 'Resultado', ['for' => 'CIRA_varResultado'] ) !!}
        {!! Form::text('CIRA_varResultado', null , ['class' => 'form-control', 'id' => 'CIRA_varResultado', 'placeholder' => 'Resolucion...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('CIRA_datFechaExpedicionCira', 'Fecha Expedición', ['for' => 'CIRA_datFechaExpedicionCira'] ) !!}
        {!! Form::text('CIRA_datFechaExpedicionCira', null , ['class' => 'form-control', 'id' => 'CIRA_datFechaExpedicionCira', 'placeholder' => 'RD Aprobacion...' ]  ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('CIRA_varDirArchivoCira', 'Archivo Adjunto', ['for' => 'CIRA_varDirArchivoCira'] ) !!}
        {!! Form::text('CIRA_varDirArchivoCira', null , ['class' => 'form-control', 'id' => 'CIRA_varDirArchivoCira', 'placeholder' => 'No contiene archivo...' ]  ) !!}
    </div>
</div>
