@extends('gmcpcam.reportes.partials.base')

@section('title', 'FICHA DE INVENTARIO (F2)')

@section('content')
  @foreach ($datos as $item)
    <p class="text-center"><strong>FICHA DE INVENTARIO (F2)</strong></p>
    <h2 class="subtitle">1. DATOS GENERALES</h2>
    <table class="fixed bordered">
      <tr>
        <td><strong>Nro. Inventario</strong></td>
        <td>{{ $item->nro_inv }}</td>
        <td class="text-center bordered w-4"><strong>Fotografía</strong></td>
      </tr>
      <tr>
        <td colspan="2" class="subtitle">2. DATOS DE PROCEDENCIA</td>
        <td rowspan="15" class="bordered">
          <img src="{{ url($item->ruta_fotografia) }}" class="fotografia center-block">
        </td>
      </tr>
      <tr>
        <td><strong>2.1 Modalidad de Intervención</strong></td>
        <td>{{ $item->inventario->proyecto->modalidad_intervencion }}</td>
      </tr>
      <tr>
        <td colspan="2"><strong>2.2 Nombre del Proyecto</strong></td>
      </tr>
      <tr>
        <td colspan="2">{{ $item->inventario->proyecto->nombre }}</td>
      </tr>
      <tr>
        <td><strong>2.3 Período de Intervención</strong></td>
        <td>{{ $item->inventario->proyecto->periodo }}</td>
      </tr>
      <tr>
        <td><strong>2.4 Responsable</strong></td>
        <td>{{ $item->inventario->proyecto->nombre_responsable }}</td>
      </tr>
      <tr>
        <td colspan="2"><strong>2.5 Ubicación:</strong></td>
      </tr>
      <tr>
        <td><strong>Origen</strong></td>
        <td>{{ $item->inventario->proyecto->origen }}</td>
      </tr>
      <tr>
        <td><strong>Ubigeo</strong></td>
        <td>{{ $item->inventario->proyecto->ubigeo }}</td>
      </tr>
      <tr>
        <td><strong>Departamento</strong></td>
        <td>{{ $item->inventario->proyecto->departamento }}</td>
      </tr>
      <tr>
        <td><strong>Provincia</strong></td>
        <td>{{ $item->inventario->proyecto->provincia }}</td>
      </tr>
      <tr>
        <td><strong>Distrito</strong></td>
        <td>{{ $item->inventario->proyecto->distrito }}</td>
      </tr>
      <tr>
        <td><strong>Anexo</strong></td>
        <td>{{ $item->inventario->proyecto->anexo }}</td>
      </tr>
      <tr>
        <td><strong>CC.PP.</strong></td>
        <td>{{ $item->inventario->proyecto->centro_poblado }}</td>
      </tr>
      <tr>
        <td colspan="2" class="va-bottom"><strong>2.6 Datos de Tarjeta de campo</strong></td>
      </tr>
    </table>
    <table class="fixed bordered">
      <tr>
        <td><strong>Sitio / Sector</strong></td>
        <td>{{ $item->sector }}</td>
        <td><strong>Sub Sector</strong></td>
        <td>{{ $item->subsector }}</td>
        <td><strong>U.E.</strong></td>
        <td>{{ $item->unidad_excavacion }}</td>
      </tr>
      <tr>
        <td><strong>Contexto</strong></td>
        <td>{{ $item->contexto }}</td>
        <td><strong>Capa / Nivel</strong></td>
        <td>{{ $item->capa_nivel }}</td>
        <td><strong>Coordenadas UTM</strong></td>
        <td>{{ $item->coordenadas_utm }}</td>
      </tr>
    </table>
    <h2 class="subtitle">3. DATOS DEL POSEEDOR DEL BIEN CULTURAL</h2>
    <table class="fixed bordered">
      <td class="w-2"><strong>Código de Caja</strong></td>
      <td class="w-3">{{ $item->inventario->proyecto->codigo_caja }}</td>
      <td class="w-2"><strong>Documento de Ingreso</strong></td>
      <td class="w-3">{{ $item->inventario->proyecto->documento_ingreso }}</td>
    </table>
    <h2 class="subtitle">4. UBICACIÓN DEL BIEN</h2>
    <p class="bordered">{{ $item->ubicacion_especifica }}</p>
    <h2 class="subtitle">5. DATOS DEL ÍTEM</h2>
    <table class="fixed bordered">
      <tr>
        <td class="w-2"><strong>Tipo de Objeto</strong></td>
        <td>{{ $item->tipo_objeto }}</td>
      </tr>
      <tr>
        <td><strong>Peso</strong></td>
        <td>{{ $item->peso }}</td>
      </tr>
      <tr>
        <td><strong>Códigos Anteriores</strong></td>
        <td>{{ $item->codigos_anteriores }}</td>
      </tr>
      <tr>
        <td><strong>Morfología</strong></td>
        <td>
          <ul>
            @foreach ($item->morfologia as $morfologia)
              <li>{{ $morfologia }}</li>
            @endforeach
          </ul>
        </td>
      </tr>
      <tr>
        <td><strong>Período Cultural</strong></td>
        <td>{{ $item->reporte_periodo }}</td>
      </tr>
      <tr>
        <td><strong>Estilos Alfareros</strong></td>
        <td>{{ $item->estilos_alfareros }}</td>
      </tr>
      <tr>
        <td><strong>Descripción</strong></td>
        <td>{{ $item->descripcion }}</td>
      </tr>
      <tr>
        <td><strong>Estado de conservación</strong></td>
        <td>{{ $item->estadoConservacion->denominacion }}</td>
      </tr>
      <tr>
        <td><strong>Observaciones</strong></td>
        <td>{{ $item->observaciones }}</td>
      </tr>
      <tr>
        <td><strong>Cantidad fragmentos diagnósticos</strong></td>
        <td>{{ $item->material_diagnostico }}</td>
      </tr>
    </table>
    <h2 class="subtitle">6. DATOS DE CONTROL</h2>
    <table class="fixed bordered">
      <td class="w-2"><strong>Responsable</strong></td>
      <td class="w-3">{{ $item->inventario->registrador }}</td>
      <td class="w-2"><strong>Fecha de Clasificación</strong></td>
      <td class="w-3">{{ $item->inventario->fecha_registro }}</td>
    </table>
    @if (!$loop->last)
      <div class="break"></div>
    @endif
  @endforeach
@endsection
