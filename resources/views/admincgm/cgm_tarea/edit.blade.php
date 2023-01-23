@extends('layouts.default')
@section('nav')
    @include('admincgm.menu')
@endsection
@section('content')
@if(Auth::user()->nivel==1)
    <div class="container mrg15T row">
        
        <div class="col-md-12">
            <h3 class="content-box-header bg-danger">Editar: </h3>
            <!-- Switch -->
            @if (Session::has('status'))
                <div class="card-panel teal lighten-2">{{Session::get('status')}}</div>
            @endif
        <!-- Switch -->
            {{ Form::model($tarea, [
                    'method' => 'PATCH',
                    'action' => ['Cgm_tareaController@update',$tarea->TARE_intId]
            ]) }}
            @include('admincgm.cgm_tarea.forms.partials.form')
            <div class="form-group">
              <button class="btn btn-primary" type="submit" name="action" id="submit-all">
               Modificar
              </button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@else
<div class="row">
   <h1 style="color: #ea4100" align="center">Acceso Restringido</h1>
</div>
@endif
@endsection
