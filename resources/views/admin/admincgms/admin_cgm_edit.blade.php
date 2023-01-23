@extends('admin.layout.auth')
@section('nav')
    @include('admin.menu_admin')
@endsection
@section('content')

    <div class="row">
        <div class="row col-sm-8 col-xs-12 center-margin">
            <div class="desc">
                <h1>Editar Administrador CGM</h1>
                <hr>
                <!-- Switch -->
                @if (Session::has('status'))
                    <div class="card-panel teal lighten-2">{{Session::get('status')}}</div>
                @endif
            <!-- Switch -->
                {{ Form::model($admincgm, [
                        'method' => 'PATCH',
                        'action' => ['AdminAuth\AdminController@updateAdminCgm',$admincgm->id]
                ]) }}
                @include('admin.admincgms.forms.form')
                {{ Form::close() }}
            </div>

        </div>
    </div>
@endsection
