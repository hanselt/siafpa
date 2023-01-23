@extends('templates.cira.layout')
@section('content')

<div class="hero-box hero-box font-inverse" data-top-bottom="background-position: 50% 0px;" data-bottom-top="background-position: 50% -600px;" style="background:url('{{ URL::asset('img/raqchi.jpg') }}'); background-repeat: no-repeat; background-attachment: fixed; background-position: center; background-size: cover;">
    <div class="container">
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Panel de Administración</h1>
        <p class="hero-text wow bounceInUp" data-wow-duration="0.9s" data-wow-delay="0.2s">Certificaciones</p>
    </div>
    <div class="hero-overlay bg-black"></div>
</div>
@if(Auth::user()->nivel==1)
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="icon-box icon-box-offset-large bg-black inverse icon-boxed">
                <a href="{{ URL::asset('archivos/general/documentos/CIRA.xlsx') }}" target="_blank"><i class="icon-large glyph-icon bg-red icon-file-excel-o" style="background-color: #e74c3c"></i></a>
                <a href="{{ URL::asset('archivos/general/documentos/CIRA.xlsx') }}" target="_blank"><h3 class="icon-title">Descargar Excel CIRA</h3></a>
                <p class="icon-content">Descargue el formato de registro excel en blanco, para hacer un nuevo ingreso de CIRAs.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="icon-box icon-box-offset-large inverse bg-black icon-boxed">
                <a href="{{ URL::asset('archivos/general/documentos/PMA.xlsx') }}" target="_blank"><i class="icon-large glyph-icon bg-red icon-file-excel-o" style="background-color: #e74c3c"></i></a>
                <a href="{{ URL::asset('archivos/general/documentos/PMA.xlsx') }}" target="_blank"><h3 class="icon-title">Descargar Excel PMA</h3></a>
                <p class="icon-content">Descargue el formato de registro excel en blanco, para hacer un nuevo ingreso de PMAs</p>
            </div>
        </div>
    </div>
</div>

<br/><br/>
@endif
@endsection
