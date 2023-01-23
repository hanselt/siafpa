@extends('layouts.default')
@section('nav')
  @include('admincatastro.menu')
@endsection
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box" style="background-color:#F2F7F8">
            <h3 class="content-box-header bg-danger">
                Editar:
            </h3>

            <!-- Switch -->
            @if (Session::has('status'))
                <div class="card-panel teal lighten-2">{{Session::get('status')}}</div>
            @endif
        <!-- Switch -->
            @foreach($monumentos as $monumento)
            {{ Form::model($monumento, [
                    'method' => 'PATCH',
                    'action' => ['Gen_monumentoController@update',$monumento->MONU_intId]
            ]) }}
            @include('admincatastro.gen_monumento.forms.partials.form')
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="action">Editar</button>
            </div>
            {{ Form::close() }}
            @endforeach

        </div>
    </div>
</div>
@endsection
