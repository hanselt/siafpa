@extends('gmcpcam.reportes.partials.base')

@section('title', 'FICHA DE MOVIMIENTO DE FRAGMENTOS DE LA COLECCIÓN MUESTRAL (F9)')

@section('content')
  <p class="text-center"><strong>FICHA DE MOVIMIENTO DE FRAGMENTOS DE LA COLECCIÓN MUESTRAL (F9)</strong></p>
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
  <h2 class="subtitle">2. DATOS DE MOVIMIENTO DEL FRAGMENTO</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-2"><strong>Procede De</strong></td>
      <td class="w-4">{{ $datos->procedencia }}</td>
      <td class="w-2"><strong>Destino</strong></td>
      <td class="w-2">{{ $datos->destino }}</td>
    </tr>
    <tr>
      <td><strong>Documento / Resolución</strong></td>
      <td>{{ $datos->documento_resolucion }}</td>
      <td><strong>Motivo de Traslado</strong></td>
      <td>{{ $datos->motivo_traslado }}</td>
    </tr>
  </table>
  <h2 class="subtitle">3. REGISTRO FOTOGRÁFICO</h2>
  <table class="fixed full-bordered">
    <tr>
      <td class="text-center"><strong>Fotografía de Entrega</strong></td>
      <td class="text-center"><strong>Fotografía de Recepción</strong></td>
    </tr>
    <tr>
      <td>
        <img class="fotografia fotografia-medium center-block" src="{{ url($datos->ruta_foto_entrega) }}" alt="">
      </td>
      <td>
        <img class="fotografia fotografia-medium center-block" src="{{ url($datos->ruta_foto_recepcion) }}" alt="">
      </td>
    </tr>
  </table>
  <div class="break"></div>
  <h2 class="subtitle">4. OBSERVACIONES</h2>
  <p class="bordered">{{ $datos->observaciones }}</p>
  <h2 class="subtitle">5. DATOS DE CONTROL</h2>
  <table class="fixed bordered">
    <tr>
      <td><strong>Responsable de Entrega</strong></td>
      <td>{{ $datos->responsable_entrega }}</td>
      <td><strong>Fecha de Entrega</strong></td>
      <td>{{ $datos->fecha_entrega }}</td>
    </tr>
    <tr>
      <td><strong>Responsable de Recepción</strong></td>
      <td>{{ $datos->responsable_recepcion }}</td>
      <td><strong>Fecha de Devolución</strong></td>
      <td>{{ $datos->fecha_devolucion }}</td>
    </tr>
  </table>
  <table class="fixed">
    <tr>
      <td class="w-2">FIRMA DE ENTREGA</td>
      <td class="w-3 bordered">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
      </td>
      <td class="w-2">FIRMA DE RECEPCION</td>
      <td class="w-3 bordered">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
      </td>
    </tr>
    <tr>
      <td>FIRMA DE RECEPCION</td>
      <td class="bordered">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
      </td>
      <td>FIRMA DE ENTREGA</td>
      <td class="bordered">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
      </td>
    </tr>
  </table>
@endsection
