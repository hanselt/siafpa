@extends('admin.layout.auth')
@section('nav')
    @include('admin.menu_admin')
@endsection
@section('content')
<div class="row">
    <div class="row col-sm-11 col-xs-12 center-margin">
        <br>
                <h3 class="content-box-header bg-danger" style="background-color: #cf4436" id="tittle">Área Funcional de Patrimonio Arqueológico<br>
                Lista administradores Certificaciones
                </h3>
        <br>
        <a href="{{ route('admin.admin_cira_create') }}" class="btn btn-primary">Agregar Administrador CIRAs</a>
        <br>
        <br>
        <table class="table" id="MyTable">
            <thead>
            <tr>
                <td><b>ID</b></td>
                <td><b>Nombres</b></td>
                <td><b>Email</b></td>
                <td><b>Cargo</b></td>
                <td><b>Nivel</b></td>
                <td><b>Ultima Actualización</b></td>
                <td><b></b></td>

            </tr>
            </thead>
            <tbody>
            @foreach($adminciras as $admincira)
                <tr>
                    <td><p class="toExport">{{ $admincira->id }}</p></td>
                    <td><p class="toExport">{{ $admincira->PERS_varNombres }}, {{ $admincira->PERS_varApPaterno }} {{ $admincira->PERS_varApMaterno }}</p></td>
                    <td><p class="toExport">{{ $admincira->email }}</p></td>
                    <td><p class="toExport">{{ $admincira->PERS_varCargo }}</p></td>
                    <td><p class="toExport">{{ $admincira->nivel }}</p></td>
                    <td><p class="toExport">{{ substr($admincira->updated_at,0,10)}}</p></td>
                    <td><a href="{{ route('admin.admin_edit_cira', $admincira->id) }}" alt="Edit" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a href="{{ route('admin.admin_delete_cira', $admincira->id) }}" alt="Delete" title="Delete" onclick="return confirm('¿Estas seguro que quieres eliminarlo?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                    
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
