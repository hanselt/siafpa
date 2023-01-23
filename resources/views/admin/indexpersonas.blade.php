@extends('admin.layout.auth')
@section('nav') 
    @if(Auth::user()->nivel==1)
    @include('admin.menu_admin')
    @elseif(Auth::user()->nivel==2)
    @include('admin.menu_afpa')
    @endif
@endsection
@section('content')
<div class="row">
    <div class="row col-sm-11 col-xs-12 center-margin">
        <div class="content-box table-responsive">
            <br>
            <h3 class="content-box-header bg-danger" style="background-color: #cf4436" id="tittle">Área Funcional de Patrimonio Arqueológico<br>
            Lista de funcionarios
            </h3>
            <br>
            <a href="{{ route('admin.admin_persona_create') }}" class="btn btn-black">Agregar Funcionario</a>
            <br>
            <br>
            <table class="table" id="MyTable">
                <thead>
                <tr>
                    <td><b>DNI</b></td>
                    <td><b>RNA</b></td>
                    <td><b>TIPO</b></td>
                    <td><b>CARGO</b></td>
                    <td><b>Apellidos y Nombres</b></td>
                    <td><b>Grado Académico</b></td>
                    <td><b>Acciones</b></td>

                </tr>
                </thead>
                <tbody>
                @foreach($personas as $persona)
                    <tr>
                        <td><p class="toExport">{{ $persona->PERS_varDNI }}</p></td>
                        <td><p class="toExport">{{ $persona->PERS_varRna }}</p></td>
                        <td><p class="toExport">{{ $persona->PERS_varTipo }}</p></td>
                        <td><p class="toExport">{{ $persona->PERS_varCargo }}</p></td>
                        <td><p class="toExport">{{ $persona->PERS_varApPaterno }} {{ $persona-> PERS_varApMaterno }} {{ $persona->PERS_varNombres }} </td>
                        <td><p class="toExport">{{ $persona->PERS_varGradoAcademico }}</p></td>
                        <td>
                            <p style="display: none;" class="toExport">Insertar imagen/Editar</p>
                            <a href="{{ route('admin.admin_persona_imagen', $persona->PERS_varDNI ) }}" alt="Image" title="Cambiar Imagen" ><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                            <a href="{{ route('admin.admin_persona_edit', $persona->PERS_varDNI ) }}" alt="Edit" title="Editar" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection