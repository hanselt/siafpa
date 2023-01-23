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
                Lista de administradores AFPA
                </h3>
                <br>
            </div>
            <div class="admin_responsive_table">
                <a href="{{ route('admin.admin_afpa_create') }}" class="btn btn-primary">Agregar Administrador AFPA</a>
                <br>
                
                <br>
                <table class="table" id="MyTable">
                    @if(Session::has('msg'))
                    <div class="red-text text-darken-2" align="right"><i class="fa fa-exclamation-triangle"
                                                           aria-hidden="true"></i> {{Session::get('msg')}}</div>
                    @endif
                    <thead>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Nombre</b></td>
                        <td><b>Email</b></td>
                        <td><b>Nivel</b></td>
                        <td><b>DNI</b></td>
                        <td><b>Ultima actualización</b></td>
                        <td><b>Acción</b></td>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($adminafpas as $admin)
                        <tr>
                            <td><p class="toExport">{{ $admin->id }}</p></td>
                            <td><p class="toExport">{{ $admin->PERS_varNombres }}, {{ $admin->PERS_varApPaterno }} {{ $admin->PERS_varApMaterno }}</p></td>
                            <td><p class="toExport">{{ $admin->email }}</p></td>
                            <td><p class="toExport">{{ $admin->nivel }}</p></td>
                            <td><p class="toExport">{{ $admin->PERS_varDNI }}</p></td>
                            <td><p class="toExport">{{ substr($admin->updated_at,0,10) }}</p></td>
                            <td>
                                <p style="display: none;" class="toExport">Editar/Eliminar</p>
                                <a href="{{ route('admin.admin_edit_afpa', $admin->id) }}" alt="Edit" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="{{ route('admin.admin_delete_afpa', $admin->id) }}" alt="Delete" title="Delete" onclick="return confirm('¿Estas seguro que quieres eliminarlo?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
@endsection
