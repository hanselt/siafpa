@extends('layouts.default')
@section('nav')
    @if(Auth::user()->nivel==1)
    @include('admincira.menu')
    @elseif(Auth::user()->nivel==2)
    @include('admincira.menu2')
    @elseif(Auth::user()->nivel==3)
    @include('admincira.menu3')
    @elseif(Auth::user()->nivel==4)
    @include('admincira.menu4')
    @endif
@endsection
@section('content')

<div class="hero-box poly-bg-5 hero-box-smaller font-inverse" style="background:url('{{ URL::asset('img/poly-bg/poly-bg-5.jpg') }}')">
            <div class="container">
                <h2 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Advertencia</h2>
                <p class="hero-text wow bounceInUp" data-wow-duration="0.9s" data-wow-delay="0.2s">Acceso Restringido.</p>
            </div>
</div>

@endsection
