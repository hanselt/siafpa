<!-- JWCC CAMBIANDO TEMPLATE GENERAL-->
@extends('templates.borrar.layout')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-xs-12">
            <h1>Listado de Personas</h1>
            <div class="tools">
                @include('layouts.partials.filtro_ejemplo')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="arqueologos_archivo col-md-12">

            @foreach($listado as $gen_persona)
            <div class="">
                <div class="single_arqueologo_result">
                    <div class="arqueologo_image">
                        <a href="{{ route('mostrar_single_persona', $gen_persona->PERS_varDNI) }}"><img src='{{$gen_persona->PERS_varDirImagen}}' height="150" width="130"></a>
                    </div>
                    <div class="datos_arqueologo">
                        <div><h4>Nombre : <a href="{{ route('mostrar_single_persona', $gen_persona->PERS_varDNI) }}">{{ $gen_persona->PERS_varGradoAcademico}}. {{ $gen_persona->PERS_varNombres}} {{ $gen_persona->PERS_varApPaterno}} {{ $gen_persona->PERS_varApMaterno}}</a></h4></div>
                        <div><b>DNI : </b>{{ $gen_persona->PERS_varDNI}}</div>
                        <div><b>RNA : </b>{{ $gen_persona->PERS_varRna}}</div>
                        <div><b>Tipo : </b>{{ $gen_persona->PERS_varTipo}}</div>
                        <div><b>Cargo : </b>{{ $gen_persona->PERS_varCargo}}</div>
                        <p class="" align=justify><b>Descripcion: </b>{{ $gen_persona->PERS_varDescription}}</p>

                    </div>
                </div>
            </div>
            @endforeach


        </div>
        @include('layouts.partials.pagination')
    </div>
</div>
@section('scripts')
<script>
  
</script>
@endsection
@endsection