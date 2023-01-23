@extends('templates.gicpbam.layout')

@section('title', 'Escritorio')

@section('content')
  <div class="page-header">
    <h1>Gabinete de Ceramoteca</h1>
  </div>
  <div class="list-group list-group-root">
    <a href="#item-1" class="list-group-item" data-toggle="collapse">
      <i class="glyphicon glyphicon-chevron-down"></i>Inventario
    </a>
    <div class="list-group collapse in" id="item-1">
      <a href="{{ url('gicpbam/fichas/inventario/crear') }}" class="list-group-item">Crear</a>
      <a href="{{ url('gicpbam/fichas/inventario/listar') }}" class="list-group-item">Listar</a>
    </div>
    <a href="{{ url('gicpbam/fichas/analisis_ceramologico/listar') }}" class="list-group-item">Listar Análisis Ceramológicos</a></li>
    <a href="{{ url('gicpbam/fichas/conservacion/listar') }}" class="list-group-item">Listar Conservaciones Preventivas</a></li>
    <a href="{{ url('gicpbam/fichas/dibujo_tecnico/listar') }}" class="list-group-item">Listar Dibujos Técnicos</a></li>
    <a href="{{ url('gicpbam/fichas/analisis_muestras/listar') }}" class="list-group-item">Listar Resultados de Análisis de Muestras</a></li>
    <a href="#item-2" class="list-group-item" data-toggle="collapse">
      <i class="glyphicon glyphicon-chevron-down"></i>Montaje en Panel
    </a>
    <div class="list-group collapse in" id="item-2">
      <a href="{{ url('gicpbam/fichas/montaje/crear') }}" class="list-group-item">Crear</a>
      <a href="{{ url('gicpbam/fichas/montaje/listar') }}" class="list-group-item">Listar</a>
    </div>
    <a href="#item-3" class="list-group-item" data-toggle="collapse">
      <i class="glyphicon glyphicon-chevron-down"></i>Control de Humedad
    </a>
    <div class="list-group collapse in" id="item-3">
      <a href="{{ url('gicpbam/fichas/control_humedad/crear') }}" class="list-group-item">Crear</a>
      <a href="{{ url('gicpbam/fichas/control_humedad/listar') }}" class="list-group-item">Listar</a>
    </div>
    <a href="{{ url('gicpbam/fichas/movimiento/listar') }}" class="list-group-item">Listar Movimientos de Fragmentos</a></li>
  </div>
@endsection

@section('scripts')
  <script>
    let app = new Vue({
      el: '#app',
    })
  </script>
@endsection
