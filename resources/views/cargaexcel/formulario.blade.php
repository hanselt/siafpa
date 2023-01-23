@extends('templates.calificaciones.layout')
@section('styles')
<link rel="stylesheet" href="{{ URL::asset('css/dropzone.css') }}">
@endsection
@section('nav')
    @if($lcTipo=='ccia')
        @include('admincalificacion.menu')   
    @elseif ($lcTipo=='pma')
        @include('admincira.menu2') 
    @elseif ($lcTipo=='cira')   
        @include('admincira.menu2')
    @endif
@endsection
@section('content')
    <div class="container mrg15T row">
        <div class="col-md-12">

            @if (isset($lcProceso))
                <div class="content-box" style="background-color:#F2F7F8">
                    <h3 class="content-box-header bg-danger">
                        Importar Excel
                    </h3>
                    <p>Proceso de Importacción {{$lcProceso}} terminó Correctamente </p>
                    @if($lcProceso=='CCIA')
                        <a href="/admincalificacion/ccia"  class="btn btn-success">Ver resultados</a>                     
                    @elseif ($lcProceso=='PMA')
                        <a href="/admincira/pma"  class="btn btn-success">Ver resultados</a> 
                    @elseif ($lcProceso=='CIRA')  
                        <a href="/admincira/cira"  class="btn btn-success">Ver resultados</a> 
                    @endif
                </div>
            @else
                <div class="content-box" style="background-color:#F2F7F8">
                    <h3 class="content-box-header bg-danger">
                        CARGAR EXCEL
                    </h3>
                    <div class="panel-body"> 
                        @if($lcTipo=='ccia')
                            {!! Form::open(['url'=> 'admincalificacion/cargarccia', 'method' => 'POST', 'files'=>'true', 'id' => 
                            'my-dropzone' , 'class' => 'dropzone']) !!}
                        @elseif ($lcTipo=='pma')
                            {!! Form::open(['url'=> 'admincira/cargarpma', 'method' => 'POST', 'files'=>'true', 'id' => 
                            'my-dropzone' , 'class' => 'dropzone']) !!}
                        @elseif ($lcTipo=='cira')  
                            {!! Form::open(['url'=> 'admincira/cargarcira', 'method' => 'POST', 'files'=>'true', 'id' => 
                            'my-dropzone' , 'class' => 'dropzone']) !!}
                        @endif 

                            <div class="dz-message" style="height:100px;">
                                Arrastre sus Archivos Aqui..!
                            </div>
                            <div class="dropzone-previews"></div>
                            <button type="submit" class="btn btn-primary" id="submit">Subir Archivo</button>
                            
        
                            {!! Form::close() !!}
                    </div>
                    <div class="panel-body">
                        @if($lcTipo=='ccia')
                            <a href="/admincalificacion/importarccia"  class="btn btn-primary">Procesar CCIA</a>                     
                        @elseif ($lcTipo=='pma')
                            <a href="/admincira/importarpma"  class="btn btn-primary">Procesar PMA</a> 
                        @elseif ($lcTipo=='cira')  
                            <a href="/admincira/importarcira"  class="btn btn-primary">Procesar CIRA</a> 
                        @endif
                    </div>
                </div>

            @endif

        </div>
    </div>
@endsection

@section('scripts')
<script src="{{URL::asset('js/dropzone.js') }}"></script>
<script>
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilezise: 10,
            maxFiles: 2,
            
            init: function() { 
                var submitBtn = document.querySelector("#submit");
                myDropzone = this;
                
                submitBtn.addEventListener("click", function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on("addedfile", function(file) {
                    //alert("file uploaded");
                });
                
                this.on("complete", function(file) {
                    myDropzone.removeFile(file);
                });
 
                this.on("success", 
                    myDropzone.processQueue.bind(myDropzone)
                );
            }
        };
    </script>
@endsection