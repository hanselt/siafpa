@extends('layouts.default')
@section('nav')
    @if(Auth::user()->nivel==1)
        @include('admincgm.menu')
    @else
        @include('admincgm.menu2')
    @endif
@endsection
@section('content')
<div class="hero-box " style="background:url('{{ URL::asset('img/sacsayhuaman.jpg') }}'); background-repeat: no-repeat; background-attachment: fixed; background-position: center; background-size: cover;">
    <div class="container">
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Panel de Administración</h1>
        <p class="hero-text wow bounceInUp" data-wow-duration="0.9s" data-wow-delay="0.2s">Gestión de Monumentos</p>
    </div>
    <div class="hero-overlay hero-light"></div>
</div>
@endsection
