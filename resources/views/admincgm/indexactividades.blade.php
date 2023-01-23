@extends('layouts.default')
@section('nav')
    @if(Auth::user()->nivel==1)
        @include('admincgm.menu')
    @else
        @include('admincgm.menu2')
    @endif
@endsection
@section('content')
<div class="container mrg15T row">
    <div class="col-md-12">
        <div class="content-box table-responsive">
            <h3 class="content-box-header bg-danger">Panel de Administracion de Actividades</h3>
            @if(Auth::user()->nivel==1)
                <a href="{{ route('admin_actividad_create') }}" class="btn btn-black">Agregar Actividad</a>
            @endif
            <div class="text-center">{{ $actividades->links() }}</div>
            <table class="table table-striped table-hover" id="MyTable">
                <thead>
                <tr>
                    <td><b>Año</b></td>
                    <td><b>Código de actividad: Descripción</b></td>
                    <td><b>Unidad de Medida</b></td>
                    @if(Auth::user()->nivel==1)
                        <td><b></b></td>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($actividades as $actividad)
                    <tr>
                        <td>{{ $actividad->ACTI_intYear }}</td>                                                        
                        <td><a href="{{ route('admin_tareas_buscar', $actividad->ACTI_intId ) }}" style="color: #23282e">{{ $actividad->ACTI_varDescripcion }}</a></td>
                        <td>{{ $actividad->ACTI_varUnidadMedida }}</td>
                        @if(Auth::user()->nivel==1)
                        <td><a href="{{ route('admin_actividad_edit', $actividad->ACTI_intId ) }}" alt="Edit" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="" alt="Delete" title="Delete" onclick="return confirm('Are you sure you want to delete? ');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">{{ $actividades->links() }}</div>
        </div>
    </div>
</div>
@endsection