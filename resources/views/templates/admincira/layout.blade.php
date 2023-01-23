<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }} | @yield('title') </title>
  <!-- CSS -->
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <!-- Fuentes -->
  <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
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
        <li class="sidebar-brand">
          <a href="{{ url('/') }}">CCIA</a>
        </li>
        <li><a href="{{ url('/') }}">Escritorio</a></li>
        <li class="sidebar-group-title">Mantenimientos</li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Términos <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('terminos/create') }}">Crear Término</a></li>
            <li><a href="{{ url('terminos') }}">Listar Términos</a></li>
          </ul>
        </li>
        <li><a href="{{ url('monumentos') }}">Monumentos</a></li>
        <li><a href="{{ url('arqueologos') }}">Arqueólogos</a></li>
        <li><a href="{{ url('proyectos') }}">Proyectos</a></li>
        <li><a href="{{ url('pmas') }}">PMAS</a></li>
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
              <li><a href="{{ url('/mantenimientos/escritorio') }}">Mantenimientos</a></li>
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
