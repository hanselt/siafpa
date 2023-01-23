@extends('layouts.default')
@section('nav')
  @include('admincatastro.menu')
@endsection
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box" style="background-color:#F2F7F8">

            <h3 class="content-box-header bg-danger">
              Agregar archivos al Monumento
            </h3>
        
        @foreach($monumentos as $monumento)
        {{ Form::model($monumento, [
                          'method' => 'GET',
                          'action' => ['Gen_monumentoController@createArchivos',$monumento->MONU_intId]
                  ]) }}
        @include('admincatastro.gen_monumento.forms.partials.form')
        
        {{ Form::close() }}
        @endforeach  

        {!! Form::open([
                                 'action'=> ['Gen_monumentoController@storeArchivos',$monumento->MONU_intId], 
                                 'method' => 'POST', 
                                 'files'=>'true', 
                                 'id' => 'my-dropzone' , 
                                 'class' => 'dropzone']) !!}                                      
                      <div class="dz-message">
                          @if($monumento->MONU_varDirArchivoREDeclaratoria !='')
                             La persona ya tiene un archivo y será reemplazado por uno nuevo, pulse regresar para no realizar cambios
                          @else
                             Arrastre los documentos aqui...!   
                          @endif                  
                                                  
                      </div>
                      <div class="dropzone-previews"></div>
        <script>
         
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 100,
            parallelUploads: 3,
            acceptedFiles: ".pdf,.kml",
            maxFiles: 3,
            
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
                      
        {!! Form::close() !!}
        
        <br> 
        @if(Session::has('msg'))
          {{Session::get('msg')}}
        @endif
        <a class="btn btn-success" id="enviar">Guardar archivos</a>
        <a href="{{ url('admincatastro/ver-monumentos') }}" class="btn btn-primary">Regresar</a>

        </div>
    </div>
</div>

@endsection
