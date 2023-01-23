@extends('templates.no-auth.layout')

@section('title', 'Iniciar Sesión')
@section('body-attrs', "class=login")

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      @if (session('mensaje'))
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('mensaje') }}
      </div>
      @endif
      <div class="logo">
        <img src="{{ url('img/ddcc.jpeg') }}" alt="" class="img-responsive center-block">
      </div>
      <div class="panel">
        <div class="panel-body">
          <form action="{{ url('login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}" autofocus="" />
            </div>
            <div class="form-group input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input class="form-control" type="password" name="password" placeholder="Contraseña"/>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember" value="true" {{ old('remember') ? 'checked' : '' }}> Recuérdame.</a>
              </label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-red-800 btn-block">Acceder</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  let app = new Vue({
    el: "#app",
  })
</script>
@endsection
