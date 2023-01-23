@extends('admin.layout.auth')
@section('nav')
    @include('admin.menu_admin')
@endsection
@section('content')

    <div class="row">
        <div class="row col-md-6 col-sm-6 col-xs-12 center-margin">
            <div class="desc">
                <h1>Editar Administrador Catastro</h1>
                <hr>
                <!-- Switch -->
                @if (Session::has('status'))
                    <div class="card-panel teal lighten-2">{{Session::get('status')}}</div>
                @endif
            <!-- Switch -->
                {{ Form::model($admincatastro, [
                        'method' => 'PATCH',
                        'action' => ['AdminAuth\AdminController@updateAdminCatastro',$admincatastro->id]
                ]) }}
                @include('admin.admincatastros.forms.form')
                {{ Form::close() }}
            </div>

        </div>
    </div>
@endsection
