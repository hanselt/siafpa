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
  <script src="{{ asset('js/Control.js') }}"></script>
  <script src="{{ asset('js/Conversor.js') }}"></script>
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
          @if(auth()->user()->nivel==1)
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Reportes <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ asset('/admincira/ver-tiempos') }}">Control de tiemposs</a></li>
              </ul>
          </li>
          <li class="dropdown-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> CIRA <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ asset('/admincira/cira') }}">Ver CIRAs</a></li>
              </ul>
          </li>
          <li class="dropdown-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> PMA <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ asset('/admincira/pma') }}">Ver PMAs</a></li>
              </ul>
          </li>
          @elseif(auth()->user()->nivel==2)

          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Ingresos <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ asset('/admincira/crear/cira') }}">Agregar Ingresos</a></li>
                  <li><a href="{{ asset('/admincira/ver-cc') }}">Ver Ingresos</a></li>
                  <li><a href="{{ asset('/admincira/crear/ciraantecedente') }}">Agregar Antecedentes</a></li>
              </ul>
          </li>
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Recepción <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ asset('/admincira/ver-observados') }}">Recepcionar Observados</a></li>
                  <li><a href="{{ asset('/admincira/recepcionCertificaciones') }}">Recepcionar Calificados</a></li>
              </ul>
          </li>
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Derivación <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ asset('/admincira/ver-oficiados') }}">Oficiar Observados</a></li>
                  <li><a href="{{ asset('/admincira/enviar-afpa') }}">Derivar AFPA</a></li>
              </ul>
          </li>
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Cargar Archivos excel <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ asset('/admincira/cargarpma') }}">Importar PMAs</a></li>
                  <li><a href="{{ asset('/admincira/cargarcira') }}">Importar CIRAs</a></li>
              </ul>
          </li>
          @elseif(auth()->user()->nivel==3)

          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Expedientes <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ asset('/admincira/ver-exp') }}">Recepción</a></li>
                  <li><a href="{{ asset('/admincira/ver-calificacion') }}">Calificación</a></li>
                  <li><a href="{{ asset('/admincira/ver-abogados') }}">Asignar Abogado</a></li>
              </ul>
          </li>

          @elseif(auth()->user()->nivel==4)

          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Expedientes <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">                  
                  <li><a href="{{ asset('/admincira/recepcionarAbg') }}">Recepcionar Expedientes</a></li>
                  <li><a href="{{ asset('/admincira/calificarAbg') }}">Opinion Legal</a></li>
              </ul>
          </li>

          @endif
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
                <span class="large">Coordinación de Certificaciones</span>
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
                <li><a href="{{ url('/cira/escritorio') }}">Certificaciones</a></li>
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
