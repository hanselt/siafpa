@extends('gmcpcam.reportes.partials.base')

@section('title', 'FICHA DE INTERVENCIÓN DE BIENES CULTURALES MUEBLES')

@section('content')
  <p class="text-center"><strong>FICHA TÉCNICA DE INTERVENCIÓN - BIENES CULTURALES ARQUEOLOGICOS</strong></p>
  <table class="full-bordered fixed">
    <tr>
      <td class="w-1"><strong>Ficha N°</strong></td>
      <td class="w-4">{{ $datos->nro_ficha }}</td>
      <td class="w-1"><strong>Fecha</strong></td>
      <td class="w-4">{{ $datos->fecha_intervencion }}</td>
    </tr>
  </table>
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
      <td class="w-1"><strong>Ubicación actual</strong></td>
      <td class="w-4">{{ $datos->catalogacion->ubicacion_actual }}</td>
      <td class="w-1"><strong>Ubicación específica</strong></td>
      <td class="w-4">{{ $datos->catalogacion->ubicacion_especifica }}</td>
    </tr>
  </table>
  <h2 class="subtitle">2. PROPUESTA DE INTERVENCIÓN</h2>
  <table class="bordered">
    @foreach ($datos->propuesta_intervencion as $propuesta)
      <tr>
        <td>{{ $loop->index + 1 }}. {{ $propuesta }}</td>
      </tr>
    @endforeach
  </table>
  <h2 class="subtitle">3. INTERVENCIÓN REALIZADA</h2>
  <table class="bordered">
    @foreach ($datos->intervencion_realizada as $intervencion)
      <tr>
        <td>{{ $loop->index + 1 }}. {{ $intervencion }}</td>
      </tr>
    @endforeach
  </table>
  <h2 class="subtitle">4. OBSERVACIONES</h2>
  <p class="bordered">{{ $datos->observaciones}}</p>
  <h2 class="subtitle">5. MEDIDAS FINALES</h2>
  <table class="full-bordered fixed">
    <tr>
      <td><strong>Largo</strong></td>
      <td class="text-right">
        @if ($datos->largo_final)
          {{ $datos->largo_final }} mm
        @endif
      </td>
      <td><strong>Ancho</strong></td>
      <td class="text-right">
        @if ($datos->ancho_final)
          {{ $datos->ancho_final }} mm
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Diámetro mínimo</strong></td>
      <td class="text-right">
        @if ($datos->diametro_minimo_final)
          {{ $datos->diametro_minimo_final }} mm
        @endif
      </td>
      <td><strong>Espesor</strong></td>
      <td class="text-right">
        @if ($datos->espesor_final)
          {{ $datos->espesor_final }} mm
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Altura</strong></td>
      <td class="text-right">
        @if ($datos->alto_final)
          {{ $datos->alto_final }} mm
        @endif
      </td>
      <td><strong>Diámetro Base</strong></td>
      <td class="text-right">
        @if ($datos->diametro_base_final)
          {{ $datos->diametro_base_final }} mm
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Diámetro máximo</strong></td>
      <td class="text-right">
        @if ($datos->diametro_maximo_final)
          {{ $datos->diametro_maximo_final }} mm
        @endif
      </td>
      <td><strong>Peso</strong></td>
      <td class="text-right">
        @if ($datos->peso_final)
          {{ $datos->peso_final }} g
        @endif
      </td>
    </tr>
  </table>
  <h2 class="subtitle">6. OBSERVACIONES</h2>
  <p class="bordered">{{ $datos->observaciones_intervencion }}</p>
  <div class="break"></div>
  <h2 class="subtitle">8. REGISTRO FOTOGRÁFICO DEL BIEN INTERVENIDO</h2>
  <table class="full-bordered fixed">
    <tr class="row-foto max">
      <td>
        <img class="foto-adicional center-block" src="{{ url($datos->ruta_fotografia_vista_inicial) }}" alt="">
        <p class="text-center">Estado inicial del bien. Fotografía 1.</p>
      </td>
      <td>
        <img class="foto-adicional center-block" src="{{ url($datos->ruta_fotografia_vista_final) }}" alt="">
        <p class="text-center">Estado final del bien. Fotografía 2.</p>
      </td>
    </tr>
    <tr class="row-foto max">
      <td>
        <img class="foto-adicional center-block" src="{{ url($datos->ruta_fotografia_vista_posterior) }}" alt="">
        <p class="text-center">Detalle del posterior del bien. Fotografía 3.</p>
      </td>
      <td>
        <img class="foto-adicional center-block" src="{{ url($datos->ruta_fotografia_vista_perfil) }}" alt="">
        <p class="text-center">Detalle de perfil. Fotografía 4.</p>
      </td>
    </tr>
  </table>
  <h2 class="subtitle">9. REGISTRO FOTOGRÁFICO ANTERIOR, DURANTE Y AL FINAL DEL PROCESO DE INTERVENCIÓN DEL BIEN</h2>
  <table class="fixed">
    <tr>
      <td class="w-5"></td>
      <td class="w-5"></td>
    </tr>
    <tr class="row-foto max">
      @foreach ($datos->fotografias as $foto)
        <td class="bordered">
          <img class="foto-adicional center-block" src="{{ url($foto->ruta) }}" alt="">
          <p class="text-center">{{ $foto->descripcion }}</p>
        </td>
        @if ((($loop->index + 1) % 2 === 0))
          </tr><tr>
        @endif
      @endforeach
    </tr>
  </table>
  <h2 class="subtitle">7. DATOS DE CONTROL</h2>
  <table class="bordered fixed">
    <tr>
      <td class="w-2"><strong>Responsable</strong></td>
      <td>{{ $datos->registrador->name }}</td>
    </tr>
  </table>
@endsection
