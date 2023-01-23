@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-3">
            @include('admin.menu_admin')
        </div>
        <div class="col-md-9">

            <h1>Crear Monumento</h1>

            <div class="form-group">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed est augue, sagittis et
                nibh sit amet,
                consequat mollis ipsum. Cras sit amet ligula at felis semper dapibus eget eget tortor.
            </div>

            {{ Form::open(array('route' => 'admin.admin_                                                                                                ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            monumento_store')) }}
            @include('admin.gen_monumento.forms.partials.form')
            {{ Form::close() }}

        </div>


    </div>

@endsection
