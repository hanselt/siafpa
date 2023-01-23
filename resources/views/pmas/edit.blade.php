@extends('layouts.default')
@section('nav')
  @include('admincira.menu')
@endsection
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box" style="background-color:#F2F7F8">
            <h3 class="content-box-header bg-danger">
                Agregar archivo al {{$idPma}}: {{$pma->PMA_varNombreProyecto}}
            </h3>



            {!! Form::model($pma, [ 'route' => ['admincira.pma.update', $pma], 'method' => 'PUT']) !!}
                @include('pmas.partials.fields')
                
                <button type="submit" class="btn btn-success btn-block" disabled>MODIFICAR ADJUNTOS</button>
            {!! Form::close() !!}
            <div class="">
                <div class="row"    >
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Archivo Adjunto
                        </div>
                        <div class="panel-body">
                            {!! Form::open(['route'=> 'admincira.pma.store', 
                                            'method' => 'POST', 
                                            'files'=>'true', 
                                            'id' => 'my-dropzone' , 
                                            'class' => 'dropzone']) !!}
                            {{ Form::hidden('PMA_varHojaTramite', $idPma) }}
                            <div class="dz-message" >
                                @if($pma->PMA_varDocPMA !=='')
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
            
            <a href="{{ url('/admincira/pma') }}" class="btn btn-primary">Regresar</a>

         </div>
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