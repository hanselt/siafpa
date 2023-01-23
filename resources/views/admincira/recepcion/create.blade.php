@extends('templates.cira.layout')
@section('content')
@if(Auth::user()->nivel==2)
  <!--13 nov-->  
    <div class="container mrg15T row">
      <div class="col-md-12">
        <div class="content-box">
            <h3 class="content-box-header bg-danger">
                Recepción de expedientes calificados
            </h3>
            {{ Form::open(array('route' => 'recep_cc')) }}
            <div class="form-inline"> 
            <center>        
              <div class="form-group ">
                <input type="text" class="form-control" id="hr" name="hr" placeholder="HOJA DE RUTA">
                <button type="submit" class="btn btn-primary" name="action">Recepcionar</button>
              </div>
            </center>    
            </div>         
            @include('admincira.recepcion.form')            
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
<script type="text/javascript">
    //
</script>
@endif
@endsection