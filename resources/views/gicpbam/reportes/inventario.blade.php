<!DOCTYPE html>
<html lang="es" class="{{ config('app.os', 'unix') }}">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Ficha Técnica de Inventario de Bienes Culturales Arqueológicos</title>
  <link rel="stylesheet" href="{{ asset('css/base/reportes.css') }}">
</head>
<body class="font-medium">
  <ul class="list-inline text-center font-medium">
    <li><p>FICHA TECNICA DE INVENTARIO DE BIENES CULTURALES ARQUEOLOGICOS (F1)</p>
    <p>REGLAMENTO DE INTERVENCIONES ARQUEOLOGICAS - DECRETO SUPREMO 003-2014 - MC</p></li>
  </ul>
  <table class="fixed">
    <tr>
      <td class="w-3">MODALIDAD DE INTERVENCION ARQUEOLOGICA Y NOMBRE DEL PROYECTO DE ACUERDO A LA RESOLUCION</td>
      <td class="w-7 bordered">{{ $datos->reporte_proyecto_nombre }}</td>
    </tr>
    <tr>
      <td>PERIODO DE INTERVENCION</td>
      <td class="bordered">{{ $datos->periodo_intervencion }}</td>
    </tr>
    <tr>
      <td>DIRECTOR DEL PROYECTO ARQUEOLOGICO</td>
      <td class="bordered">{{ $datos->reporte_proyecto_director }}</td>
    </tr>
    <tr>
      <td>Nro RNA / COARPE</td>
      <td class="bordered">{{ $datos->proyecto->responsable->PERS_varRna }}</td>
    </tr>
    <tr>
      <td></td>
      <td>CONTENEDOR {{ $datos->contenedor }}</td>
    </tr>
  </table>
  <table class="full-bordered">
    <thead>
      <tr class="text-center">
        <td>Nro. de Inv.</td>
        <td>Nro. de Bolsa</td>
        <td>Sector/ Sub Sector/ Unidad/ Capa/ Nivel/ Contexto</td>
        <td>Peso en gramos</td>
        <td>Tipo de Objeto</td>
        <td>Tipo de Material</td>
        <td>Estilos Alfareros</td>
        <td>Parte de la Vasija</td>
        <td>Descripción</td>
        <td>Cantidad total por Bolsa</td>
        <td>Observaciones</td>
        <td>Foto</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($datos->detalle as $item)
        <tr>
          <td>{{ str_pad($loop->index + 1, 3, '0', STR_PAD_LEFT) }}</td>
          <td>{{ str_pad($item->nro_bolsa, 4, '0', STR_PAD_LEFT) }}</td>
          <td>{{ $item->reporte_ubicacion }}</td>
          <td class="text-right">{{ $item->peso }}</td>
          <td>{{ $item->reporte_tipo_objeto }}</td>
          <td>{{ $item->reporte_material }}</td>
          <td>{{ $item->reporte_estilos_alfareros }}</td>
          <td>{{ $item->reporte_parte_vasija }}</td>
          <td>{{ $item->descripcion_general }}</td>
          <td class="text-right">{{ $item->cantidad_total_bolsa }}</td>
          <td>{{ $item->observaciones }}</td>
          <td><img class="img-table" src="{{ url($item->ruta_fotografia) }}" alt=""></td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <table class="fixed">
    <tr>
      <td class="w-2">Responsable de Clasificación</td>
      <td class="w-4 bordered">{{ $datos->responsable_clasificacion }}</td>
      <td class="w-4"></td>
    </tr>
    <tr>
      <td>Fecha de Clasificación</td>
      <td class="bordered">{{ $datos->fecha_clasificacion }}</td>
    </tr>
  </table>
</body>
