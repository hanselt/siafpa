@extends('admin.layout.auth')
@section('nav') 
  @if(Auth::user()->nivel==1)
    @include('admin.menu_admin')
    @elseif(Auth::user()->nivel==2)
    @include('admin.menu_afpa')
    @endif
@endsection
@section('content')

    <div class="row col-sm-8 col-xs-12 center-margin">

        <div class="col-xs-12">
            <h1>Panel de Administracion</h1>
        </div>
        <div class="col-xs-12 col-md-12">
            
            <div class="panel panel-info" style="border-color: #2e353d">
            <div class="panel-heading" style="background-color: #2e353d">
              <h3 class="panel-title" style="color: white">{{ Auth::user()->gen_persona->PERS_varNombres }}  {{ Auth::user()->gen_persona->PERS_varApPaterno }} {{ Auth::user()->gen_persona->PERS_varApMaterno }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="/archivos/general/personas/imagen1.jpg" class="img-circle img-responsive"> </div>
                
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Id de Usuario</td>
                        <td>{{ Auth::user()->id }}</td>
                      </tr>
                      <tr>
                        <td width="40%">Correo de ingreso</td>
                        <td width="60%"><a>{{ Auth::user()->email }}</a></td>
                      </tr>
                      <tr>
                        <td>DNI</td>
                        <td>{{ Auth::user()->gen_persona->PERS_varDNI }}</td>
                      </tr>

                    </tbody>
                  </table>
                  
                  <a href="{{ route('admin.admin_password_edit', Auth::user()->id ) }}" class="btn btn-primary">Cambiar contraseña</a>
                </div>
              </div>
            </div>
                 
            
          </div>
        </div>

    </div>


@endsection
