@extends('gmcpcam.reportes.partials.base')

@section('title', 'FICHA DE CONSERVACION ACTIVA Y PREVENTIVA (F4)')

@section('content')
  <p class="text-center"><strong>FICHA DE CONSERVACION ACTIVA Y PREVENTIVA (F4)</strong></p>
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
  <h2 class="subtitle">2. DATOS DE CONSERVACIÓN</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-2"><strong>Estado de Conservación</strong></td>
      <td>{{ $datos->estadoConservacion->denominacion }}</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Acciones de conservación</strong></td>
    </tr>
    <tr>
      <td colspan="2">
        @foreach ($datos->acciones_conservacion as $accion)
          <p>{{ $loop->index + 1 }}. {{ $accion }}</p>
        @endforeach
      </td>
    </tr>
    <tr>
      <td colspan="2"><strong>Descripción de la conservación</strong></td>
    </tr>
    <tr>
      <td colspan="2" class="ws-pw">{{ $datos->descripcion }}</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Acciones de Montaje y Almacenamiento</strong></td>
    </tr>
    <tr>
      <td colspan="2" class="ws-pw">{{ $datos->acciones_montaje_almacenamiento }}</td>
    </tr>
  </table>
  <div class="break"></div>
  <h2 class="subtitle">3. REGISTRO FOTOGRÁFICO</h2>
  <table class="fixed">
    <tr>
      <td class="w-5"></td>
      <td class="w-5"></td>
    </tr>
    <tr>
      @foreach ($datos->fotografias as $foto)
        <td class="bordered">
          <img class="foto-adicional center-block" src="{{ url($foto->ruta) }}">
          <p class="text-center">{{ $foto->descripcion }}</p>
        </td>
        @if ((($loop->index + 1) % 2 === 0))
          </tr><tr>
        @endif
      @endforeach
    </tr>
  </table>
  <h2 class="subtitle">4. DATOS DE CONTROL</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-3"><strong>Responsable de la Conservación</strong></td>
      <td colspan="3">{{ $datos->registrador->name }}</td>
    </tr>
    <tr>
      <td><strong>Fecha de Inicio</strong></td>
      <td>{{ $datos->fecha_inicio }}</td>
      <td><strong>Fecha de Culminación</strong></td>
      <td>{{ $datos->fecha_culminacion }}</td>
    </tr>
  </table>
@endsection
