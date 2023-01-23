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
            <h3 class="content-box-header bg-danger">Panel de Administracion de Monumentos</h3>
            <div class="desc">
                <p>Recuerda poner la URL del video correcta, esta URL:<a>https://www.youtube.com/</a><a style="color: #ea4100">watch?v=</a><a>KPGlLvwdu0o</a>
                no es correcta. Debe ser agregada de la siguiente manera: <a>https://www.youtube.com/</a><a style="color: #ea4100">embed/</a><a>KPGlLvwdu0o</a> cambiar <strong><a style="color: #ea4100">watch?v=</a></strong> por <strong><a style="color: #ea4100">embed/</a></strong>.</p>
                <p><b>Detalles de Monumentos</b></p>
            </div>
            <table class="table table-striped table-hover" id="MyTable">
                <thead>
                <tr>
                    @if(Auth::user()->nivel==1)
                        <td><b>Coordinación</b></td>
                    @endif
                    <td><b>Categoría</b></td>
                    <td><b>Nombre</b></td>
                    <td><b>Descripción</b></td>
                    <td><b>Descripción de su Arquitectura</b></td>
                    <td><b>Etimología</b></td>
                    <td><b>Atención</b></td>
                    <td><b>URL del Video</b></td>
                    @if(Auth::user()->nivel==2)
                    <td><b></b></td>
                    @endif
                <!-- <td><b>Horario</b></td> -->

                </tr>
                </thead>
                <tbody>
                @foreach($monumentos as $monumento)
                    <tr>
                        @if(Auth::user()->nivel==1)
                            <td>{{ $monumento->COOR_varNombre }}</td>
                        @endif
                        <td>{{ $monumento->MONU_varCategoria }}</td>
                        <td>{{ $monumento->MONU_varNombre }}</td>
                        <td>{{ (strlen($monumento->MONU_varDescripcion)>150)?substr($monumento->MONU_varDescripcion,0,150).'...':$monumento->MONU_varDescripcion }}</td>
                        <td>{{ (strlen($monumento->MONU_varDescripcionArquitectura)>150)?substr($monumento->MONU_varDescripcionArquitectura,0,150).'...':$monumento->MONU_varDescripcionArquitectura }}</td>
                        <td>{{ (strlen($monumento->MONU_varEtimologia)>150)?substr($monumento->MONU_varEtimologia,0,150).'...':$monumento->MONU_varEtimologia }}</td>
                        <td>{{ $monumento->MONU_varHorarioAtencion }}</td>
                        <td>{{ $monumento->MONU_varDirVideo }}</td>
                        @if(Auth::user()->nivel==2)
                        <td>
                                <a href="{{ route('admincgm.admin_monumento_edit',$monumento->MONU_intId) }}" alt="Editar" title="Editar" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="{{ route('admincgm.admin_archivos_create',$monumento->MONU_intId) }}" alt="Editar" title="Agregar Imagenes" ><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                                <a href="{{ route('admincgm.admin_imagen_edit',$monumento->MONU_intId)}}" alt="Editar" title="Editar Imagenes" ><i class="fa fa-area-chart" aria-hidden="true"></i></a>
                        </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection