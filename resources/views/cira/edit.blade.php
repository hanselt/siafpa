@extends('layouts.default')
@section('nav')
  @include('admincira.menu')
@endsection
@section('content')
    <div class="row">

        <div class="col-xs-12 col-md-12"> 
            <h4 class="text-center">Agregar archivo al {{$idCira}}: {{$cira->CIRA_varNombreProyecto}}</h4>
            {!! Form::model($cira, [ 'route' => ['admincira.cira.update', $cira], 'method' => 'PUT']) !!}
                @include('cira.partials.fields')
                
                <button type="submit" class="btn btn-success btn-block" disabled>MODIFICAR ADJUNTOS</button>
            {!! Form::close() !!}
            <div class="">
                <div class="row"    >
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Archivo Adjunto
                        </div>
                        <div class="panel-body">
                            {!! Form::open(['route'=> 'admincira.cira.store', 
                                            'method' => 'POST', 
                                            'files'=>'true', 
                                            'id' => 'my-dropzone' , 
                                            'class' => 'dropzone']) !!}
                            {{ Form::hidden('CIRA_varHojaTramite', $idCira) }}
                            <div class="dz-message" >
                                @if($cira->CIRA_varDirArchivoCira !=='')
                                   El proyecto ya tiene un archivo y será reemplazado por uno nuevo, pulse regresar para no realizar cambios
                                @else
                                   Arrastre su archivo aqui...!   
                                @endif                  
                                                        
                            </div>
                            <div class="dropzone-previews"></div>
                            <a class="btn btn-success" id="enviar">Guardar archivo</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>    
            
            <a href="{{ url('/admincira/cira') }}" class="btn btn-primary">Regresar</a>
        </div>
    </div>
@endsection

    

@section('scripts')

<script>         
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 10,
            maxFiles: 2,
            
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