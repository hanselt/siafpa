@extends('admin.layout.auth')
@section('nav')
  @include('admincatastro.menu')
@endsection
@section('content')

<div class="row">      
        <div class="col-xs-12 col-md-12" >
   
   
          <div class="panel panel-info" style="border-color: #2e353d">
            <div class="panel-heading" style="background-color: #2e353d">
              <h3 class="panel-title" style="color: white">{{ Auth::user()->gen_persona->PERS_varNombres }}  {{ Auth::user()->gen_persona->PERS_varApPaterno }} {{ Auth::user()->gen_persona->PERS_varApMaterno }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{ Auth::user()->gen_persona->PERS_varDirImagen }}" class="img-circle img-responsive"> </div>
                
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
                        <td width="40%">Documento Nacional de Identidad</td>
                        <td width="60%">{{ Auth::user()->gen_persona->PERS_varDNI }}</td>
                      </tr>
                      <tr>
                        <td>Registro Nacional de Arqueólogos</td>
                        <td>{{ Auth::user()->gen_persona->PERS_varTipo }}</td>
                      </tr>
                      <tr>
                        <td>Grado Académico</td>
                        <td>{{ Auth::user()->gen_persona->PERS_varGradoAcademico }}</td>
                      </tr>
                      <tr>
                        <td>Ocupación</td>
                        <td>{{ Auth::user()->gen_persona->PERS_varTipo }}</td>
                      </tr>
                      <tr>
                        <td>Cargo</td>
                        <td>{{ Auth::user()->gen_persona->PERS_varCargo }}</td>
                      </tr>
                      <tr>
                        <td>Correo</td>
                        <td><a>{{ Auth::user()->email }}</a></td>
                      </tr>
                      <tr>
                        <td>Tipo de administrador</td>
                        <td>{{ Auth::user()->getTable() }}</td>
                      </tr>
                      <tr>
                        <td>Ultima actualización</td>
                        <td>{{ substr(Auth::user()->gen_persona->updated_at,0,10) }}
                        </td>
                      </tr>
                     
                    </tbody>
                  </table>
                  
                  <a href="{{ route('admincatastro.admin_password_edit', Auth::user()->id ) }}" class="btn btn-primary">Cambiar contraseña</a>
                </div>
              </div>
            </div>
                 
            
          </div>
        </div>
</div>
    


@endsection
