@extends('admin.layout.auth')
@section('nav')
    @include('admin.menu_admin')
@endsection
@section('content')

    <div class="row">
        <div class="row col-sm-8 col-xs-12 center-margin">
            <div class="desc">
                <h1>Agregar Administrador CGM</h1>
                <hr>
                <!-- Switch -->
                @if (Session::has('status'))
                    <div class="card-panel teal lighten-2">{{Session::get('status')}}</div>
                @endif

                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.admin_cgm_store') }}">
                {{ csrf_field() }}

                
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Correo del administrador</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="dni" class="col-md-4 control-label">Seleccionar coordinación del administrador</label>
                    <div class="col-md-6"> 
                    
                        <select class="form-control" id="dni" name="dni">                            
                            @foreach($coordinaciones as $coordinacion)
                            <option value="{{$coordinacion->PERS_varDNI}}">{{$coordinacion->COOR_varNombre}}</option>
                            
                            @endforeach
                        </select>                        
                        <label id="NombreEncargado" name="NombreEncargado" class="form-control"></label>

                    </div>
                </div>

                <div class="form-group{{ $errors->has('nivel') ? ' has-error' : '' }}">
                    <label for="nivel" class="col-md-4 control-label">Nivel</label>

                    <div class="col-md-6">
                        
                        {{ Form::select('nivel', array('1' => '1:Administrador CGM','2' => '2:Administrador de Coordinación'),isset($admincgm)?$admincgm->nivel:1,['class' => 'form-control']) }}
                        @if ($errors->has('nivel'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('nivel') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Registrar administrador 
                        </button>
                    </div>
                </div>
            </form>
                 </div>

            </div>
         </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">

        

$( document ).ready(function() {
    var arr = [];
    var pr=true;
                @foreach ($coordinaciones as $coordinacion)
                    var ps={dni:"{{$coordinacion->PERS_varDNI}}",nn:"{{$coordinacion->PERS_varNombres}}",ap:"{{$coordinacion->PERS_varApPaterno}}",am:"{{$coordinacion->PERS_varApMaterno}}"};
                    arr.push(ps);
                    if(pr)
                    {
                        document.getElementById("NombreEncargado").innerHTML=ps.nn+' '+ps.ap+' '+ps.am;
                    }
                    pr=false;
                @endforeach  
    $('#dni').on('change',function(e){
        // actualizar lista de cuentas presupuestales
        var dniseleccionado= e.target.value;
        var result = $.grep(arr, function(e){ return e.dni == dniseleccionado; });
        document.getElementById("NombreEncargado").innerHTML=result[0].nn+' '+result[0].ap+' '+result[0].am;
    });
});

</script>
@endsection