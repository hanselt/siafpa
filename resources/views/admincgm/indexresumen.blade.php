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
            <table class="table" id="MyTable" name="MyTable">
                <thead>
                    <tr>                    
                        <td><b>Acción</b></td>
                        <td><b>1° Trimestre</b></td>
                        <td><b>2° Trimestre</b></td>
                        <td><b>3° Trimestre</b></td>
                        <td><b>4° Trimestre</b></td>
                    </tr>
                </thead>
            <tbody id="tbody">
            </tbody>
            <script type="text/javascript">
                var Inicio=true;
                var DescripA="";
                var t=[0,0,0,0];
                var Text="";
                var body=document.getElementById('tbody');
                
            </script>
            @foreach($resumenes as $resumen)
                @if($resumenes->last()===$resumen)
                    <script type="text/javascript">
                    if (DescripA!='{{$resumen->ACCI_varDescripcion}}') {
                                var hilera = document.createElement("tr");
                                var celda = document.createElement("td");
                                var textoCelda = document.createTextNode(DescripA);
                                var celda2 = document.createElement("td");
                                var textoCelda2 = document.createTextNode(t[0]);
                                var celda3 = document.createElement("td");
                                var textoCelda3 = document.createTextNode(t[1]);
                                var celda4 = document.createElement("td");
                                var textoCelda4 = document.createTextNode(t[2]);
                                var celda5 = document.createElement("td");
                                var textoCelda5 = document.createTextNode(t[3]);
                                celda.appendChild(textoCelda);
                                celda2.appendChild(textoCelda2);
                                celda3.appendChild(textoCelda3);
                                celda4.appendChild(textoCelda4);
                                celda5.appendChild(textoCelda5);
                                hilera.appendChild(celda);
                                hilera.appendChild(celda2);
                                hilera.appendChild(celda3);
                                hilera.appendChild(celda4);
                                hilera.appendChild(celda5);
                                body.appendChild(hilera);
                        DescripA='{{$resumen->ACCI_varDescripcion}}';
                        var ent={{$resumen->ATRI_intTrimestre}};
                        ent=ent-1;
                        t=[0,0,0,0];
                        t[ent]={{$resumen->Trimestre}};
                                var hilera = document.createElement("tr");
                                var celda = document.createElement("td");
                                var textoCelda = document.createTextNode(DescripA);
                                var celda2 = document.createElement("td");
                                var textoCelda2 = document.createTextNode(t[0]);
                                var celda3 = document.createElement("td");
                                var textoCelda3 = document.createTextNode(t[1]);
                                var celda4 = document.createElement("td");
                                var textoCelda4 = document.createTextNode(t[2]);
                                var celda5 = document.createElement("td");
                                var textoCelda5 = document.createTextNode(t[3]);
                                celda.appendChild(textoCelda);
                                celda2.appendChild(textoCelda2);
                                celda3.appendChild(textoCelda3);
                                celda4.appendChild(textoCelda4);
                                celda5.appendChild(textoCelda5);
                                hilera.appendChild(celda);
                                hilera.appendChild(celda2);
                                hilera.appendChild(celda3);
                                hilera.appendChild(celda4);
                                hilera.appendChild(celda5);
                                body.appendChild(hilera);
                    }
                    else{
                            var ent={{$resumen->ATRI_intTrimestre}};
                            ent=ent-1;
                            t[ent]={{$resumen->Trimestre}};
                                var hilera = document.createElement("tr");
                                var celda = document.createElement("td");
                                var textoCelda = document.createTextNode(DescripA);
                                var celda2 = document.createElement("td");
                                var textoCelda2 = document.createTextNode(t[0]);
                                var celda3 = document.createElement("td");
                                var textoCelda3 = document.createTextNode(t[1]);
                                var celda4 = document.createElement("td");
                                var textoCelda4 = document.createTextNode(t[2]);
                                var celda5 = document.createElement("td");
                                var textoCelda5 = document.createTextNode(t[3]);
                                celda.appendChild(textoCelda);
                                celda2.appendChild(textoCelda2);
                                celda3.appendChild(textoCelda3);
                                celda4.appendChild(textoCelda4);
                                celda5.appendChild(textoCelda5);
                                hilera.appendChild(celda);
                                hilera.appendChild(celda2);
                                hilera.appendChild(celda3);
                                hilera.appendChild(celda4);
                                hilera.appendChild(celda5);
                                body.appendChild(hilera);
                            }
                    </script>
                @else
                    <script type="text/javascript">
                        
                        
                        if (Inicio) {
                            DescripA='{{$resumen->ACCI_varDescripcion}}';
                            var ent={{$resumen->ATRI_intTrimestre}};
                            ent=ent-1;
                            t[ent]={{$resumen->Trimestre}};
                            Inicio=false;
                        }
                        else
                        {
                            
                            if (DescripA=='{{$resumen->ACCI_varDescripcion}}') {
                                var ent2={{$resumen->ATRI_intTrimestre}};
                                ent2=ent2-1;
                                t[ent2]={{$resumen->Trimestre}};
                                Inicio=false;
                            }
                            else{
                                var hilera = document.createElement("tr");
                                var celda = document.createElement("td");
                                var textoCelda = document.createTextNode(DescripA);
                                var celda2 = document.createElement("td");
                                var textoCelda2 = document.createTextNode(t[0]);
                                var celda3 = document.createElement("td");
                                var textoCelda3 = document.createTextNode(t[1]);
                                var celda4 = document.createElement("td");
                                var textoCelda4 = document.createTextNode(t[2]);
                                var celda5 = document.createElement("td");
                                var textoCelda5 = document.createTextNode(t[3]);
                                celda.appendChild(textoCelda);
                                celda2.appendChild(textoCelda2);
                                celda3.appendChild(textoCelda3);
                                celda4.appendChild(textoCelda4);
                                celda5.appendChild(textoCelda5);
                                hilera.appendChild(celda);
                                hilera.appendChild(celda2);
                                hilera.appendChild(celda3);
                                hilera.appendChild(celda4);
                                hilera.appendChild(celda5);
                                body.appendChild(hilera);
                                DescripA='{{$resumen->ACCI_varDescripcion}}';
                                t=[0,0,0,0];
                                var ent={{$resumen->ATRI_intTrimestre}};
                                ent=ent-1;
                                t[ent]={{$resumen->Trimestre}};
                                Inicio=false;
                            }
                        }
                    </script>
                @endif
            @endforeach
            
        </table>
        </div>
    </div>
</div>
@endsection
