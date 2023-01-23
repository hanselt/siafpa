<h1 class="text-primary">Lista de PMAS</h1>

<table class="table table-bordered" id="MyTable">
  <thead>
    <tr>
        <th class="text-center">Hoja Tramite</th>
        <th class="text-center">F. Recepción</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Rubro</th>
        <th class="text-center">Distrito</th>
        <th class="text-center">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pmas as $pma)    
        <tr>
            <td class="text-center">{{ $pma->PMA_varHojaTramite }}</td>            
            <td class="text-center">{{ $pma->PMA_datFechaRecepcionTD }}</td>
            <td class="text-center">{{ $pma->PMA_varNombreProyecto }}</td>
            <td class="text-center">{{ $pma->PMA_varRubro }}</td>
            <td class="text-center">{{ $pma->PMA_varDistrito }}</td>        

            <td class="text-center">
                
                <a href="{{ url('/admincira/pma/'.$pma->PMA_varHojaTramite.'/edit') }}" class="btn btn-info btn-xs">
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
        <th class="text-center">Rubro</th>
        <th class="text-center">Distrito</th>
        <th class="text-center">Acciones</th>
    </tr>
  </tfoot>
</table>