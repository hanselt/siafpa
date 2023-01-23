<!-- Authentication Links -->
@if (Auth::guest())
    <a href="{{ route('acceder_ruta') }}" title="Iniciar Sesión" class="btn btn-sm float-left btn-alt btn-hover mrg10R btn-default">
        <span>Iniciar Sesión</span>
        <i class="glyph-icon icon-arrow-right"></i>
    </a>
@else
        
    @if(Auth::guard('admin')->check() === true)
        <span>{{ Auth::user()->gen_persona->PERS_varNombres }}, {{ Auth::user()->gen_persona->PERS_varApPaterno }} {{ Auth::user()->gen_persona->PERS_varApMaterno }} </span>
    @else
        <span>{{ Auth::user()->gen_persona->PERS_varNombres }}, {{ Auth::user()->gen_persona->PERS_varApPaterno }} </span>
    @endif
    


    @if(Auth::guard('admincalificacion')->check() === true)
        <a href="{{ url('/admincalificacion/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Salir" class="btn btn-sm btn-default"><i class="glyph-icon icon-power-off"></i></a>
        <form id="logout-form" action="{{ url('/admincalificacion/logout') }}" method="POST"
              style="display: none;">{{ csrf_field() }}
        </form>
    @elseif(Auth::guard('admincatastro')->check())
        <a href="{{ url('/admincatastro/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Salir" class="btn btn-sm btn-default"><i class="glyph-icon icon-power-off"></i></a>
        <form id="logout-form" action="{{ url('/admincatastro/logout') }}" method="POST"
              style="display: none;">{{ csrf_field() }}
        </form>
    @elseif(Auth::guard('admincgm')->check())
        <a href="{{ url('/admincgm/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Salir" class="btn btn-sm btn-default"><i class="glyph-icon icon-power-off"></i></a>
        <form id="logout-form" action="{{ url('/admincgm/logout') }}" method="POST"
              style="display: none;">{{ csrf_field() }}
        </form>
    @elseif(Auth::guard('admincira')->check())
        <a href="{{ url('/admincira/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Salir" class="btn btn-sm btn-default"><i class="glyph-icon icon-power-off"></i></a>
        <form id="logout-form" action="{{ url('/admincira/logout') }}" method="POST"
              style="display: none;">{{ csrf_field() }}
        </form>
    @elseif(Auth::guard('admin')->check())
        <a href="{{ url('/admin/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Salir" class="btn btn-sm btn-default"><i class="glyph-icon icon-power-off"></i></a>
        <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST"
              style="display: none;">{{ csrf_field() }}
        </form>
    @endif

@endif