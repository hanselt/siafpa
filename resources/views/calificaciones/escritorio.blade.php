@extends('templates.calificaciones.layout')

@section('title', 'Escritorio')

@section('content')
<div class="page-header">
  <h1>Calificaciones e Intervenciones Arqueológicas</h1>
</div>
<div class="list-group list-group-root">
  <a href="{{ url('admincalificacion/cargarccia') }}" class="list-group-item">Cargar CCIA</a>
  <a href="{{ url('admincalificacion/importarccia') }}" class="list-group-item">Importar CCIA</a>
  <a href="{{ url('admincalificacion/ccia') }}" class="list-group-item">CCIA</a>
  <a href="{{ url('admincalificacion/ciaproyectos') }}" class="list-group-item">CIA Proyectos</a>
  <a href="{{ url('admincalificacion/crear/cia') }}" class="list-group-item">Crear CIA</a>
  <a href="{{ url('admincalificacion/pmas') }}" class="list-group-item">PMAs</a>
  <a href="{{ url('admincalificacion/cias') }}" class="list-group-item">CIAs</a>
  <a href="{{ url('admincalificacion/ver-ccia') }}" class="list-group-item">Ver CCIA</a>
  <a href="{{ url('admincalificacion/ver-tiempos') }}" class="list-group-item">Ver Tiempos</a>
  <a href="{{ url('admincalificacion/ver-exp') }}" class="list-group-item">Ver Exp</a>
  <a href="{{ url('admincalificacion/ver-areas') }}" class="list-group-item">Ver Áreas</a>
  <a href="{{ url('admincalificacion/ver-rareas') }}" class="list-group-item">Ver R Áreas</a>
  <a href="{{ url('admincalificacion/ver-calificacion') }}" class="list-group-item">Ver Calificación</a>
  <a href="{{ url('admincalificacion/ver-abogados') }}" class="list-group-item">Ver Abogados</a>
  <a href="{{ url('admincalificacion/ver-observados') }}" class="list-group-item">Ver Observados</a>
  <a href="{{ url('admincalificacion/ver-oficiados') }}" class="list-group-item">Ver Oficiados</a>
  <a href="{{ url('admincalificacion/recepcionarAbg') }}" class="list-group-item">Recepcionar Abogado</a>
  <a href="{{ url('admincalificacion/calificarAbg') }}" class="list-group-item">Calificar Abogado</a>
  <a href="{{ url('admincalificacion/recepcionCertificaciones') }}" class="list-group-item">Recepción Certificaciones</a>
  <a href="{{ url('admincalificacion/enviar-afpa') }}" class="list-group-item">Enviar AFPA</a>
  <a href="{{ url('admincalificacion/crear/ciaantecedente') }}" class="list-group-item">Crear CIA Antecedente</a>
</div>
@endsection
