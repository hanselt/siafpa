@extends('layouts.default')
@section('nav')
  @include('admincalificacion.menu')
@endsection
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box" style="background-color:#F2F7F8">
            <h3 class="content-box-header bg-danger">
                Agregar archivo al {{$proyecto->PROY_varTipo}}: {{$proyecto->PROY_varNombre}}
            </h3>

            <h4 class="text-center">Agregar archivo al {{$proyecto->PROY_varTipo}}: {{$proyecto->PROY_varNombre}}</h4>
            {!! Form::model($proyecto, [ 'route' => ['admincalificacion.ciaproyectos.update', $proyecto], 'method' => 'PUT']) !!}
                @include('admincalificacion.ciaproyectos.partials.fields')
                
                <button type="submit" class="btn btn-success btn-block" disabled>MODIFICAR ADJUNTOS</button>
            {!! Form::close() !!}
            <div class="">
                <div class="row"    >
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Archivo Adjunto
                        </div>
                        <div class="panel-body">
                            {!! Form::open(['route'=> 'admincalificacion.ciaproyectos.store', 
                                            'method' => 'POST', 
                                            'files'=>'true', 
                                            'id' => 'my-dropzone' , 
                                            'class' => 'dropzone']) !!}
                            {{ Form::hidden('PROY_varHojaTramite', $idProyecto) }}
                            <div class="dz-message" >
                                @if($proyecto->PROY_varDirArchivo !=='')
                                   El proyecto ya tiene un archivo y será reemplazado por uno nuevo, pulse regresar para no realizar cambios
                                @else
                                   Arrastre su archivo aqui...!   
                                @endif                  
                                                        
                            </div>
                            <div class="dropzone-previews"></div>
                            <a class="btn btn-success" id="enviar">Subir archivo</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>                
            <a href="{{ url('/admincalificacion/ciaproyectos') }}" class="btn btn-primary">Regresar</a>

        </div>
    </div>
</div>
@endsection

    

@section('scripts')
<script>
    $("#file-3").fileinput({
    showCaption: false,
    browseClass: "btn btn-primary btn-lg",
    fileType: "any"
    });
</script>
<script>
         
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: false,
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
                
 
                this.on("success", 
                    myDropzone.processQueue.bind(myDropzone)
                );
            }
        };


</script>
@endsection