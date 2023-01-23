<!DOCTYPE html>
<html lang="es" class="{{ config('app.os', 'unix') }}">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Ficha de Registro y Control diario de Humedad relativa y Temperatura</title>
  <link rel="stylesheet" href="{{ asset('css/base/reportes.css') }}">
</head>
<body class="font-medium">
  <ul class="list-inline text-center">
    <li><p>COORDINACIÓN DE CALIFICACIONES DE INTERVENCIONES ARQUEOLÓGICAS</p>
    <p>GABINETE DE INVESTIGACIÓN Y CONSERVACIÓN PREVENTIVA DE BIENES ARQUEOLÓGICOS MUEBLES – CERAMOTECA</p>
    <p>FICHA DE REGISTRO Y CONTROL DIARIO DE HUMEDAD RELATIVA y TEMPERATURA</p></li>
  </ul>
  <table class="full-bordered">
    <thead>
      <tr class="text-center">
        <th rowspan="2">Fecha</th>
        <th rowspan="2">Tiempo</th>
        @foreach ($datos['espacios_monitoreados'] as $espacio)
          <th colspan="2">{{ $espacio }}</th>
        @endforeach
      </tr>
      <tr class="text-center">
        @foreach ($datos['espacios_monitoreados'] as $espacio)
          <th>Humedad (%)</th>
          <th>Temperatura (C°)</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach ($datos['fechas'] as $fecha)
        <tr>
          <td rowspan="2">{{ $fecha }}</td>
          <td>Mañana</td>
          @foreach ($datos['espacios_monitoreados'] as $espacio)
            @if (isset($datos['transformada'][$fecha]['manana']) && isset($datos['transformada'][$fecha]['manana'][$espacio]))
              <td class="text-right">{{ $datos['transformada'][$fecha]['manana'][$espacio]['humedad'] }}</td>
              <td class="text-right">{{ $datos['transformada'][$fecha]['manana'][$espacio]['temperatura'] }}</td>
            @else
              <td></td><td></td>
            @endif
          @endforeach
        </tr>
        <tr>
          <td>Tarde</td>
          @foreach ($datos['espacios_monitoreados'] as $espacio)
            @if (isset($datos['transformada'][$fecha]['tarde']) && isset($datos['transformada'][$fecha]['tarde'][$espacio]))
              <td class="text-right">{{ $datos['transformada'][$fecha]['tarde'][$espacio]['humedad'] }}</td>
              <td class="text-right">{{ $datos['transformada'][$fecha]['tarde'][$espacio]['temperatura'] }}</td>
            @else
              <td></td><td></td>
            @endif
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
