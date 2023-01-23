@extends('templates.calificaciones.layout')
@section('nav')

@endsection
@section('content') 
	<div class="row">
        <div class="col-xs-12 col-md-12">    
    		@include('admincalificacion.ciaproyectos.partials.table')
    	</div>
    </div>		
@endsection
