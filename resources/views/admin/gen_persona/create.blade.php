@extends('layouts.default')
@section('nav')
    @include('admin.menu_admin')
@endsection
@section('content')

<div class="row">
    <div class="row col-sm-8 col-xs-12 center-margin">
        <div class="desc">
            <h1>Agregar Funcionario</h1>
            <hr>
            {{ Form::open(array('route' => 'admin.admin_persona_store')) }}            
            @include('admin.gen_persona.forms.partials.form')
            <div class="form-group">
              <button class="btn btn-black" type="submit" name="action" id="submit-all"><i class="glyphicon glyphicon-plus"></i> Agregar</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
