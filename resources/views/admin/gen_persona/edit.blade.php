@extends('layouts.default')
@section('nav')
    @include('admin.menu_admin')
@endsection
@section('content')
<div class="row">
    <div class="row col-sm-10 col-xs-12 center-margin">
        <h1>
            Editar Funcionario
        </h1>
        <!-- Switch -->
        @if (Session::has('status'))
            <div class="card-panel teal lighten-2">{{Session::get('status')}}</div>
        @endif
        <!-- Switch -->
        {{ Form::model($persona, [
                'route' => ['admin.admin_persona_update',$persona->PERS_varDNI],
                'method' => 'PATCH'
        ]) }}
        @include('admin.gen_persona.forms.partials.form')
        <div class="form-group">
           <button class="btn btn-black" type="submit" name="action" id="submit-all"><i class="glyphicon glyphicon-pencil"></i> Editar</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
