@extends('layouts.default')
@section('nav')
    @if(Auth::user()->nivel==1)
    @include('admincira.menu')
    @elseif(Auth::user()->nivel==2)
    @include('admincira.menu2')
    @elseif(Auth::user()->nivel==3)
    @include('admincira.menu3')
    @elseif(Auth::user()->nivel==4)
    @include('admincira.menu4')
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-12">
			@include('pmas.partials.table')
		</div>
	</div>
@endsection