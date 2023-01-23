<h1 class="text-primary">Lista de CIRAS</h1>

<table class="table table-bordered" id="MyTable">
  <thead>
    <tr>
        <th class="text-center">Hoja Tramite</th>
        <th class="text-center">F. Recepción</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Provincia</th>
        <th class="text-center">Nro. CIRA</th>
        <th class="text-center">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($ciras as $cira)    
        <tr>
            <td class="text-center">{{ $cira->CIRA_varHojaTramite }}</td>            
            <td class="text-center">{{ $cira->CIRA_datFechaRecepcionCIRA }}</td>
            <td class="text-center">{{ $cira->CIRA_varNombreProyecto }}</td>
            <td class="text-center">{{ $cira->UBIG_varProvincia }}</td>
            <td class="text-center">{{ $cira->CIRA_varNroCira }}</td>        

            <td class="text-center">
                
                <a href="{{ url('/admincira/cira/'.$cira->CIRA_varHojaTramite.'/edit') }}" class="btn btn-info btn-xs">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>                
            </td>

        <!--{!! Form::close() !!}-->

        </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
        <th class="text-center">Hoja Tramite</th>
        <th class="text-center">F. Recepción</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Provincia</th>
        <th class="text-center">Nro. CIRA</th>
        <th class="text-center">Acciones</th>
    </tr>
  </tfoot>
</table>