@extends('layouts.default')
@section('nav')
    @include('admincgm.menu2')
@endsection
@section('content')
@if(Auth::user()->nivel==2)
    
    <div class="container mrg15T row">    
        <div class="col-md-12">

            <h3 class="content-box-header bg-danger">Agregar Imagenes al Monumento</h3>
        
        
        {{ Form::model($monumento, [
                          'method' => 'GET',
                          'action' => ['Gen_monumentoController@createImages',$monumento->MONU_intId]
                  ]) }}
        @include('admincgm.gen_monumento.forms.partials.form')
        
        {{ Form::close() }}
        {!! Form::open([
                                 'action'=> ['Gen_monumentoController@storeImages',$monumento->MONU_intId], 
                                 'method' => 'POST', 
                                 'files'=>'true', 
                                 'id' => 'my-dropzone' , 
                                 'class' => 'dropzone']) !!}                                      
                      <div class="dz-message" >
                          Ingrese las imagenes del monumentos aca             
                                                  
                      </div>
                      <div class="dropzone-previews"></div>
        <script>
         
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 100,
            parallelUploads: 2,
            acceptedFiles: "image/*",
            maxFiles: 10,
            
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
        <a href="{{ url('admincgm/ver-monumentos') }}" class="btn btn-primary">Regresar</a>
        </div>


    </div>
@else
<div class="row">
   <h1 style="color: #ea4100" align="center">Acceso Restringido</h1>
</div>
@endif
@endsection
