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
          <li class="sidebar-group-title">Colecciones</li>
          @if(auth()->user()->can('crear_inventario') || auth()->user()->can('ver_inventario'))
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Inventario <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              @can('crear_inventario')
              <li><a href="{{ url('gmcpcam/fichas/inventario/crear') }}">Crear Ficha</a></li>
              @endcan
              @can('ver_inventario')
              <li><a href="{{ url('gmcpcam/fichas/inventario/listar') }}">Listar Fichas</a></li>
              @endcan
            </ul>
          </li>
          @endif
          @can('ver_catalogacion')
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Catalogación <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('gmcpcam/fichas/catalogacion/listar') }}">Listar Fichas</a></li>
            </ul>
          </li>
          @endcan
          @can('ver_diagnostico')
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Diagnóstico <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('gmcpcam/fichas/diagnostico/listar') }}">Listar Fichas</a></li>
            </ul>
          </li>
          @endcan
          @can('ver_intervencion')
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Intervención <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('gmcpcam/fichas/intervencion/listar') }}">Listar Fichas</a></li>
            </ul>
          </li>
          @endcan
          <li class="sidebar-group-title">Ceramoteca</li>
          @can('ver_ceramologico')
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Ceramológico <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('gicpbam/fichas/analisis_ceramologico/listar') }}">Listar</a></li>
            </ul>
          </li>
          @endcan
          @can('ver_conservacion')
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Conservación <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('gicpbam/fichas/conservacion/listar') }}">Listar</a></li>
            </ul>
          </li>
          @endcan
          @can('ver_dibujo_tecnico')
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Dibujo Técnico <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('gicpbam/fichas/dibujo_tecnico/listar') }}">Listar</a></li>
            </ul>
          </li>
          @endcan
          @can('ver_resultado_analisis')
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Análisis de Muestras <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('gicpbam/fichas/analisis_muestras/listar') }}">Listar</a></li>
            </ul>
          </li>
          @endcan
          @if(auth()->user()->can('crear_montaje_panel') || auth()->user()->can('ver_montaje_panel'))
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Montaje <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              @can('crear_montaje_panel')
              <li><a href="{{ url('gicpbam/fichas/montaje/crear') }}">Crear</a></li>
              @endcan
              @can('ver_montaje_panel')
              <li><a href="{{ url('gicpbam/fichas/montaje/listar') }}">Listar</a></li>
              @endcan
            </ul>
          </li>
          @endif
          @if(auth()->user()->can('crear_control_humedad') || auth()->user()->can('ver_control_humedad') || auth()->user()->can('generar_control_humedad_reportes'))
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Control de Humedad <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              @can('crear_control_humedad')
              <li><a href="{{ url('gicpbam/fichas/control_humedad/crear') }}">Crear</a></li>
              @endcan
              @can('ver_control_humedad')
              <li><a href="{{ url('gicpbam/fichas/control_humedad/listar') }}">Listar</a></li>
              @endcan
              @can('generar_control_humedad_reportes')
              <li><a href="{{ url('gicpbam/fichas/control_humedad/reportes') }}">Reportes</a></li>
              @endcan
            </ul>
          </li>
          @endif
          @can('ver_movimiento_fragmento')
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Mov. de Fragmentos <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('gicpbam/fichas/movimiento/listar') }}">Listar</a></li>
            </ul>
          </li>
          @endcan
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
                <li><a href="{{ url('/gmcpcam/escritorio') }}">GMCPCAM - GICPBAM</a></li>
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
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
  </body>
  </html>
