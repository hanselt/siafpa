@extends('templates.catastro.layout')

@section('title', 'Escritorio')

@section('content')
<div class="page-header">
  <h1>Catastro y Saneamiento Físico y Legal</h1>
</div>
<div class="list-group list-group-root">
  <a href="{{ url('admincatastro/ver-monumentos') }}" class="list-group-item">Ver Monumentos</a>
  <a href="{{ url('admincatastro/monumento/create') }}" class="list-group-item">Crear Monumentos</a>
  <a href="{{ url('admincatastro/prov') }}" class="list-group-item">Ver Provincias</a>
  <a href="{{ url('admincatastro/dist') }}" class="list-group-item">Ver Distritos</a>
  <a href="{{ url('admincatastro/nomubigeo') }}" class="list-group-item">Ver Ubigeos</a>
</div>
@endsection
