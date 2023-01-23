@extends('templates.gaf.layout')

@section('title', 'Escritorio')

@section('content')
<div class="page-header">
  <h1>Gabinete de Antropología Física</h1>
</div>
<div class="row">
  <div class="list-group list-group-root">
    @if(auth()->user()->can('crear_analisis_bioarqueologico') || auth()->user()->can('ver_analisis_bioarqueologico'))
    <a href="#item-1" class="list-group-item" data-toggle="collapse">
      <i class="glyphicon glyphicon-chevron-down"></i> Inventario Óseo Humano
    </a>
    <div class="list-group collapse in" id="item-1">
      @can('crear_analisis_bioarqueologico')
      <a href="{{ url('gaf/fichas/inventario_oseo_humano/crear') }}" class="list-group-item">Crear Ficha</a>
      @endcan
      @can('ver_analisis_bioarqueologico')
      <a href="{{ url('gaf/fichas/inventario_oseo_humano/listar') }}" class="list-group-item">Listar Fichas</a>
      @endcan
    </div>
    @endif
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
