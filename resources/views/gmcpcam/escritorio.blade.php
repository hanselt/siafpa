@extends('templates.gmcpcam.layout')

@section('title', 'Escritorio')

@section('content')
<div class="page-header">
  <h1>Gabinete de Colecciones / Ceramoteca</h1>
</div>
<div class="row">
  <div class="col-md-6">
    <h2 class="h3">Colecciones</h2>
    <div class="list-group list-group-root">
      @if(auth()->user()->can('crear_inventario') || auth()->user()->can('ver_inventario'))
      <a href="#item-1" class="list-group-item" data-toggle="collapse">
        <i class="glyphicon glyphicon-chevron-down"></i>Inventario
      </a>
      <div class="list-group collapse in" id="item-1">
        @can('crear_inventario')
        <a href="{{ url('gmcpcam/fichas/inventario/crear') }}" class="list-group-item">Crear Ficha</a>
        @endcan
        @can('ver_inventario')
        <a href="{{ url('gmcpcam/fichas/inventario/listar') }}" class="list-group-item">Listar Fichas</a>
        @endcan
      </div>
      @endif
      @can('ver_catalogacion')
      <a href="{{ url('gmcpcam/fichas/catalogacion/listar') }}" class="list-group-item">Listar Fichas de Catalogación</a>
      @endcan
      @can('ver_diagnostico')
      <a href="{{ url('gmcpcam/fichas/diagnostico/listar') }}" class="list-group-item">Listar Fichas de Diagnóstico</a>
      @endcan
      @can('ver_intervencion')
      <a href="{{ url('gmcpcam/fichas/intervencion/listar') }}" class="list-group-item">Listar Fichas de Intervención</a>
      @endcan
    </div>
  </div>
  <div class="col-md-6">
    <h2 class="h3">Ceramoteca</h2>
    <div class="list-group list-group-root">
      @can('ver_ceramologico')
      <a href="{{ url('gicpbam/fichas/analisis_ceramologico/listar') }}" class="list-group-item">Listar Análisis Ceramológicos</a>
      @endcan
      @can('ver_conservacion')
      <a href="{{ url('gicpbam/fichas/conservacion/listar') }}" class="list-group-item">Listar Conservaciones Preventivas</a>
      @endcan
      @can('ver_dibujo_tecnico')
      <a href="{{ url('gicpbam/fichas/dibujo_tecnico/listar') }}" class="list-group-item">Listar Dibujos Técnicos</a>
      @endcan
      @can('ver_resultado_analisis')
      <a href="{{ url('gicpbam/fichas/analisis_muestras/listar') }}" class="list-group-item">Listar Resultados de Análisis de Muestras</a>
      @endcan
      @if(auth()->user()->can('crear_montaje_panel') || auth()->user()->can('ver_montaje_panel'))
      <a href="#item-2" class="list-group-item" data-toggle="collapse">
        <i class="glyphicon glyphicon-chevron-down"></i>Montaje en Panel
      </a>
      <div class="list-group collapse in" id="item-2">
        @can('crear_montaje_panel')
        <a href="{{ url('gicpbam/fichas/montaje/crear') }}" class="list-group-item">Crear</a>
        @endcan
        @can('ver_montaje_panel')
        <a href="{{ url('gicpbam/fichas/montaje/listar') }}" class="list-group-item">Listar</a>
        @endcan
      </div>
      @endif
      @if(auth()->user()->can('crear_control_humedad') || auth()->user()->can('ver_control_humedad') || auth()->user()->can('generar_control_humedad_reportes'))
      <a href="#item-3" class="list-group-item" data-toggle="collapse">
        <i class="glyphicon glyphicon-chevron-down"></i>Control de Humedad
      </a>
      <div class="list-group collapse in" id="item-3">
        @can('crear_control_humedad')
        <a href="{{ url('gicpbam/fichas/control_humedad/crear') }}" class="list-group-item">Crear</a>
        @endcan
        @can('ver_control_humedad')
        <a href="{{ url('gicpbam/fichas/control_humedad/listar') }}" class="list-group-item">Listar</a>
        @endcan
        @can('generar_control_humedad_reportes')
        <a href="{{ url('gicpbam/fichas/control_humedad/reportes') }}" class="list-group-item">Reportes</a>
        @endcan
      </div>
      @endif
      @can('ver_movimiento_fragmento')
      <a href="{{ url('gicpbam/fichas/movimiento/listar') }}" class="list-group-item">Listar Movimientos de Fragmentos</a>
      @endcan
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  let app = new Vue({
    el: '#app',
  })
</script>
@endsection
