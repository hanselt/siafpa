<h1 class="text-primary">Mantenimiento de Proyectos</h1>

<table class="table table-bordered" id="MyTable">
  <thead>
    <tr>
        <th class="text-center">Hoja Tramite</th>
        <th class="text-center">F. Ingreso</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Tipo</th>
        <th class="text-center">Rubro</th>
        <th class="text-center">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($proyectos as $proyecto)    
        <tr>
            <td class="text-center">{{ $proyecto->PROY_varHojaTramite }}</td>            
            <td class="text-center">{{ $proyecto->PROY_datFechaIngreso }}</td>
            <td class="text-center">{{ $proyecto->PROY_varNombre }}</td>
            <td class="text-center">{{ $proyecto->PROY_varTipo }}</td>
            <td class="text-center">{{ $proyecto->PROY_varRubro }}</td>

        

            <td class="text-center">                
                <a href="{{ url('/admincalificacion/ciaproyectos/'.$proyecto->PROY_varHojaTramite.'/edit') }}" class="btn btn-info btn-xs">
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
        <th class="text-center">F. Ingreso</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Tipo</th>
        <th class="text-center">Rubro</th>
        <th class="text-center">Acciones</th>
    </tr>
  </tfoot>
</table>