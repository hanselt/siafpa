@extends('admin.layout.auth')

@section('content')

    <div class="row">

        <div class="col-xs-12">
            <h1>Panel de Administracion</h1>
        </div>

        <div class="col-xs-12 col-md-3   sidebar">
            @include('admin.menu_admin')
        </div>

        <div class="col-xs-12 col-md-9">
            <h4>Administracion de Monumentos</h4>
            <div class="desc">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a tortor et enim fermentum tempor.
                    Vestibulum gravida velit magna, a tincidunt lorem elementum in. Curabitur ac laoreet nunc. Quisque
                    volutpat porta risus, et luctus quam. Vivamus molestie vel nunc vestibulum vestibulum. Lorem ipsum
                    dolor sit amet, consectetur adipiscing elit. Sed a nunc nunc. Integer nec elit iaculis, molestie
                    mauris non, pharetra leo.</p>
                <p><b>Detalles Monumentos</b></p>
            </div>
            <div class="admin_responsive_table">
                <a href="{{ route('admin.admin_monumento_create') }}" class="btn btn-primary">Agregar Monumento</a>
                <div class="text-center">{{ $monumentos->links() }}</div>
                <table class="table" id="MyTable">
                    <thead>
                    <tr>
                        <td><b>IDss</b></td>
                        <td><b>UBIGEO</b></td>
                        <td><b>Coord.</b></td>
                        <td><b>Nombre</b></td>
                        <td><b>Categoria</b></td>
                        <td><b>Descr.</b></td>
                        <td><b>Desc. de arq.</b></td>
                        <!--<td><b>Etimol.</b></td>-->
                        <td><b>Coord.</b></td>
                        <td><b>KML</b></td>
                    <!-- <td><b>Horario</b></td> -->

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($monumentos as $monumento)
                        <tr>
                            <td>{{ $monumento->MONU_intId }}</td>
                            <td>{{ $monumento->UBIG_varID }}</td>
                            <td>{{ $monumento->COOR_intId }}</td>
                            <td>{{ $monumento->MONU_varNombre }}</td>
                            <td>{{ $monumento->MONU_varCategoria }}</td>
                            <td>{{ substr($monumento->MONU_varDescripcion, 0 , 20) }}</td>
                            <td>{{ substr($monumento->MONU_varDescripcionArquitectura, 0, 20) }}</td>
                        <!-- <td>{{ $monumento->MONU_varEtimologia }}</td>-->
                            <td>{{ $monumento->MONU_varUTMX }}/<br>{{ $monumento->MONU_varUTMY }}</td>
                            <td>ver <a target="_blank" href="{{ $monumento->MONU_varDirArchivoKML }}">kml</a></td>
                        <!--<td>{{ substr($monumento->MONU_varHorarioAtencion, 0, 10) }}</td>-->
                            <td><a href="editar" alt="Edit" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="delete" alt="Delete" title="Delete" onclick="return confirm('Are you sure you want to delete? ');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">{{ $monumentos->links() }}</div>
            </div>


        </div>


    </div>


@endsection