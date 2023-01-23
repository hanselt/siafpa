@extends('layouts.default')
@section('nav')
    @include('admincgm.menu2')
@endsection
@section('content')
    @if(Auth::user()->nivel==2)
        <div class="container mrg15T row">
            <div class="col-md-12">
                <div class="content-box" style="background-color:#F2F7F8">
                    <h3 class="content-box-header bg-danger">Editar Imagenes</h3>
                    <p>{{$monumento->MONU_varCategoria}} {{$monumento->MONU_varNombre}} .- {{$monumento->MONU_varDescripcion}}</p>

                    @foreach($imagenes as $imagen)
						@if($imagen->IMAG_booEstado>0)
						<div class="col-md-4 portfolio-item" style="border-style: outset;" >
							<center>
							<img class="img-responsive" src="{{$imagen->IMAG_varDirImagen}}" alt="" style="max-width: 100%;max-height: 150px">
							<a href="/admincgm/monumento/imagen/{{$imagen->IMAG_intId}}" alt="Editar" title="Eliminar Imagen" ><i class="fa fa-times fa-2x" aria-hidden="true"></i></a>					
							</center>

						</div>

						@endif
					@endforeach
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