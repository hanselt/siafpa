@extends('layouts.default')
@section('nav')
    @include('admincgm.menu2')
@endsection

@section('content')
@if(Auth::user()->nivel==2)
    <div class="row">
        <div class="col-md-12">

            <h1>Agregar documento de acciones trimestrales</h1>
        
        
        {{ Form::model($atrimestral, [
                          'method' => 'GET',
                          'action' => ['Cgm_atrimestralController@createImages',$atrimestral->ATRI_intId]
                  ]) }}
        @include('admincgm.cgm_atrimestral.forms.partials.form')
        
        {{ Form::close() }}
        {!! Form::open([
                                 'action'=> ['Cgm_atrimestralController@storeDoc',$atrimestral->ATRI_intId], 
                                 'method' => 'POST', 
                                 'files'=>'true', 
                                 'id' => 'my-dropzone' , 
                                 'class' => 'dropzone']) !!}                                      
                      <div class="dz-message" >
                          Ingrese el documento aca.
                                                  
                      </div>
                      <div class="dropzone-previews"></div>
        <script>
         
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 40,
            parallelUploads: 1,
            acceptedFiles: ".pdf",
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
                      
        {!! Form::close() !!}
        
        <br> 
        @if(Session::has('msg'))
          {{Session::get('msg')}}
        @endif
        <a class="btn btn-success" id="enviar">Guardar archivos</a>
        <a href="{{ url('admincgm/ver-atrimestrales') }}" class="btn btn-primary">Regresar</a>
        </div>


    </div>
@else
  <div class="hero-box poly-bg-5 hero-box-smaller font-inverse" style="background:url('{{ URL::asset('img/poly-bg/poly-bg-5.jpg') }}')">
      <div class="container">
          <h2 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Advertencia</h2>
          <p class="hero-text wow bounceInUp" data-wow-duration="0.9s" data-wow-delay="0.2s">Acceso Restringido.</p>
      </div>
  </div>
@endif
@endsection
