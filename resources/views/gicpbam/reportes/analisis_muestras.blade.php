@extends('gmcpcam.reportes.partials.base')

@section('title', 'FICHA DE RESULTADOS DE ANALISIS DE MUESTRAS (F6)')

@section('content')
  <p class="text-center"><strong>FICHA DE RESULTADOS DE ANALISIS DE MUESTRAS (F6)</strong></p>
  <h2 class="subtitle">1. DATOS GENERALES DEL BIEN</h2>
  <h3>1.1 Datos de Identificación</h3>
  <table class="bordered fixed">
    <tr>
      <td class="w-2"><strong>Nro. de Ficha</strong></td>
      <td class="w-3">{{ $datos->nro_ficha }}</td>
      <td class="w-2"><strong>Nro. de Inventario</strong></td>
      <td class="w-3">{{ $datos->fragmento->detalleInventario->nro_inv }}</td>
    </tr>
    <tr>
      <td><strong>Código de Fragmento</strong></td>
      <td>{{ $datos->fragmento->codigo_fragmento }}</td>
      <td><strong>Estilo / Cultura</strong></td>
      <td>{{ $datos->fragmento->estilo()->first()->denominacion }}</td>
    </tr>
    <tr>
      <td><strong>Tipo de Bien</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->tipo_objeto }}</td>
      <td><strong>Peso</strong></td>
      <td>{{ $datos->fragmento->peso }}</td>
    </tr>
  </table>
  <h3>1.2 Datos de Procedencia</h3>
  <table class="bordered fixed">
    <tr>
      <td><strong>Período de intervención</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->inventario->periodo }}</td>
      <td><strong>Modalidad de intervención</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->inventario->proyecto->modalidad_intervencion }}</td>
    </tr>
    <tr>
      <td colspan="4"><strong>Nombre del proyecto</strong></td>
    </tr>
    <tr>
      <td colspan="4">{{ $datos->fragmento->detalleInventario->inventario->proyecto->nombre }}</td>
    </tr>
    <tr>
      <td><strong>Responsable</strong></td>
      <td colspan="3">{{ $datos->fragmento->detalleInventario->inventario->proyecto->nombre_responsable }}</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Ubicación</strong></td>
      <td colspan="2"><strong>Datos de Tarjeta de campo</strong></td>
    </tr>
    <tr>
      <td><strong>Origen:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->inventario->proyecto->origen }}</td>
      <td><strong>Sitio / Sector:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->sector }}</td>
    </tr>
    <tr>
      <td ><strong>Ubigeo:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->inventario->proyecto->ubigeo }}</td>
      <td><strong>Sub Sector:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->subsector }}</td>
    </tr>
    <tr>
      <td><strong>Departamento:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->inventario->proyecto->departamento }}</td>
      <td><strong>U.E:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->unidad_excavacion }}</td>
    </tr>
    <tr>
      <td><strong>Provincia:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->inventario->proyecto->provincia }}</td>
      <td><strong>Contexto:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->contexto }}</td>
    </tr>
    <tr>
      <td><strong>Distrito:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->inventario->proyecto->distrito }}</td>
      <td><strong>Capa/Nivel:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->capa_nivel }}</td>
    </tr>
    <tr>
      <td><strong>Anexo:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->inventario->proyecto->anexo }}</td>
      <td><strong>Coordenadas UTM:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->coordenadas_utm }}</td>
    </tr>
    <tr>
      <td><strong>CC.PP:</strong></td>
      <td>{{ $datos->fragmento->detalleInventario->inventario->proyecto->centro_poblado }}</td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <h3>1.3 Datos del Poseedor del Bien Cultural</h3>
  <table class="bordered fixed">
    <tr>
      <td class="w-2"><strong>Código de caja</strong></td>
      <td class="w-3">{{ $datos->fragmento->detalleInventario->inventario->proyecto->codigo_caja }}</td>
      <td class="w-1"><strong>Fecha</strong></td>
      <td class="w-4">{{ $datos->fragmento->detalleInventario->inventario->proyecto->documento_ingreso }}</td>
    </tr>
  </table>
  <h3>1.4 Ubicación del Bien</h3>
  <table class="bordered fixed">
    <tr>
      <td class="w-1"><strong>Espacio</strong></td>
      <td>{{ $datos->fragmento->espacio }}</td>
      <td class="w-1"><strong>Gaveta</strong></td>
      <td>{{ $datos->fragmento->gaveta }}</td>
      <td class="w-1"><strong>Panel</strong></td>
      <td>{{ $datos->fragmento->panel }}</td>
    </tr>
  </table>
  <h2 class="subtitle">2. DATOS DEL ANÁLISIS DE MUESTRAS</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-2"><strong>Nombre de la Muestra</strong></td>
      <td class="w-3">{{ $datos->nombre_muestra }}</td>
      <td class="bordered text-center w-5"><strong>Foto Referencial</strong></td>
    </tr>
    <tr>
      <td><strong>Altitud</strong></td>
      <td>{{ $datos->altitud }}</td>
      <td rowspan="8" class="bordered"><img class="fotografia center-block" src="{{ url($datos->ruta_foto_referencial) }}"></td>
    </tr>
    <tr>
      <td><strong>Fecha de Entrega</strong></td>
      <td>{{ $datos->fecha_entrega_muestra }}</td>
    </tr>
    <tr>
      <td><strong>Fecha de Recojo</strong></td>
      <td>{{ $datos->fecha_recojo_muestra }}</td>
    </tr>
    <tr>
      <td><strong>Tipo de análisis solicitado</strong></td>
      <td>{{ $datos->tipo_analisis_solicitado }}</td>
    </tr>
    <tr>
      <td><strong>Nombre de Laboratorio</strong></td>
      <td>{{ $datos->nombre_laboratorio }}</td>
    </tr>
    <tr>
      <td><strong>Ubicación de Laboratorio</strong></td>
      <td>{{ $datos->ubicacion_laboratorio }}</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Informes y Resultados</strong></td>
    </tr>
    <tr>
      <td colspan="2" class="ws-pw va-top">{{ $datos->informes_resultados }}</td>
    </tr>
  </table>
  <h2 class="subtitle">3. OBSERVACIONES</h2>
  <p class="bordered">{{ $datos->observaciones }}</p>
  <h2 class="subtitle">4. DATOS DE CONTROL</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-2"><strong>Responsable de Entrega</strong></td>
      <td>{{ $datos->responsable_entrega }}</td>
      <td class="w-3"><strong>Responsable de Recepción</strong></td>
      <td>{{ $datos->responsable_recepcion }}</td>
    </tr>
    <tr>
      <td><strong>Fecha de Análisis</strong></td>
      <td colspan="3">{{ $datos->fecha_analisis }}</td>
    </tr>
  </table>
@endsection
