@extends('gmcpcam.reportes.partials.base')

@section('title', 'FICHA DE CONTROL DE HUEMEDAD Y TEMPERATURA (F8)')

@section('content')
  <p class="text-center"><strong>FICHA DE CONTROL DE HUEMEDAD Y TEMPERATURA (F8)</strong></p>
  <h2 class="subtitle">1. DATOS DE MONITOREO</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-2"><strong>Nro DE FICHA</strong></td>
      <td>{{ $datos->nro_ficha }}</td>
    </tr>
    <tr>
      <td><strong>FECHA</strong></td>
      <td>{{ $datos->fecha }}</td>
    </tr>
    <tr>
      <td><strong>ESPACIO MONITOREADO</strong></td>
      <td >{{ $datos->espacioMonitoreado->denominacion }}</td>
    </tr>
    <tr>
      <td><strong>HORA</strong></td>
      <td >{{ $datos->hora }}</td>
    </tr>
    <tr>
      <td><strong>HUMEDAD %</strong></td>
      <td >{{ $datos->humedad }}</td>
    </tr>
    <tr>
      <td><strong>TEMPERATURA C°</strong></td>
      <td >{{ $datos->temperatura }}</td>
    </tr>
    <tr>
      <td><strong>OBSERVACIONES</strong></td>
      <td >{{ $datos->observaciones }}</td>
    </tr>
    <tr>
      <td><strong>REGISTRADOR</strong></td>
      <td >{{ $datos->registrador()->first()->name }}</td>
    </tr>
  </table>
@endsection
