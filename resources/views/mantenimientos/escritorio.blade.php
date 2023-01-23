@extends('templates.mantenimientos.layout')

@section('title', 'Escritorio')

@section('content')
<div class="page-header">
  <h1>Mantenimientos</h1>
</div>
<div class="list-group list-group-root">
  @if(auth()->user()->can('crear_terminos') || auth()->user()->can('ver_terminos'))
  <a href="#item-1" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Términos
  </a>
  <div class="list-group collapse in" id="item-1">
    @can('crear_terminos')
    <a href="{{ url('terminos/create') }}" class="list-group-item">Crear Término</a>
    @endcan
    @can('ver_terminos')
    <a href="{{ url('terminos') }}" class="list-group-item">Listar Términos</a>
    @endcan
  </div>
  @endif
  @can('ver_monumentos')
  <a href="{{ url('monumentos') }}" class="list-group-item">Monumentos</a>
  @endcan
  @can('ver_arqueologos')
  <a href="{{ url('arqueologos') }}" class="list-group-item">Arqueólogos</a>
  @endcan
  @can('ver_proyectos')
  <a href="{{ url('proyectos') }}" class="list-group-item">Proyectos</a>
  @endcan
  @can('ver_pmas')
  <a href="{{ url('pmas') }}" class="list-group-item">PMAS</a>
  @endcan
  @if(auth()->user()->can('crear_requisas') || auth()->user()->can('ver_requisas'))
  <a href="#item-4" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Requisas y otros
  </a>
  <div class="list-group collapse in" id="item-4">
    @can('crear_requisas')
    <a href="{{ url('requisas/create') }}" class="list-group-item">Crear Requisa</a>
    @endcan
    @can('ver_requisas')
    <a href="{{ url('requisas') }}" class="list-group-item">Listar Requisas</a>
    @endcan
  </div>
  @endif
  @if (auth()->user()->can('crear_usuarios') || auth()->user()->can('ver_usuarios'))
  <a href="#item-2" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Usuarios
  </a>
  <div class="list-group collapse in" id="item-2">
    @can('crear_usuarios')
    <a href="{{ url('usuarios/create') }}" class="list-group-item">Crear Usuario</a>
    @endcan
    @can('ver_usuarios')
    <a href="{{ url('usuarios') }}" class="list-group-item">Listar Usuarios</a>
    @endcan
  </div>
  @endif
  @if(auth()->user()->can('crear_roles') || auth()->user()->can('ver_roles'))
  <a href="#item-3" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Roles
  </a>
  <div class="list-group collapse in" id="item-3">
    @can('crear_roles')
    <a href="{{ url('roles/create') }}" class="list-group-item">Crear Rol</a>
    @endcan
    @can('ver_roles')
    <a href="{{ url('roles') }}" class="list-group-item">Listar Roles</a>
    @endcan
  </div>
  @endif
  @if(auth()->user()->can('crear_permisos') || auth()->user()->can('ver_permisos'))
  <a href="#item-5" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Permisos
  </a>
  <div class="list-group collapse in" id="item-5">
    @can('crear_permisos')
    <a href="{{ url('permisos/create') }}" class="list-group-item">Crear Permiso</a>
    @endcan
    @can('ver_permisos')
    <!-- a href="{{ url('permisos') }}" class="list-group-item">Listar Permisos</a-->
    @endcan
  </div>
  @endif
</div>
@endsection

@section('scripts')
<script>
  let app = new Vue({
    el: '#app',
  })
</script>
@endsection
