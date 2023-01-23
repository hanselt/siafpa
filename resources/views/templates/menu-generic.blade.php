<li class="sidebar-brand">
  <a href="{{ url('/escritorio') }}">INICIO</a>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-user"></i> Mi Cuenta <span class="caret"></span></a>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{ url('perfil') }}">Perfil</a></li>
    <li><a href="{{ url('logout') }}">Cerrar Sesión</a></li>
  </ul>
</li>
<li><a href="{{ url('/escritorio') }}">Escritorio</a></li>
