@extends('layouts.default')
@section('nav')
    @include('admincgm.menu2')
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">

        <h1>Agregar imagenes de acciones 5 trimestrales</h1>
    
    
    {{ Form::model($atrimestral, [
                      'method' => 'GET',
                      'action' => ['Cgm_atrimestralController@createImages',$atrimestral->ATRI_intId]
              ]) }}
    @include('admincgm.cgm_atrimestral.forms.partials.form')
    
    {{ Form::close() }}
    {!! Form::open([
                             'action'=> ['Cgm_atrimestralController@storeImages',$atrimestral->ATRI_intId], 
                             'method' => 'POST', 
                             'files'=>'true', 
                             'id' => 'my-dropzone' , 
                             'class' => 'dropzone']) !!}                                      
                  <div class="dz-message" >
                      Ingrese las imagenes de las acciones aca.
                                              
                  </div>
                  <div class="dropzone-previews"></div>
    <script>
     
    Dropzone.options.myDropzone = {
        autoProcessQueue: false,
        uploadMultiple: true,
        maxFilezise: 20,
        parallelUploads: 3,
        acceptedFiles: "image/*",
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
    <a href="{{ url('admincgm/ver-atrimestrales') }}" class="btn btn-primary">Regresar</a>
    </div>


</div>
@endsection