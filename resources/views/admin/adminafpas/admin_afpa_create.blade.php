@extends('admin.layout.auth')
@section('nav')
    @include('admin.menu_admin')
@endsection
@section('content')

    <div class="row">
        <div class="row col-sm-8 col-xs-12 center-margin">
            <div class="desc">
                <h1>Agregar Administrador AFPA</h1>
                <hr>
                <!-- Switch -->
                @if (Session::has('status'))
                    <div class="card-panel teal lighten-2">{{Session::get('status')}}</div>
                @endif

                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.admin_afpa_store') }}">
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

                <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">
                    <label for="dni" class="col-md-4 control-label">Seleccionar administrador</label>
                    <div class="col-md-6"> 
                        <select class="form-control" id="dni" name="dni">                            
                            @foreach($personas as $persona)
                            <option value="{{$persona->PERS_varDNI}}">{{$persona->PERS_varApPaterno}} {{$persona->PERS_varApMaterno}}, {{$persona->PERS_varNombres}}</option>
                            @endforeach
                        </select>                                               
                    </div>                   

                    
                </div>                
                <div class="form-group{{ $errors->has('nivel') ? ' has-error' : '' }}">
                    <label for="nivel" class="col-md-4 control-label">Seleccionar nivel</label>
                    <div class="col-md-6"> 
                        <select class="form-control" id="nivel" name="nivel">                            
                            <option value="1">1: Accesos</option>
                            <option value="2">2: Reportes</option>
                            <option value="3">3: Ingresos</option>
                            
                        </select>                                               
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