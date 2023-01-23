@extends('layouts.default')
@section('nav')
    @if(Auth::user()->nivel==1)
    @include('admincalificacion.menu')
    @elseif(Auth::user()->nivel==2)
    @include('admincalificacion.menu2')
    @elseif(Auth::user()->nivel==3)
    @include('admincalificacion.menu3')
    @elseif(Auth::user()->nivel==4)
    @include('admincalificacion.menu4')
    @endif
@endsection
@section('content')
@if(Auth::user()->nivel==2)
  <!--13 nov-->  
    <div class="container mrg15T row">
      <div class="col-md-12">
        <div class="content-box" style="background-color:#f5f8fa">
            <h3 class="content-box-header bg-danger" style="background-color:#cf4436">
                Recepción de expedientes calificados
            </h3>
            {{ Form::open(array('route' => 'admincalificacion.recep_ccia')) }}
            <div class="form-inline"> 
            <center>        
              <div class="form-group ">
                <input type="text" class="form-control" id="hr" name="hr" placeholder="HOJA DE RUTA">
                <button type="submit" class="btn btn-primary" name="action">Recepcionar</button>
              </div>
            </center>    
            </div>         
            @include('admincalificacion.recepcion.form')            
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