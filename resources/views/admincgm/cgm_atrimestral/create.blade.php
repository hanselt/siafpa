@extends('layouts.default')
@section('nav')
    @include('admincgm.menu2')
@endsection
@section('content')
    @if(Auth::user()->nivel==2)
        <div class="container mrg15T row">
            <div class="col-md-12">
                <div class="content-box" style="background-color:#F2F7F8">
                    <h3 class="content-box-header bg-danger">
                        Agregar Acción Trimestral
                    </h3>
                    <div class="form-group">
                        @if(isset($coordinacion))
                        <p style="color: #2e353d"><big><strong>{{$coordinacion->COOR_varNombre}}</strong></big>, {{$coordinacion->COOR_varResenaHistorica}} </p>
                        @endif
                    </div>

                    {{ Form::open(array('route' => 'admincgm.admin_atrimestral_store')) }}
                        @include('admincgm.cgm_atrimestral.forms.partials.form')
                        <div class="form-group">
                          <button class="btn btn-black" type="submit" name="action" id="submit-all"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
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