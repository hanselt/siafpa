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
            <h3 class="content-box-header bg-danger">Panel de Administracion de Acciones</h3>
            @if(Auth::user()->nivel==1)
                <a href="{{ route('admin_accion_create') }}" class="btn btn-black">Agregar Acciones</a>
            @endif
            <table class="table table-striped table-hover" id="MyTable">
                <thead>
                    <tr>
                        <td><b>Código<br> de tarea</b></td>
                        <td><b>Código de Acción: Descripción</b></td>
                        <td><b>Unidad de Medida</b></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach($acciones as $accion)
                    <tr>
                        <td>{{ $accion->TARE_intId }}</td>                                                        
                        <td>{{ $accion->ACCI_varDescripcion }}</td>
                        <td>{{ $accion->ACCI_varUnidadMedida }}</td>
                        <td>
                        @if(Auth::user()->nivel==1)
                            <a href="{{ route('admin_accion_edit', $accion->ACCI_intId ) }}" alt="Edit" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="" alt="Delete" title="Delete" onclick="return confirm('Are you sure you want to delete? ');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        @else                            
                            <a href="{{ route('admin_atrimestral_create',$accion->ACCI_intId) }}" alt="Agregar" title="Agregar Acción Trimestral" ><i class="fa fa-camera-retro" aria-hidden="true"></i></a>
                        @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection