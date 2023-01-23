@extends('layouts.default')
@section('nav')
    @include('layouts/nav')
@endsection
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="cta-box small-padding bg-black">
                <p class="cta-text">Escoge tu perfil de inicio de sesión.</p>
            </div>

            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="icon-box icon-box-offset-large bg-black inverse icon-boxed">
                <a href="{{ url('admin/login') }}"><i class="icon-large glyph-icon bg-red icon-user" style="background-color: #e74c3c"></i></a>
                <a href="{{ url('admin/login') }}"><h3 class="icon-title">ADMINISTRADOR</h3></a>
                <p class="icon-content">Área Funcional de Patrimonio Arqueológico</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="icon-box icon-box-offset-large bg-black inverse icon-boxed">
                <a href="{{ url('admincgm/login') }}"><i class="icon-large glyph-icon bg-red" style="background-color: #e74c3c"><img src="{{ URL::asset('img/icon1.png') }}"></i></a>
                <a href="{{ url('admincgm/login') }}"><h3 class="icon-title">GESTIÓN DE MONUMENTOS</h3></a>
                <p class="icon-content">El administrador de gestión de monumentos tiene dos niveles y registra labores de mantenimiento, preservacion y prevencion</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="icon-box icon-box-offset-large inverse bg-black icon-boxed">
                <a href="{{ url('admincira/login') }}"><i class="icon-large glyph-icon bg-red" style="background-color: #e74c3c"><img src="{{ URL::asset('img/icon2.png') }}"></i></a>
                <a href="{{ url('admincira/login') }}"><h3 class="icon-title">CERTIFICACIONES</h3></a>
                <p class="icon-content">El Administrador de la sección de Certificaciones registra los Ciras y Pmas</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="icon-box icon-box-offset-large inverse bg-black icon-boxed">
                <a href="{{ url('admincatastro/login') }}"><i class="icon-large glyph-icon bg-red" style="background-color: #e74c3c"><img src="{{ URL::asset('img/icon3.png') }}"></i></a>
                <a href="{{ url('admincatastro/login') }}"><h3 class="icon-title">CATASTRO Y SANEAMIENTO FISICO LEGAL</h3></a>
                <p class="icon-content">El Administrador de la sección de Catastro registra los bienes inmuebles</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="icon-box icon-box-offset-large inverse bg-black icon-boxed">
                <a href="{{ url('admincalificacion/login') }}"><i class="icon-large glyph-icon bg-red" style="background-color: #e74c3c"><img src="{{ URL::asset('img/iconcia.png') }}"></i></a>
                <a href="{{ url('admincalificacion/login') }}"><h3 class="icon-title">CALIFICACIONES DE INTERVENCIONES ARQUEOLÓGICAS</h3></a>
                <p class="icon-content">El Administrador de Calificaciones e intervenciones Arqueologicas registra los Pias,Peas,Prias</p>
            </div>
        </div>
    </div>
        
<br/><br/>

@endsection