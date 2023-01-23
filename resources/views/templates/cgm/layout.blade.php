<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }} | @yield('title') </title>
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/base/app.css') }}">
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
          <li class="sidebar-group-title">Gestión de Monumentos</li>
          <li><a href="{{ url('admincgm/ver-coordinaciones') }}">Ver Coordinaciones</a></li>
          <li><a href="{{ url('admincgm/coordinacion/create') }}">Crear Coordinaciones</a></li>
          <li><a href="{{ url('admincgm/prov') }}">Ver Provincias</a></li>
          <li><a href="{{ url('admincgm/dist') }}">Ver Distritos</a></li>
          <li><a href="{{ url('admincgm/nomubigeo') }}">Ver Ubigeos</a></li>
          <li><a href="{{ url('admincgm/ver-actividades') }}">Ver Actividades</a></li>
          <li><a href="{{ url('admincgm/actividad/create') }}">Crear Actividades</a></li>
          <li><a href="{{ url('admincgm/ver-tareas') }}">Ver Tareas</a></li>
          <li><a href="{{ url('admincgm/tarea/create') }}">Crear Tareas</a></li>
          <li><a href="{{ url('admincgm/ver-acciones') }}">Ver Acciones</a></li>
          <li><a href="{{ url('admincgm/accion/create') }}">Crear Acciones</a></li>
          <li><a href="{{ url('admincgm/ver-resumen') }}">Ver Resumen</a></li>
          <li><a href="{{ url('admincgm/ver-atrimestrales') }}">Ver Acciones Trimestrales</a></li>
          <li><a href="{{ url('admincgm/ver-monumentos') }}">Ver Monumentos</a></li>
          <li><a href="{{ url('admincgm/monum') }}">Ver Imágenes de Monumentos</a></li>
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
                <span class="large">SI - Área Funcional de Patrimonio Arqueológico</span>
                <span class="mini">SIAFPA</span>
              </div>
            </div>
          </div>
        </nav>
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <ol class="breadcrumb">
                <li><a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span> Escritorio</a></li>
                <li><a href="{{ url('/cgm/escritorio') }}">Gestión de Monumentos</a></li>
                @yield('breadcrumb')
              </ol>
              <div id="app">
                @yield('content')
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /#page-content-wrapper -->
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
  </body>
  </html>
