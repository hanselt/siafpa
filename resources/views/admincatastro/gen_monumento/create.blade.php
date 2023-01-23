@extends('layouts.default')
@section('nav')
  @include('admincatastro.menu')
@endsection
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box" style="background-color:#F2F7F8">
            <h3 class="content-box-header bg-danger">
                Registro de Monumentos
            </h3>

            <div class="form-group">Catastro tiene a su cargo los aspectos técnicos normativos para la gestión del Patrimonio Arqueológico Histórico Artístico (preinca, inca y colonial) de la región del Cusco.
            </div>

            {{ Form::open(array('route' => 'admin_monumento_create')) }}
            @include('admincatastro.gen_monumento.forms.partials.form')
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="action">Guardar</button>
            </div>
            {{ Form::close() }}


        </div>
    </div>
</div>

@endsection
