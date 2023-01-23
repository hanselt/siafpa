@extends('admin.layout.auth')
@section('nav')
    @include('admin.menu_admin')
@endsection
@section('content')

<div class="row">
    <div class="row col-md-6 center-margin">
        <div class="desc">
            <h1 align="center">Editar Administrador CIRA</h1>
            <hr>
            <div class="panel-body">
                <!-- Switch -->
                @if (Session::has('status'))
                    <div class="card-panel teal lighten-2">{{Session::get('status')}}</div>
                @endif
                <!-- Switch -->
                {{ Form::model($admincira, [
                        'method' => 'PATCH',
                        'action' => ['AdminAuth\AdminController@updateAdminCira',$admincira->id]
                ]) }}
                @include('admin.adminciras.forms.form')
                {{ Form::close() }}
            </div><!-- panel-body -->
        </div>
    </div>
</div>
@endsection
