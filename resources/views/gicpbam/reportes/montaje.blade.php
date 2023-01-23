@extends('gmcpcam.reportes.partials.base')

@section('title', 'FICHA DE MONTAJE DE PANELES DE LA COLECCION MUESTRAL (F7)')

@section('content')
  <p class="text-center"><strong>FICHA DE MONTAJE DE PANELES DE LA COLECCION MUESTRAL (F7)</strong></p>
  <h2 class="subtitle">1. DATOS GENERALES</h2>
  <h3>1.1 Datos de Identificación</h3>
  <table class="bordered fixed">
    <tr>
      <td class="w-2"><strong>Nro. de Ficha</strong></td>
      <td>{{ $datos->nro_ficha }}</td>
    </tr>
  </table>
  <h3>1.2 Datos de Procedencia</h3>
  <table class="bordered fixed">
    <tr>
      <td><strong>Período de intervención</strong></td>
      <td>{{ $datos->proyecto->periodo }}</td>
      <td><strong>Modalidad de intervención</strong></td>
      <td>{{ $datos->proyecto->modalidad_intervencion }}</td>
    </tr>
    <tr>
      <td colspan="4"><strong>Nombre del proyecto</strong></td>
    </tr>
    <tr>
      <td colspan="4">{{ $datos->proyecto->nombre }}</td>
    </tr>
    <tr>
      <td><strong>Responsable</strong></td>
      <td colspan="3">{{ $datos->proyecto->nombre_responsable }}</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Ubicación</strong></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>Origen:</strong></td>
      <td>{{ $datos->proyecto->origen }}</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td ><strong>Ubigeo:</strong></td>
      <td>{{ $datos->proyecto->ubigeo }}</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>Departamento:</strong></td>
      <td>{{ $datos->proyecto->departamento }}</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>Provincia:</strong></td>
      <td>{{ $datos->proyecto->provincia }}</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>Distrito:</strong></td>
      <td>{{ $datos->proyecto->distrito }}</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>Anexo:</strong></td>
      <td>{{ $datos->proyecto->anexo }}</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>CC.PP:</strong></td>
      <td>{{ $datos->proyecto->centro_poblado }}</td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <h3>1.3 Datos del Poseedor del Bien Cultural</h3>
  <table class="bordered fixed">
    <tr>
      <td class="w-2"><strong>Código de caja</strong></td>
      <td class="w-3">{{ $datos->proyecto->codigo_caja }}</td>
      <td class="w-1"><strong>Fecha</strong></td>
      <td class="w-4">{{ $datos->proyecto->documento_ingreso }}</td>
    </tr>
  </table>
  <h2 class="subtitle">2. DATOS DEL MONTAJE EN PANEL</h2>
  <table class="fixed bordered">
    <tr>
      <td><strong>Ubicación Panel</strong></td>
      <td>{{ $datos->ubicacion_panel }}</td>
      <td><strong>Nro. Panel</strong></td>
      <td>{{ $datos->nro_panel }}</td>
    </tr>
    <tr>
      <td><strong>Gaveta</strong></td>
      <td>{{ $datos->gaveta }}</td>
      <td><strong></strong></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>Largo del Panel</strong></td>
      <td>{{ $datos->largo_panel }}</td>
      <td><strong>Ancho del Panel</strong></td>
      <td>{{ $datos->ancho_panel }}</td>
    </tr>
    <tr>
      <td><strong>Número de Fragmentos</strong></td>
      <td>{{ $datos->numero_fragmentos }}</td>
      <td><strong>Rango de Códigos</strong></td>
      <td>{{ $datos->rango_codigos }}</td>
    </tr>
    <tr>
      <td><strong>Estilos</strong></td>
      <td>{{ $datos->reporte_estilos }}</td>
      <td><strong>Estado de conservación</strong></td>
      <td>{{ $datos->estadoConservacionPanel->denominacion }}</td>
    </tr>
    <tr>
      <td><strong>Renovación del Panel</strong></td>
      <td>
        @if ($datos->es_renovacion_panel)
          SI
        @else
          NO
        @endif
      </td>
      <td><strong></strong></td>
      <td></td>
    </tr>
  </table>
  <h2 class="subtitle">3. REGISTRO FOTOGRÁFICO</h2>
  <table class="fixed full-bordered">
    <tr>
      <td>
        <p class="text-center">Foto Inicial</p>
        <img class="fotografia fotografia-medium center-block" src="{{ url($datos->ruta_foto_inicial) }}">
      </td>
      <td>
        <p class="text-center">Foto Proceso</p>
        <img class="fotografia fotografia-medium center-block" src="{{ url($datos->ruta_foto_proceso) }}" alt="">
      </td>
      <td>
        <p class="text-center">Foto Final</p>
        <img class="fotografia fotografia-medium center-block" src="{{ url($datos->ruta_foto_final) }}" alt="">
      </td>
    </tr>
  </table>
  <h2 class="subtitle">4. OBSERVACIONES</h2>
  <p class="bordered">{{ $datos->observaciones }}</p>
  <h2 class="subtitle">5. DATOS DE CONTROL</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-3"><strong>Responsable de Adecuación del Panel</strong></td>
      <td class="w-4">{{ $datos->responsable_adecuacion_panel }}</td>
      <td><strong>Fecha de Inicio</strong></td>
      <td>{{ $datos->fecha_inicio }}</td>
    </tr>
    <tr>
      <td><strong>Responsable de Codificación</strong></td>
      <td>{{ $datos->responsable_codificacion }}</td>
      <td><strong>Fecha de Entrega</strong></td>
      <td>{{ $datos->fecha_entrega }}</td>
    </tr>
  </table>
@endsection
