@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-3">
            @include('admin.menu_admin')
        </div>
        <div class="col-md-9">
            <h3>Editar: </h3>
            <!-- Switch -->
            @if (Session::has('status'))
                <div class="card-panel teal lighten-2">{{Session::get('status')}}</div>
            @endif
        <!-- Switch -->
            {{ Form::model($coordinacion, [
                    'method' => 'PATCH',
                    'action' => ['AdminAuth\AdminController@updateCoordinacion',$coordinacion->COOR_intId]
            ]) }}
            @include('admin.gen_coordinacion.forms.partials.form')
            {{ Form::close() }}
        </div>
    </div>

@endsection
