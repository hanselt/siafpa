@extends('layouts.default')
@section('nav')
    @include('admin.menu_admin')
@endsection
@section('content')
<div class="row">
    <div class="row col-sm-11 col-xs-12 center-margin">
        <h1>
            Agregar Imagen a la persona {{$persona->PERS_varNombres}}
        </h1>
        {{ Form::model($persona, [
                      'method' => 'GET',
                      'action' => ['AdminAuth\AdminController@imagenPersona',$persona->PERS_varDNI]
              ]) }}
            @include('admin.gen_persona.forms.partials.form')
            <button type="submit" class="btn btn-black btn-block" disabled>MODIFICAR ADJUNTOS</button>
        {{ Form::close() }}
  
        <div class="row"    >
            <div class="form-group" style="margin:15px">
                <div class="form-group">
                   Archivo Adjunto
                </div>
               
                {!! Form::open([
                             'action'=> ['AdminAuth\AdminController@updateImagen',$persona->PERS_varDNI], 
                             'method' => 'POST', 
                             'files'=>'true', 
                             'id' => 'my-dropzone' , 
                             'class' => 'dropzone']) !!}                                      
                    <div class="dz-message" >
                      @if($persona->PERS_varDirImagen !=='')
                         la persona ya tiene un archivo y será reemplazado por uno nuevo, pulse regresar para no realizar cambios
                      @else
                         Arrastre su archivo aqui...!   
                      @endif                  
                                              
                    </div>
                    <div class="dropzone-previews"></div>
                  
                {!! Form::close() !!}
            </div>
        </div>
        <a class="btn btn-black" id="enviar">Guardar archivo</a>
        <a href="{{ url('admin/ver-personas') }}" class="btn btn-warning">Regresar</a>
    </div>
</div>
@endsection

    

@section('scripts')

<script>
         
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 10,
            maxFiles: 1,
            
            init: function() {
                var submitBtn = document.querySelector("#enviar");
                myDropzone = this;
                
                submitBtn.addEventListener("click", function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();                    
                });

                /*this.on("addedfile", function(file) {
                    alert("archivo cargando");
                });*/
                
                /*this.on("complete", function(file) {
                    alert("archivo guardado");
                });*/
 
                this.on("success", 
                    myDropzone.processQueue.bind(myDropzone)
                );
            }
        };


</script>
@endsection