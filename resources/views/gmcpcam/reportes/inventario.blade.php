<!DOCTYPE html>
<html lang="es" class="{{ config('app.os', 'unix') }}">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>FICHA DE INVENTARIO DEL MATERIAL CULTURAL MUEBLE</title>
  <link rel="stylesheet" href="{{ asset('css/base/reportes.css') }}">
</head>
<body class="font-medium">
  <p class="text-center">COORDINACIÓN DE CALIFICACIÓN DE INTERVENCIONES ARQUEOLÓGICAS</p>
  <p class="text-center">GABINETE DE MANEJO DE COLECCIONES DEL PATRIMONIO CULTURAL ARQUEOLÓGICO MUEBLE</p>
  <p class="text-center">FICHA TECNICA DE INVENTARIO DE  BIENES CULTURALES ARQUEOLOGICOS</p>
  <p class="text-center">LEY N° 28296 (Cap. III Arts. 14, 15 y 16)</p>
  <h2 class="subtitle">1. DATOS GENERALES</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-1"><strong>Modalidad de Intervención</strong></td>
      <td class="w-6">{{ $datos->proyecto->modalidad_intervencion }}</td>
      <td class="w-2 bordered"><small>CANTIDAD TOTAL DE PIEZAS</small></td>
      <td class="w-1 text-center bg-gray">
        {{ $datos->total_piezas }}
      </td>
    </tr>
    <tr>
      <td rowspan="2"><strong>Nombre del Proyecto</strong></td>
      <td rowspan="2">{{ $datos->proyecto->nombre }}</td>
      <td class="bordered"><small>CANTIDAD TOTAL DE OBJETOS MUSEABLES</small></td>
      <td class="text-center bg-gray">{{ $datos->detalle->sum('museable') }}</td>
    </tr>
    <tr>
      <td class="bordered"><small>CANTIDAD TOTAL DE OBJETOS PARA CONSERVAR</small></td>
      <td class="text-center bg-gray">{{ $datos->detalle->sum('conservar') }}</td>
    </tr>
    <tr>
      <td><strong>Período</strong></td>
      <td>{{ $datos->periodo }}</td>
      <td class="bordered"><small>CANTIDAD TOTAL DE MATERIAL DIAGNOSTICO</small></td>
      <td class="text-center bg-gray">{{ $datos->detalle->sum('material_diagnostico') }}</td>
    </tr>
    <tr>
      <td><strong>Responsable</strong></td>
      <td>{{ $datos->proyecto->nombre_responsable }}</td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td><strong>Código de Caja</strong></td>
      <td>{{ $datos->proyecto->codigo_caja }}</td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td><strong>Documento de Ingreso</strong></td>
      <td>{{ $datos->proyecto->documento_ingreso }}</td>
      <td colspan="2"></td>
    </tr>
  </table>
  <h2 class="subtitle">2. DATOS DE ÍTEMS</h2>
  <table class="full-bordered font-small tla">
    <thead>
      <tr class="text-center">
        <th>Inv.</th>
        <th>Ubicación</th>
        <th>Cód. anteriores</th>
        <th>Tipo de Objeto</th>
        <th>Peso (g)</th>
        <th>Materiales</th>
        <th>Estilo</th>
        <th class="expanded">Descripción General</th>
        <th>Estado</th>
        <th>Ubicación Específica</th>
        <th>Obs.</th>
        <th>Museo</th>
        <th>Conservar</th>
        <th>Material Diag.</th>
        <th>Fotografía</th>
      </tr>
    </thead>
    <tbody>
      @foreach($datos->detalle as $item )
        <tr>
          <td>{{ str_pad($loop->index + 1, 5, '0', STR_PAD_LEFT)  }}</td>
          <td>{{ $item->ubicacion }}</td>
          <td>{{ $item->codigos_anteriores }}</td>
          <td>{{ $item->tipo_objeto }}</td>
          <td class="text-right">{{ $item->peso }}</td>
          <td>{{ $item->materiales }}</td>
          <td>{{ $item->reporte_cultura_estilo }}</td>
          <td>{{ $item->descripcion }}</td>
          <td>{{ $item->estadoConservacion->denominacion }}</td>
          <td>{{ $item->ubicacion_especifica }}</td>
          <td>{{ $item->observaciones }}</td>
          <td class="text-center">{{ $item->museable }}</td>
          <td class="text-center">{{ $item->conservar }}</td>
          <td class="text-center">{{ $item->material_diagnostico }}</td>
          <td><img class="img-table" src="{{ url($item->ruta_fotografia) }}" alt=""></td>
        </tr>
      @endforeach
        <tr>
          <td class="text-right" colspan="5">SUBTOTAL:</td>
          <td>{{ $datos->total_piezas }}</td>
          <td></td>
          <td colspan="4"></td>
          <td>{{ $datos->detalle->sum('museable') }}</td>
          <td>{{ $datos->detalle->sum('conservar') }}</td>
          <td>{{ $datos->detalle->sum('material_diagnostico') }}</td>
          <td></td>
        </tr>
    </tbody>
  </table>
  <h2 class="subtitle">3. DATOS DE CONTROL</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-2"><strong>Registrado por:</strong></td>
      <td class="w-2">{{ $datos->registrador()->first()->name }}</td>
      <td class="w-6"></td>
    </tr>
    <tr>
      <td><strong>Fecha de Registro:</strong> </td>
      <td>{{ $datos->fecha_registro }}</td>
      <td></td>
    </tr>
  </table>
</body>
