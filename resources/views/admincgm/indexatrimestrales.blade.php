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
            <h3 class="content-box-header bg-danger">Administracion de acciones trimestrales</h3>
            <table class="table table-striped table-hover" id="MyTable">
                <thead>
                    <tr>
                    @if(Auth::user()->nivel==1)
                        <td><b>Coordinación</b></td>
                    @endif
                        <td><b>Monumento</b></td>
                        <td><b>Trimestre</b></td>
                        <td><b>Acción</b></td>
                        <td><b>Dimensión</b></td>
                        <td><b>Unidad de Medida</b></td>
                        <td><b>Costo Unitario</b></td>
                        <td><b>Planes</b></td>
                        <td><b>Ejecución Presupuestal</b></td>
                        @if(Auth::user()->nivel==2)
                        <td><b></b></td>
                        @endif

                    </tr>
                </thead>
                <tbody>
                @foreach($trimestrales as $trimestral)
                    <tr>
                        @if(Auth::user()->nivel==1)
                        <td><b>{{$trimestral->COOR_varNombre}}</b></td>
                        @endif
                        <td>{{$trimestral->MONU_varCategoria}}: {{ $trimestral->MONU_varNombre }}</td>            
                        <td><center>{{ $trimestral->ATRI_intTrimestre }}</center></td>
                        <td>{{ $trimestral->ACCI_intId }}: {{ $trimestral->ACCI_varDescripcion }}</td>
                        <td><center>{{ $trimestral->ATRI_douDimension }}</center></td>
                        <td>{{ $trimestral->ACCI_varUnidadMedida }}</td>
                        <td>{{ $trimestral->ATRI_douCostoUnitario }}</td>
                        <td>{{ $trimestral->ATRI_varPlanes }}</td>
                        <td>{{ $trimestral->ATRI_intEjecucionPresupuestal }}%</td>
                        @if(Auth::user()->nivel==2)
                        <td>
                            <a href="{{ route('admincgm.admin_atrimestral_edit',$trimestral->ATRI_intId) }}" alt="Edit" title="Edit" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="{{ route('admincgm.admin_aimagenes_create',$trimestral->ATRI_intId) }}" alt="Image" title="Registrar imagenes" ><i class="fa fa-file-image-o" aria-hidden="true"></i></a><!--admin_afile_create fa fa-file-pdf-o -->
                            <a href="{{ route('admincgm.admin_afile_create',$trimestral->ATRI_intId) }}" alt="Doc" title="Registrar archivo" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            <a href="#" alt="Delete" title="Delete" onclick="return confirm('Are you sure you want to delete? ');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
