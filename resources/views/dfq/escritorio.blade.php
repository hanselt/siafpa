@extends('templates.dfq.layout')

@section('title', 'Escritorio')

@section('content')
<div class="page-header">
  <h1>Gabinete de Antropología Física</h1>
</div>
<div class="list-group list-group-root">
  @if(auth()->user()->can('crear_analisis_material_litico') || auth()->user()->can('ver_analisis_material_litico'))
  <a href="#item-1" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i> Análisis de Material Lítico
  </a>
  <div class="list-group collapse in" id="item-1">
    @can('crear_analisis_material_litico')
    <a href="{{ url('dfq/fichas/analisis_material_litico/crear') }}" class="list-group-item">Crear Ficha</a>
    @endcan
    @can('ver_analisis_material_litico')
    <a href="{{ url('dfq/fichas/analisis_material_litico/listar') }}" class="list-group-item">Listar Fichas</a>
    @endcan
  </div>
  @endif
  @if(auth()->user()->can('crear_ficha_metales') || auth()->user()->can('ver_ficha_metales'))
  <a href="#item-2" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i> Análisis de Metales
  </a>
  <div class="list-group collapse in" id="item-2">
    @can('crear_ficha_metales')
    <a href="{{ url('dfq/fichas/analisis_metales/crear') }}" class="list-group-item">Crear Ficha</a>
    @endcan
    @can('ver_ficha_metales')
    <a href="{{ url('dfq/fichas/analisis_metales/listar') }}" class="list-group-item">Listar Fichas</a>
    @endcan
  </div>
  @endif
  @if(auth()->user()->can('crear_analisis_materiales') || auth()->user()->can('ver_analisis_materiales'))
  <a href="#item-3" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i> Análisis de Materiales
  </a>
  <div class="list-group collapse in" id="item-3">
    @can('crear_analisis_materiales')
    <a href="{{ url('dfq/fichas/analisis_materiales/crear') }}" class="list-group-item">Crear Ficha</a>
    @endcan
    @can('ver_analisis_materiales')
    <a href="{{ url('dfq/fichas/analisis_materiales/listar') }}" class="list-group-item">Listar Fichas</a>
    @endcan
  </div>
  @endif
  @if(auth()->user()->can('crear_analisis_materiales_ceramicos') || auth()->user()->can('ver_analisis_materiales_ceramicos'))
  <a href="#item-4" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i> Análisis de Materiales Cerámicos
  </a>
  <div class="list-group collapse in" id="item-4">
    @can('crear_analisis_materiales_ceramicos')
    <a href="{{ url('dfq/fichas/analisis_materiales_ceramicos/crear') }}" class="list-group-item">Crear Ficha</a>
    @endcan
    @can('ver_analisis_materiales_ceramicos')
    <a href="{{ url('dfq/fichas/analisis_materiales_ceramicos/listar') }}" class="list-group-item">Listar Fichas</a>
    @endcan
  </div>
  @endif
  @if(auth()->user()->can('crear_analisis_micro_quimico') || auth()->user()->can('ver_analisis_micro_quimico'))
  <a href="#item-5" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i> Análisis Micro Químico – Estratigráfico de Obras de Arte
  </a>
  <div class="list-group collapse in" id="item-5">
    @can('crear_analisis_micro_quimico')
    <a href="{{ url('dfq/fichas/analisis_micro_quimico/crear') }}" class="list-group-item">Crear Ficha</a>
    @endcan
    @can('ver_analisis_micro_quimico')
    <a href="{{ url('dfq/fichas/analisis_micro_quimico/listar') }}" class="list-group-item">Listar Fichas</a>
    @endcan
  </div>
  @endif
  @if(auth()->user()->can('crear_analisis_arqueobiologico') || auth()->user()->can('ver_analisis_arqueobiologico'))
  <a href="#item-6" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i> Análisis Arqueobiológico
  </a>
  <div class="list-group collapse in" id="item-6">
    @can('crear_analisis_arqueobiologico')
    <a href="{{ url('dfq/fichas/analisis_arqueobiologico/crear') }}" class="list-group-item">Crear Ficha</a>
    @endcan
    @can('ver_analisis_arqueobiologico')
    <a href="{{ url('dfq/fichas/analisis_arqueobiologico/listar') }}" class="list-group-item">Listar Fichas</a>
    @endcan
  </div>
  @endif
  @if(auth()->user()->can('crear_analisis_aguas') || auth()->user()->can('ver_analisis_aguas'))
  <a href="#item-7" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i> Análisis de Aguas
  </a>
  <div class="list-group collapse in" id="item-7">
    @can('crear_analisis_aguas')
    <a href="{{ url('dfq/fichas/analisis_aguas/crear') }}" class="list-group-item">Crear Ficha</a>
    @endcan
    @can('ver_analisis_aguas')
    <a href="{{ url('dfq/fichas/analisis_aguas/listar') }}" class="list-group-item">Listar Fichas</a>
    @endcan
  </div>
  @endif
  @if(auth()->user()->can('crear_peritaje_especimenes_fosiles') || auth()->user()->can('ver_peritaje_especimenes_fosiles'))
  <a href="#item-8" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i> Peritaje de Autenticidad de Especímenes Fósiles
  </a>
  <div class="list-group collapse in" id="item-8">
    @can('crear_peritaje_especimenes_fosiles')
    <a href="{{ url('dfq/fichas/peritaje_especimenes_fosiles/crear') }}" class="list-group-item">Crear Ficha</a>
    @endcan
    @can('ver_peritaje_especimenes_fosiles')
    <a href="{{ url('dfq/fichas/peritaje_especimenes_fosiles/listar') }}" class="list-group-item">Listar Fichas</a>
    @endcan
  </div>
  @endif
</div>
@endsection

@section('scripts')
<script>
  let app = new Vue({
    el: '#app',
  })
</script>
@endsection
