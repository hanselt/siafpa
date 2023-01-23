@extends('templates.cgm.layout')

@section('title', 'Escritorio')

@section('content')
<div class="page-header">
  <h1>Gestión de Monumentos</h1>
</div>
<div class="list-group list-group-root">
  <a href="{{ url('admincgm/ver-coordinaciones') }}" class="list-group-item">Ver Coordinaciones</a>
  <a href="{{ url('admincgm/coordinacion/create') }}" class="list-group-item">Crear Coordinaciones</a>
  <a href="{{ url('admincgm/prov') }}" class="list-group-item">Ver Provincias</a>
  <a href="{{ url('admincgm/dist') }}" class="list-group-item">Ver Distritos</a>
  <a href="{{ url('admincgm/nomubigeo') }}" class="list-group-item">Ver Ubigeos</a>
  <a href="{{ url('admincgm/ver-actividades') }}" class="list-group-item">Ver Actividades</a>
  <a href="{{ url('admincgm/actividad/create') }}" class="list-group-item">Crear Actividades</a>
  <a href="{{ url('admincgm/ver-tareas') }}" class="list-group-item">Ver Tareas</a>
  <a href="{{ url('admincgm/tarea/create') }}" class="list-group-item">Crear Tareas</a>
  <a href="{{ url('admincgm/ver-acciones') }}" class="list-group-item">Ver Acciones</a>
  <a href="{{ url('admincgm/accion/create') }}" class="list-group-item">Crear Acciones</a>
  <a href="{{ url('admincgm/ver-resumen') }}" class="list-group-item">Ver Resumen</a>
  <a href="{{ url('admincgm/ver-atrimestrales') }}" class="list-group-item">Ver Acciones Trimestrales</a>
  <a href="{{ url('admincgm/ver-monumentos') }}" class="list-group-item">Ver Monumentos</a>
  <a href="{{ url('admincgm/monum') }}" class="list-group-item">Ver Imágenes de Monumentos</a>
</div>
@endsection
