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
          <li class="sidebar-group-title">Mantenimientos</li>
          @if(auth()->user()->can('crear_terminos') || auth()->user()->can('ver_terminos'))
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Términos <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              @can('crear_terminos')
              <li><a href="{{ url('terminos/create') }}">Crear Término</a></li>
              @endcan
              @can('ver_terminos')
              <li><a href="{{ url('terminos') }}">Listar Términos</a></li>
              @endcan
            </ul>
          </li>
          @endif
          @can('ver_monumentos')
          <li><a href="{{ url('monumentos') }}">Monumentos</a></li>
          @endcan
          @can('ver_arqueologos')
          <li><a href="{{ url('arqueologos') }}">Arqueólogos</a></li>
          @endcan
          @can('ver_proyectos')
          <li><a href="{{ url('proyectos') }}">Proyectos</a></li>
          @endcan
          @can('ver_pmas')
          <li><a href="{{ url('pmas') }}">PMAS</a></li>
          @endcan
          @if(auth()->user()->can('crear_requisas') || auth()->user()->can('ver_requisas'))
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Requisas y otros <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              @can('crear_requisas')
              <li><a href="{{ url('requisas/create') }}">Crear Requisa</a></li>
              @endcan
              @can('ver_requisas')
              <li><a href="{{ url('requisas') }}">Listar Requisas</a></li>
              @endcan
            </ul>
          </li>
          @endif
          @if (auth()->user()->can('crear_usuarios') || auth()->user()->can('ver_usuarios'))
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Usuarios <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              @can('crear_usuarios')
              <li><a href="{{ url('usuarios/create') }}">Crear Usuario</a></li>
              @endcan
              @can('ver_usuarios')
              <li><a href="{{ url('usuarios') }}">Listar Usuarios</a></li>
              @endcan
            </ul>
          </li>
          @endif
          @if(auth()->user()->can('crear_roles') || auth()->user()->can('ver_roles'))
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Roles <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              @can('crear_roles')
              <li><a href="{{ url('roles/create') }}">Crear Rol</a></li>
              @endcan
              @can('ver_roles')
              <li><a href="{{ url('roles') }}">Listar Roles</a></li>
              @endcan
            </ul>
          </li>
          @endif
          @if(auth()->user()->can('crear_permisos') || auth()->user()->can('ver_permisos'))
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> Permisos <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              @can('crear_permisos')
              <li><a href="{{ url('permisos/create') }}">Crear Permiso</a></li>
              @endcan
              @can('ver_permisos')
              <li><a href="{{ url('permisos') }}">Listar Permisos</a></li>
              @endcan
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
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
  </body>
  </html>
