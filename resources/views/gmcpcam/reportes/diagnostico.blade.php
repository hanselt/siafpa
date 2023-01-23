@extends('gmcpcam.reportes.partials.base')

@section('title', 'FICHA DE DIAGNOSTICO DE BIENES CULTURALES MUEBLES')

@section('content')
<p class="text-center"><strong>FICHA TÉCNICA DE DIAGNÓSTICO - BIENES CULTURALES ARQUEOLOGICOS</strong></p>
<table class="full-bordered fixed">
  <tr>
    <td class="w-1"><strong>Ficha N°</strong></td>
    <td class="w-4">{{ $datos->nro_ficha }}</td>
    <td class="w-1"><strong>Fecha</strong></td>
    <td class="w-4">{{ $datos->fecha_diagnostico }}</td>
  </tr>
</table>
<div style="width: 65%; float: left; margin-right: 1%">
  <h2 class="subtitle">1. DATOS GENERALES DEL BIEN</h2>
  <h3>1.1 Datos de Identificación</h3>
  <table class="bordered fixed">
    <tr>
      <td class="w-2"><strong>Código del bien</strong></td>
      <td class="w-3">{{ $datos->catalogacion->codigo_bien }}</td>
      <td class="w-2"><strong>Cultura/Estilo</strong></td>
      <td class="w-3">{{ $datos->catalogacion->culturaEstilo->denominacion }}</td>
    </tr>
    <tr>
      <td><strong>Bien Cultural</strong></td>
      <td>{{ $datos->catalogacion->bienCultural->denominacion }}</td>
      <td rowspan="2" class="bordered"><strong>Período Cultural</strong></td>
      <td rowspan="2">{{ $datos->catalogacion->cronologia()->first()->denominacion }}</td>
    </tr>
    <tr>
      <td><strong>Material</strong></td>
      <td>{{ $datos->catalogacion->material->denominacion }}</td>
    </tr>
  </table>
  <h3>1.2 Datos de Procedencia</h3>
  <table class="bordered fixed">
    <tr>
      <td><strong>Período de intervención</strong></td>
      <td>{{ $datos->catalogacion->detalleInventario->inventario->periodo }}</td>
      <td><strong>Modalidad de intervención</strong></td>
      <td>{{ $datos->catalogacion->detalleInventario->inventario->proyecto->modalidad_intervencion }}</td>
    </tr>
    <tr>
      <td colspan="4"><strong>Nombre del proyecto</strong></td>
    </tr>
    <tr>
      <td colspan="4">{{ $datos->catalogacion->detalleInventario->inventario->proyecto->nombre }}</td>
    </tr>
    <tr>
      <td><strong>Responsable</strong></td>
      <td colspan="3">{{ $datos->catalogacion->detalleInventario->inventario->proyecto->nombre_responsable }}</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Ubicación</strong></td>
      <td colspan="2"><strong>Datos de Tarjeta de campo</strong></td>
    </tr>
    <tr>
      <td><strong>Origen:</strong></td>
      <td>{{ $datos->catalogacion->detalleInventario->inventario->proyecto->origen }}</td>
      <td><strong>Sitio / Sector:</strong></td>
      <td>{{ $datos->catalogacion->sector }}</td>
    </tr>
    <tr>
      <td ><strong>Ubigeo:</strong></td>
      <td>{{ $datos->catalogacion->detalleInventario->inventario->proyecto->ubigeo }}</td>
      <td><strong>Sub Sector:</strong></td>
      <td>{{ $datos->catalogacion->subsector }}</td>
    </tr>
    <tr>
      <td><strong>Departamento:</strong></td>
      <td>{{ $datos->catalogacion->detalleInventario->inventario->proyecto->departamento }}</td>
      <td><strong>U.E:</strong></td>
      <td>{{ $datos->catalogacion->unidad_excavacion }}</td>
    </tr>
    <tr>
      <td><strong>Provincia:</strong></td>
      <td>{{ $datos->catalogacion->detalleInventario->inventario->proyecto->provincia }}</td>
      <td><strong>Contexto:</strong></td>
      <td>{{ $datos->catalogacion->contexto }}</td>
    </tr>
    <tr>
      <td><strong>Distrito:</strong></td>
      <td>{{ $datos->catalogacion->detalleInventario->inventario->proyecto->distrito }}</td>
      <td><strong>Capa/Nivel:</strong></td>
      <td>{{ $datos->catalogacion->capa_nivel }}</td>
    </tr>
    <tr>
      <td><strong>Anexo:</strong></td>
      <td>{{ $datos->catalogacion->detalleInventario->inventario->proyecto->anexo }}</td>
      <td><strong>Coordenadas UTM:</strong></td>
      <td>{{ $datos->catalogacion->coordenadas_utm }}</td>
    </tr>
    <tr>
      <td><strong>CC.PP:</strong></td>
      <td>{{ $datos->catalogacion->detalleInventario->inventario->proyecto->centro_poblado }}</td>
      <td><strong>Fecha de hallazgo:</strong></td>
      <td>{{ $datos->catalogacion->fecha_hallazgo }}</td>
    </tr>
  </table>
  <h3>1.3 Datos del Poseedor del Bien Cultural</h3>
  <table class="bordered fixed">
    <tr>
      <td class="w-2"><strong>Código de caja</strong></td>
      <td class="w-3">{{ $datos->catalogacion->detalleInventario->inventario->proyecto->codigo_caja }}</td>
      <td class="w-1"><strong>Fecha</strong></td>
      <td class="w-4">{{ $datos->catalogacion->detalleInventario->inventario->proyecto->documento_ingreso }}</td>
    </tr>
  </table>
  <h3>1.4 Ubicación del Bien</h3>
  <table class="bordered fixed">
    <tr>
      <td><strong>Ubicación actual</strong></td>
      <td><strong>Ubicación específica</strong></td>
    </tr>
    <tr>
      <td>{{ $datos->catalogacion->ubicacion_actual }}</td>
      <td>{{ $datos->catalogacion->ubicacion_especifica }}</td>
    </tr>
  </table>
  <h2 class="subtitle">3. MEDIDAS</h2>
  <table class="full-bordered fixed">
    <tr>
      <td class="bordered"><strong>Largo</strong></td>
      <td class="bordered text-right">
        @if ($datos->catalogacion->largo)
        {{ $datos->catalogacion->largo }} mm
        @endif
      </td>
      <td class="bordered"><strong>Ancho</strong></td>
      <td class="bordered text-right">
        @if ($datos->catalogacion->ancho)
        {{ $datos->catalogacion->ancho }} mm
        @endif
      </td>
    </tr>
    <tr>
      <td class="bordered"><strong>Diámetro mínimo</strong></td>
      <td class="bordered text-right">
        @if ($datos->catalogacion->diametro_minimo)
        {{ $datos->catalogacion->diametro_minimo }} mm
        @endif
      </td>
      <td class="bordered"><strong>Espesor</strong></td>
      <td class="bordered text-right">
        @if ($datos->catalogacion->espesor)
        {{ $datos->catalogacion->espesor }} mm
        @endif
      </td>
    </tr>
    <tr>
      <td class="bordered"><strong>Altura</strong></td>
      <td class="bordered text-right">
        @if ($datos->catalogacion->altura)
        {{ $datos->catalogacion->altura }} mm
        @endif
      </td>
      <td class="bordered"><strong>Diámetro base</strong></td>
      <td class="bordered text-right">
        @if ($datos->catalogacion->diametro_base)
        {{ $datos->catalogacion->diametro_base }} mm
        @endif
      </td>
    </tr>
    <tr>
      <td class="bordered"><strong>Diámetro máximo</strong></td>
      <td class="bordered text-right">
        @if ($datos->catalogacion->diametro_maximo)
        {{ $datos->catalogacion->diametro_maximo }} mm
        @endif
      </td>
      <td class="bordered"><strong>Peso</strong></td>
      <td class="bordered text-right">
        @if ($datos->catalogacion->peso)
        {{ $datos->catalogacion->peso }} g
        @endif
      </td>
    </tr>
  </table>
  <h2 class="subtitle">4. DESCRIPCIÓN</h2>
  <p class="bordered">{{ $datos->descripcion }}</p>
  <h2 class="subtitle">5. DIAGNÓSTICO</h2>
  <table class="bordered">
    <tr>
      <td>{{ $datos->diagnosticoEstado->denominacion }}</td>
    </tr>
    <tr>
      <td>{{ $datos->diagnostico_descripcion }}</td>
    </tr>
  </table>
  <h2 class="subtitle">6. OBSERVACIONES</h2>
  <p class="bordered">{{ $datos->observaciones }}</p>
