<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="{{ config('app.os', 'unix') }}">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/base/reportes.css') }}">
</head>
<body class="@yield('body-class', 'font-medium')">
  <!-- Contenido del reporte -->
  <p class="text-center"><strong>COORDINACIÓN DE CALIFICACIÓN DE INTERVENCIONES ARQUEOLÓGICAS</strong></p>
  <p class="text-center"><strong>Gabinete de Manejo de Colecciones del Patrimonio Cultural Arqueológico Mueble</strong></p>
  @yield('content')
</body>
