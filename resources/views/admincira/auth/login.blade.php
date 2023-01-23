@extends('layouts.default')
@section('nav')
    @include('layouts/nav')
@endsection
@section('content')
<div class="container">
    <br/>
    <div class="center-vertical">
        <div class="center-content row">

            <div class="col-md-6 center-margin">

                <h3 class="text-center pad15B font-black text-transform-upr font-size-23">Administrador de Certificaciones</h3>

                <div class="content-box border-top border-red clearfix">
                    <div class="content-box-wrapper row">
                        <form id="login-validation" class="col-md-12" role="form" method="POST" action="{{ url('/admincira/login') }}">
                            {{ csrf_field() }}
                            <div id="login-form">
                                <div class="pad20A">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">Correo</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon addon-inside bg-white font-primary">
                                                <i class="glyph-icon icon-envelope-o"></i>
                                            </span>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Contraseña</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon addon-inside bg-white font-primary">
                                                <i class="glyph-icon icon-unlock-alt"></i>
                                            </span>
                                            <input id="password" type="password" class="form-control" name="password">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mrg15B">
                                        <div class="checkbox-primary col-md-10" style="height: 20px;">
                                            <label>
                                                <input type="checkbox" id="loginCheckbox1" class="custom-checkbox">
                                                Recuerdame
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-black">Iniciar Sesión</button>

                                        <a class="btn btn-link" href="{{ url('/admincira/password/reset') }}">
                                            ¿Olvidaste tu contraseña?
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection
