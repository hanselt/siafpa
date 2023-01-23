@extends('templates.layout')

@section('title', 'Escritorio')

@section('content')
<ol class="breadcrumb">
  <li class="active"><span class="glyphicon glyphicon-home"></span> Escritorio</li>
</ol>
<div class="row">
    <div class="col-sm-6 col-md-4">
      <a href="{{ url('/mantenimientos/escritorio') }}" class="btn btn-block btn-red-800 btn-gabinete">Mantenimiento de Información General</a>
    </div>
  <div class="col-sm-6 col-md-4">
    <a href="{{ url('/gmcpcam/escritorio') }}" class="btn btn-block btn-red-800 btn-gabinete">Gabinete de Colecciones y Ceramoteca</a>
  </div>
  <div class="col-sm-6 col-md-4">
    <a href="{{ url('/gaf/escritorio') }}" class="btn btn-block btn-red-800 btn-gabinete">Gabinete de Antropología Física</a>
  </div>
  <div class="col-sm-6 col-md-4">
    <a href="{{ url('/dfq/escritorio') }}" class="btn btn-block btn-red-800 btn-gabinete">Departamento Físico Químico</a>
  </div>
  <div class="col-sm-6 col-md-4">
    <a href="{{ url('/cgm/escritorio') }}" class="btn btn-block btn-red-800 btn-gabinete">Gestión de Monumentos</a>
  </div>
  <div class="col-sm-6 col-md-4">
    <a href="{{ url('/cira/escritorio') }}" class="btn btn-block btn-red-800 btn-gabinete">Certificaciones</a>
  </div>
  <div class="col-sm-6 col-md-4">
    <a href="{{ url('/catastro/escritorio') }}" class="btn btn-block btn-red-800 btn-gabinete">Catastro y Saneamiento Físico y Legal</a>
  </div>
  <div class="col-sm-6 col-md-4">
    <a href="{{ url('/calificaciones/escritorio') }}" class="btn btn-block btn-red-800 btn-gabinete">Calificaciones e Intervenciones Arqueológicas</a>
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
