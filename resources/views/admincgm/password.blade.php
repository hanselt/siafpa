@extends('layouts.default')
@section('nav')
    @if(Auth::user()->nivel==1)
        @include('admincgm.menu')
    @else
        @include('admincgm.menu2')
    @endif
@endsection

@section('content')

    <div class="row col-sm-8 col-xs-12 center-margin">
        <div class="col-xs-12">
        <div class="panel panel-info" style="border-color: #2e353d">
            <div class="panel-heading" style="background-color: #2e353d">
              <h3 class="panel-title" style="color: white">{{ Auth::user()->gen_persona->PERS_varNombres }}  {{ Auth::user()->gen_persona->PERS_varApPaterno }} {{ Auth::user()->gen_persona->PERS_varApMaterno }} .. cambiando contraseña</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                {{ Form::model($admin, [
                        'method' => 'PATCH',
                        'action' => ['AdmincgmAuth\AdmincgmController@updatePassword',$admin->id]
                ]) }}
                <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td width="50%">
                            <input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="Nueva Contraseña" autocomplete="off">
                            <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 6 caracteres mínimo
                        </td>
                        <td width="50%">
                            <input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Repita la Contraseña" autocomplete="off">
                            <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Coincidencia de contraseñas
                        </td>
                      </tr>
                    
                    
                    
                    </tbody>
                </table>
                <input type="submit" id="myButton" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Cambiar Contraseña">
                {{ Form::close() }}
                </div>
            </div>
        </div>
        </div>


    </div>
@endsection
@section('scripts')
<script type="text/javascript">

$("input[type=password]").keyup(function(){
    
    if($("#password1").val().length >= 6){
        $("#8char").removeClass("glyphicon-remove");
        $("#8char").addClass("glyphicon-ok");
        $("#8char").css("color","#00A41E");
    }else{
        $("#8char").removeClass("glyphicon-ok");
        $("#8char").addClass("glyphicon-remove");
        $("#8char").css("color","#FF0004");
        $("#myButton").hide();
    }
    
    if(($("#password1").val() == $("#password2").val())&&($("#password1").val().length >=6)){
        $("#pwmatch").removeClass("glyphicon-remove");
        $("#pwmatch").addClass("glyphicon-ok");
        $("#pwmatch").css("color","#00A41E");
        $("#myButton").show();
    }else{
        $("#pwmatch").removeClass("glyphicon-ok");
        $("#pwmatch").addClass("glyphicon-remove");
        $("#pwmatch").css("color","#FF0004");
        $("#myButton").hide();
    }
});
</script>
@endsection