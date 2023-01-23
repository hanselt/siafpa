@extends('templates.cira.layout')
@section('content')

  <!--13 nov-->  
    <div class="container mrg15T row">
      <div class="col-md-12">
        <div class="content-box">
            <h3 class="content-box-header bg-danger">
                Ingreso de Antecedente
            </h3>
            {{ Form::open(array('url' => 'admincira/crear/ciraantecedente','method','POST')) }}
            @include('admincira.cira.forms.partials.formant')
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="action">Guardar</button>
            </div>
            {{ Form::close() }}


        </div>
      </div>
    </div>

@endsection
