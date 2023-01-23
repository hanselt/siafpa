<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }} | @yield('title') </title>
  <!-- CSS -->
  <link rel="stylesheet" href="{{ mix('css/base/app.css') }}">
  <!-- Fuentes -->
  <link rel="stylesheet" href="{{ asset('css/base/fonts.css') }}">
  <script>
    window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
    ]) !!};
  </script>
  @yield('styles')
</head>
<body class="nav-closed">
  <div id="wrapper">
    <div class="overlay"></div>
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
      <ul class="nav sidebar-nav">
        @include('templates.menu-generic')
        <li class="sidebar-group-title">GICPBAM (Ceramoteca)</li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Inventario <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('gicpbam/fichas/inventario/crear') }}">Crear</a></li>
            <li><a href="{{ url('gicpbam/fichas/inventario/listar') }}">Listar</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Ceramológico <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('gicpbam/fichas/analisis_ceramologico/listar') }}">Listar</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Conservación <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('gicpbam/fichas/conservacion/listar') }}">Listar</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Dibujo Técnico <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('gicpbam/fichas/dibujo_tecnico/listar') }}">Listar</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Análisis de Muestras <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('gicpbam/fichas/analisis_muestras/listar') }}">Listar</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Montaje <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('gicpbam/fichas/montaje/crear') }}">Crear</a></li>
            <li><a href="{{ url('gicpbam/fichas/montaje/listar') }}">Listar</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Control de Humedad <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('gicpbam/fichas/control_humedad/crear') }}">Crear</a></li>
            <li><a href="{{ url('gicpbam/fichas/control_humedad/listar') }}">Listar</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Mov. de Fragmentos <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('gicpbam/fichas/movimiento/listar') }}">Listar</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-inverse navbar-fixed-top" id="top-navbar">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
              <span class="hamb-top"></span>
              <span class="hamb-middle"></span>
              <span class="hamb-bottom"></span>
            </button>
            <div class="navbar-brand">
              <span class="large">Coordinación de Calificaciones de Intervenciones Arqueológicas</span>
              <span class="mini">CCIA</span>
            </div>
          </div>
        </div>
      </nav>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span> Escritorio</a></li>
              <li><a href="{{ url('/gicpbam/escritorio') }}">GICPBAM</a></li>
              @yield('breadcrumb')
            </ol>
            <div id="app" v-cloak>
              @yield('content')
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- Scripts -->
  <script src="{{ asset('js/manifest.js') }}"></script>
  <script src="{{ asset('js/vendor.js') }}"></script>
  <script src="{{ mix('js/app.js') }}"></script>
  @yield('scripts')
</body>
</html>
