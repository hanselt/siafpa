{{ Form::hidden('PMA_varHojaTramite', 'PMA_varHojaTramite') }}
{{ Form::hidden('idPma', 'idPma') }}

<div class="col-lg-6">
    <div class="form-group">
        {!! Form::label('PMA_datFechaRecepcionTD', 'Fecha Recepción',['for' => 'PMA_datFechaRecepcionTD'] ) !!}
        {!! Form::text('PMA_datFechaRecepcionTD', null , ['class' => 'form-control', 'id' => 'PMA_datFechaRecepcionTD', 'placeholder' => 'Fecha Ingreso...' ]  ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('PMA_varNombreProyecto', 'Nombre', ['for' => 'PMA_varNombreProyecto'] ) !!}
        {!! Form::text('PMA_varNombreProyecto', null , ['class' => 'form-control', 'id' => 'PMA_varNombreProyecto', 'placeholder' => 'Cira...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PMA_varRubro', 'Rubro', ['for' => 'PMA_varRubro'] ) !!}
        {!! Form::text('PMA_varRubro', null , ['class' => 'form-control', 'id' => 'PMA_varRubro', 'placeholder' => 'Tipo...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PMA_varNombreAdminEmpresaSolicitante', 'Administrador Emp. Solicitante', ['for' => 'PMA_varNombreAdminEmpresaSolicitante'] ) !!}
        {!! Form::text('PMA_varNombreAdminEmpresaSolicitante', null , ['class' => 'form-control', 'id' => 'PMA_varNombreAdminEmpresaSolicitante', 'placeholder' => 'Rubro...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PMA_datFechaRecepcionCCIRA', 'Fecha Recepción CIRA', ['for' => 'PMA_datFechaRecepcionCCIRA'] ) !!}
        {!! Form::text('PMA_datFechaRecepcionCCIRA', null , ['class' => 'form-control', 'id' => 'PMA_datFechaRecepcionCCIRA', 'placeholder' => 'Resumen Proyecto...' ]  ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('PMA_varPeriodo', 'PERIODO', ['for' => 'PMA_varPeriodo'] ) !!}
        {!! Form::text('PMA_varPeriodo', null , ['class' => 'form-control', 'id' => 'PMA_varPeriodo', 'placeholder' => 'Resumen Proyecto...' ]  ) !!}
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
        {!! Form::label('PMA_varNFEmitidoCCaAFPA', 'N° Y FECHA DEL INFORME EMITIDO POR LA CC AL AFPA', ['for' => 'PMA_varNFEmitidoCCaAFPA'] ) !!}
        {!! Form::text('PMA_varNFEmitidoCCaAFPA', null , ['class' => 'form-control', 'id' => 'PMA_varNFEmitidoCCaAFPA', 'placeholder' => 'Resolucion...' ]  ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('PMA_varNRDAprobacionPMA', 'N° RD APROBACIÓN PMA', ['for' => 'PMA_varNRDAprobacionPMA'] ) !!}
        {!! Form::text('PMA_varNRDAprobacionPMA', null , ['class' => 'form-control', 'id' => 'PMA_varNRDAprobacionPMA', 'placeholder' => 'RD Aprobacion...' ]  ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('PMA_datFechaAprobRDPMA', 'FECHA DE RD APROBACION PMA', ['for' => 'PMA_datFechaAprobRDPMA'] ) !!}
        {!! Form::text('PMA_datFechaAprobRDPMA', null , ['class' => 'form-control', 'id' => 'PMA_datFechaAprobRDPMA', 'placeholder' => 'RD Aprobacion...' ]  ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('PMA_varDocPMA', 'Archivo Adjunto', ['for' => 'PMA_varDocPMA'] ) !!}
        {!! Form::text('PMA_varDocPMA', null , ['class' => 'form-control', 'id' => 'PMA_varDocPMA', 'placeholder' => 'No contiene archivo...' ]  ) !!}
    </div>
</div>
