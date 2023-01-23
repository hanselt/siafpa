@extends('layouts.default')
@section('nav')
    @include('admincgm.menu')
@endsection
@section('content')
    @if(Auth::user()->nivel==1)
        <div class="container mrg15T row">
            <div class="col-md-12">
                <div class="content-box">
                    <h3 class="content-box-header bg-danger">Editar</h3>
                    <!-- Switch -->
                    @if (Session::has('status'))
                        <div class="card-panel teal lighten-2">{{Session::get('status')}}</div>
                    @endif
                    <!-- Switch -->
                    {{ Form::model($actividad, [
                            'method' => 'PATCH',
                            'action' => ['Cgm_actividadController@update',$actividad->ACCI_intId]
                    ]) }}
                        @include('admincgm.cgm_actividad.forms.partials.form')
                        <div class="form-group">
                            <button class="btn btn-black" type="submit" name="action" id="submit-all"><i class="glyphicon glyphicon-pencil"></i> Modificar</button>
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
