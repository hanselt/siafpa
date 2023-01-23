@extends('templates.calificaciones.layout')
@section('nav')

@endsection
@section('content')
@if(Auth::user())
  <!--13 nov-->  
    <div class="container mrg15T row">
      <div class="col-md-12">
        <div class="content-box" style="background-color:#f5f8fa">
            <h3 class="content-box-header bg-danger" style="background-color:#cf4436">
                Ingreso de documentos
            </h3>
            {{ Form::open(array('url' => 'admincalificacion/crear/cia','method','POST')) }}
            @include('admincalificacion.cia.forms.partials.form')
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="action">Guardar</button>
            </div>
            {{ Form::close() }}


        </div>
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