</div>
<div style="width: 34%; float: left;">
  <h2 class="subtitle">2. REGISTRO FOTOGRÁFICO DEL ESTADO ACTUAL DEL BIEN</h2>
  <table class="full-bordered">
    <tr>
      <td class="text-center">Vista anterior. Fotografía 1.</td>
    </tr>
    <tr class="row-foto">
      <td>
        <img class="foto-adicional min center-block" src="{{ url($datos->ruta_fotografia_vista_anterior) }}" alt="">
      </td>
    </tr>
    <tr>
      <td class="text-center">Vista a detalle. Fotografía 2.</td>
    </tr>
    <tr class="row-foto">
      <td>
        <img class="foto-adicional min center-block" src="{{ url($datos->ruta_fotografia_vista_posterior) }}" alt="">
      </td>
    </tr>
    <tr>
      <td class="text-center">Vista posterior. Fotografía 3.</td>
    </tr>
    <tr class="row-foto">
      <td>
        <img class="foto-adicional min center-block" src="{{ url($datos->ruta_fotografia_vista_detalle_1) }}" alt="">
      </td>
    </tr>
    <tr>
      <td class="text-center">Vista a detalle. Fotografía 4.</td>
    </tr>
    <tr class="row-foto">
      <td>
        <img class="foto-adicional min center-block" src="{{ url($datos->ruta_fotografia_vista_detalle_2) }}" alt="">
      </td>
    </tr>
  </table>
  <h2 class="subtitle">7. DATOS DE CONTROL</h2>
  <table class="bordered">
    <tr>
      <td><strong>Responsable</strong></td>
    </tr>
    <tr>
      <td>{{ $datos->registrador->name }}</td>
    </tr>
  </table>
</div>
@endsection
