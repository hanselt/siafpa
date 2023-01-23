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
            <h3 class="content-box-header bg-danger">Panel de Administracion de Tareas</h3>
            @if(Auth::user()->nivel==1)
                <a href="{{ route('admin_tarea_create') }}" class="btn btn-black">Agregar Tarea</a>
            @endif
            <table class="table table-striped table-hover" id="MyTable">
                <thead>
                    <tr>
                        <td><b>Código de<br>Actividad</b></td>
                        <td><b>Código de tarea: Descripción</b></td>
                        <td><b>Unidad de Medida sA</b></td>
                        @if(Auth::user()->nivel==1)
                        <td><b></b></td>
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach($tareas as $tarea)
                    <tr>
                        <td>{{ $tarea->ACTI_intId }}</td>
                        <td><a href="{{ route('admin_acciones_buscar', $tarea->TARE_intId ) }}" style="color: #23282e">{{ $tarea->TARE_varDescripcion }}</a></td>
                        <td>{{ $tarea->TARE_varUnidadMedida }}</td>
                        @if(Auth::user()->nivel==1)
                        <td><a href="{{ route('admin_tarea_edit', $tarea->TARE_intId ) }}" alt="Edit" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="" alt="Delete" title="Delete" onclick="return confirm('Are you sure you want to delete? ');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection