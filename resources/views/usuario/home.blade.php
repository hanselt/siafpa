@extends('layouts.default')
@section('nav')
    @include('layouts/nav')
@endsection
@section('content')
<div class="hero-box " style="background:url('{{ URL::asset('img/maras.jpg') }}'); background-repeat: no-repeat; background-attachment: fixed; background-position: center; background-size: cover;">
    <div class="container">
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Panel de Administracion</h1>
        <p class="hero-text wow bounceInUp" data-wow-duration="0.9s" data-wow-delay="0.2s">Usuarios</p>
    </div>
    <div class="hero-overlay hero-light"></div>
</div>
@endsection