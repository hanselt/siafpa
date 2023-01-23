@extends('templates.borrar.layout')

@section('content')
<div class="content">
    <div class="row">
     <div class="col-xs-12">
       <h1><?php echo $gen_persona['PERS_varGradoAcademico'],' ',$gen_persona['PERS_varNombres'],' ',$gen_persona['PERS_varApPaterno'],'',$gen_persona['PERS_varApMaterno']; ?></h1>
     </div>
     <div class="arqueologos_archivo col-md-12">
      <div class="single_arqueologo_result">
        <div class="arqueologo_image">
            <img src="../../{{$gen_persona->PERS_varDirImagen}}" height="350" width="330">
        </div>
        <div class="datos_arqueologo">
            <div><h4>Nombre : {{ $gen_persona->PERS_varGradoAcademico}}. {{ $gen_persona->PERS_varNombres}} {{ $gen_persona->PERS_varApPaterno}} {{ $gen_persona->PERS_varApMaterno}}</h4></div>
            <div><b>DNI : </b>{{ $gen_persona->PERS_varDNI}}</div>
            <div><b>RNA : </b>{{ $gen_persona->PERS_varRna}}</div>
            <div><b>Tipo : </b>{{ $gen_persona->PERS_varTipo}}</div>
            <div><b>Cargo : </b>{{ $gen_persona->PERS_varCargo}}</div>
            <p class=""><b>Descripcion: </b>{{ $gen_persona->PERS_varDescription}}</p>

        </div>
      </div>
         </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
  
</script>
@endsection
