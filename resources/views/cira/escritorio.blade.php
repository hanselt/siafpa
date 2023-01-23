@extends('templates.cira.layout')

@section('title', 'Escritorio')

@section('content')
<div class="page-header">
  <h1>Certificaciones</h1>
</div>
<div class="list-group list-group-root">
  @if(auth()->user()->nivel==1)
  <a href="#item-1" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Reportes
  </a>
  <div class="list-group collapse in" id="item-1">
    <a href="{{ asset('/admincira/ver-tiempos') }}" class="list-group-item">Control de tiempos</a>    
  </div>
  
  <a href="#item-2" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>CIRA
  </a>
  <div class="list-group collapse in" id="item-2">    
    <a href="{{ asset('/admincira/cira') }}" class="list-group-item">Ver CIRAs</a>    
  </div>

  <a href="#item-3" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>PMA
  </a>
  <div class="list-group collapse in" id="item-3">
    <a href="{{ asset('/admincira/pma') }}" class="list-group-item">Ver PMAs</a>   
  </div>

  @elseif(auth()->user()->nivel==2)
  <a href="#item-4" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Ingresos
  </a>
  <div class="list-group collapse in" id="item-4">    
    <a href="{{ asset('/admincira/crear/cira') }}" class="list-group-item">Agregar Ingresos</a>
    <a href="{{ asset('/admincira/ver-cc') }}" class="list-group-item">Ver Ingresos</a>
    <a href="{{ asset('/admincira/crear/ciraantecedente') }}" class="list-group-item">Agregar Antecedentes</a>    
  </div>

  <a href="#item-5" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Recepción
  </a>
  <div class="list-group collapse in" id="item-5">
    <a href="{{ asset('/admincira/ver-observados') }}" class="list-group-item">Recepcionar Observados</a>
    <a href="{{ asset('/admincira/recepcionCertificaciones') }}" class="list-group-item">Recepcionar Calificados</a>    
  </div>

  <a href="#item-6" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Derivación
  </a>
  <div class="list-group collapse in" id="item-6">
    <a href="{{ asset('/admincira/ver-oficiados') }}" class="list-group-item">Oficiar Observados</a>
    <a href="{{ asset('/admincira/enviar-afpa') }}" class="list-group-item">Derivar AFPA</a>   
  </div>

  <a href="#item-7" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Cargar Archivos excel
  </a>
  <div class="list-group collapse in" id="item-7">
    <a href="{{ asset('/admincira/cargarpma') }}" class="list-group-item">Importar PMAs</a>
    <a href="{{ asset('/admincira/cargarcira') }}" class="list-group-item">Importar CIRAs</a>   
  </div>

  @elseif(auth()->user()->nivel==3)
  
  <a href="#item-8" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Expedientes
  </a>
  <div class="list-group collapse in" id="item-8">
    <a href="{{ asset('/admincira/ver-exp') }}" class="list-group-item">Recepción</a>
    <a href="{{ asset('/admincira/ver-calificacion') }}" class="list-group-item">Calificación</a>
    <a href="{{ asset('/admincira/ver-abogados') }}" class="list-group-item">Asignar Abogado</a>  
  </div>

  @elseif(auth()->user()->nivel==4)

  <a href="#item-9" class="list-group-item" data-toggle="collapse">
    <i class="glyphicon glyphicon-chevron-down"></i>Expedientes
  </a>
  <div class="list-group collapse in" id="item-9">
    <a href="{{ asset('/admincira/recepcionarAbg') }}" class="list-group-item">Recepcionar Expedientes</a>
    <a href="{{ asset('/admincira/calificarAbg') }}" class="list-group-item">Opinion Legal</a> 
  </div>

  @endif
  
</div>
@endsection
