@extends('admin.layout.auth')
@section('nav')
    @include('admin.menu_admin')
@endsection
@section('content')

    <div class="row">
        <div class="row col-sm-11 col-xs-12 center-margin">
            <div class="desc">
                <br>
                <h3 class="content-box-header bg-danger" style="background-color: #cf4436" id="tittle">Área Funcional de Patrimonio Arqueológico<br>
                Lista administradores Gestión de Monumentos
                </h3>
                <br>
            </div>
            <div class="admin_responsive_table">
                <a href="{{ route('admin.admin_cgm_create') }}" class="btn btn-primary">Agregar Administrador CGM</a>
                <br>
                <br>
                <table class="table" id="MyTable">
                    <thead>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Nombre</b></td>
                        <td><b>Email</b></td>
                        <td><b>Nivel</b></td>
                        <td><b>DNI</b></td>
                        <td><b>Ultima actualización</b></td>
                        <td><b></b></td>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admincgms as $admincgm)
                        <tr>
                            <td><p class="toExport">{{ $admincgm->id }}</p></td>
                            <td><p class="toExport">{{ $admincgm->PERS_varNombres }}, {{ $admincgm->PERS_varApPaterno }} {{ $admincgm->PERS_varApMaterno }}</p></td>
                            <td><p class="toExport">{{ $admincgm->email }}</p></td>
                            <td><p class="toExport">{{ $admincgm->nivel }}</p></td>
                            <td><p class="toExport">{{ $admincgm->PERS_varDNI }}</p></td>
                            <td><p class="toExport">{{ substr($admincgm->updated_at,0,10) }}</p></td>
                            <td><a href="{{ route('admin.admin_edit_cgm', $admincgm->id) }}" alt="Edit" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="{{ route('admin.admin_delete_cgm', $admincgm->id) }}" alt="Delete" title="Delete" onclick="return confirm('¿Estas seguro que quieres eliminarlo?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
@endsection
