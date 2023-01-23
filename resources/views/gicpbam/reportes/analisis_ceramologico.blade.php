@extends('gmcpcam.reportes.partials.base')

@section('title', 'FICHA DE ANALISIS CERAMOLOGICO DE LA COLECCIÓN MUESTRAL (F3)')

@section('content')
  <p class="text-center"><strong>FICHA DE ANALISIS CERAMOLOGICO DE LA COLECCIÓN MUESTRAL (F3)</strong></p>
  <h2 class="subtitle">1. DATOS GENERALES</h2>
  <table class="fixed bordered mb-0">
    <tr>
      <td><strong>Código de Fragmento</strong></td>
      <td>{{ $datos->codigo_fragmento }}</td>
      <td class="text-center bordered w-4"><strong>Fotografía</strong></td>
    </tr>
    <tr>
      <td><strong>Nro. Inventario</strong></td>
      <td>{{ $datos->detalleInventario->nro_inv }}</td>
      <td class="bordered" rowspan="16">
        <img class="fotografia center-block" src="{{ url($datos->ruta_fotografia) }}" alt="">
      </td>
    </tr>
    <tr>
      <td colspan="2" class="subtitle">2. DATOS DE PROCEDENCIA</td>
    </tr>
      <tr>
        <td><strong>2.1 Modalidad de Intervención</strong></td>
        <td>{{ $datos->detalleInventario->inventario->proyecto->modalidad_intervencion }}</td>
      </tr>
      <tr>
        <td colspan="2"><strong>2.2 Nombre del Proyecto</strong></td>
      </tr>
      <tr>
        <td colspan="2">{{ $datos->detalleInventario->inventario->proyecto->nombre }}</td>
      </tr>
      <tr>
        <td><strong>2.3 Período de Intervención</strong></td>
        <td>{{ $datos->detalleInventario->inventario->proyecto->periodo }}</td>
      </tr>
      <tr>
        <td><strong>2.4 Responsable</strong></td>
        <td>{{ $datos->detalleInventario->inventario->proyecto->nombre_responsable }}</td>
      </tr>
      <tr>
        <td colspan="2"><strong>2.5 Ubicación:</strong></td>
      </tr>
      <tr>
        <td><strong>Origen</strong></td>
        <td>{{ $datos->detalleInventario->inventario->proyecto->origen }}</td>
      </tr>
      <tr>
        <td><strong>Ubigeo</strong></td>
        <td>{{ $datos->detalleInventario->inventario->proyecto->ubigeo }}</td>
      </tr>
      <tr>
        <td><strong>Departamento</strong></td>
        <td>{{ $datos->detalleInventario->inventario->proyecto->departamento }}</td>
      </tr>
      <tr>
        <td><strong>Provincia</strong></td>
        <td>{{ $datos->detalleInventario->inventario->proyecto->provincia }}</td>
      </tr>
      <tr>
        <td><strong>Distrito</strong></td>
        <td>{{ $datos->detalleInventario->inventario->proyecto->distrito }}</td>
      </tr>
      <tr>
        <td><strong>Anexo</strong></td>
        <td>{{ $datos->detalleInventario->inventario->proyecto->anexo }}</td>
      </tr>
      <tr>
        <td><strong>CC.PP.</strong></td>
        <td>{{ $datos->detalleInventario->inventario->proyecto->centro_poblado }}</td>
      </tr>
      <tr>
        <td colspan="2" class="va-bottom"><strong>2.6 Datos de Tarjeta de campo</strong></td>
      </tr>
  </table>
  <table class="fixed bordered">
    <tr>
      <td><strong>Sitio / Sector</strong></td>
      <td>{{ $datos->detalleInventario->sector }}</td>
      <td><strong>Sub Sector</strong></td>
      <td>{{ $datos->detalleInventario->subsector }}</td>
      <td><strong>U.E.</strong></td>
      <td>{{ $datos->detalleInventario->unidad_excavacion }}</td>
    </tr>
    <tr>
      <td><strong>Contexto</strong></td>
      <td>{{ $datos->detalleInventario->contexto }}</td>
      <td><strong>Capa / Nivel</strong></td>
      <td>{{ $datos->detalleInventario->capa_nivel }}</td>
      <td><strong>Coordenadas UTM</strong></td>
      <td>{{ $datos->detalleInventario->coordenadas_utm }}</td>
    </tr>
  </table>
  <h2 class="subtitle">3. DATOS DEL POSEEDOR DEL BIEN CULTURAL</h2>
  <table class="fixed bordered">
    <td class="w-2"><strong>Código de Caja</strong></td>
    <td class="w-3">{{ $datos->detalleInventario->inventario->proyecto->codigo_caja }}</td>
    <td class="w-2"><strong>Documento de Ingreso</strong></td>
    <td class="w-3">{{ $datos->detalleInventario->inventario->proyecto->documento_ingreso }}</td>
  </table>
  <h2 class="subtitle">4. DATOS GENERALES</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-2"><strong>Ubicación del Fragmento</strong></td>
      <td class="w-3"></td>
      <td class="w-2"><strong>Forma de vasija</strong></td>
      <td class="w-3">{{ $datos->formaVasija->denominacion }}</td>
    </tr>
    <tr>
      <td><strong>Espacio</strong></td>
      <td>{{ $datos->espacio }}</td>
      <td><strong>Otras formas de vasija</strong></td>
      <td>{{ $datos->otras_formas_vasija }}</td>
    </tr>
    <tr>
      <td><strong>Gaveta</strong></td>
      <td>{{ $datos->gaveta }}</td>
      <td><strong>Tipo de Vasija</strong></td>
      <td>{{ $datos->tipo_vasija }}</td>
    </tr>
    <tr>
      <td><strong>Panel</strong></td>
      <td>{{ $datos->panel }}</td>
      <td><strong>Estilo</strong></td>
      <td>{{ $datos->estilo()->first()->denominacion }}</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td><strong>Otros estilos</strong></td>
      <td>{{ $datos->otros_estilos }}</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td><strong>Peso</strong></td>
      <td>
        @if ($datos->peso)
          {{ $datos->peso }} g
        @endif
      </td>
    </tr>
  </table>
  <h2 class="subtitle">5. ANÁLISIS DECORATIVO</h2>
  <table class="fixed bordered">
    <tr>
      <td><strong>Técnica superficie externa</strong></td>
      <td>
        @if ($datos->tecnicaSuperficieExterna)
          {{ $datos->tecnicaSuperficieExterna->denominacion }}
        @endif
      </td>
      <td><strong>Técnica superficie interna</strong></td>
      <td>
        @if ($datos->tecnicaSuperficieInterna)
          {{ $datos->tecnicaSuperficieInterna->denominacion }}
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Motivos superficie externa</strong></td>
      <td>
        @if ($datos->motivosSuperficieExterna)
          {{ $datos->motivosSuperficieExterna->denominacion }}
        @endif
      </td>
      <td><strong>Motivos superficie interna</strong></td>
      <td>
        @if ($datos->motivosSuperficieInterna)
          {{ $datos->motivosSuperficieInterna->denominacion }}
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Color motivos externos</strong></td>
      <td>{{ $datos->color_motivos_superficie_externa }}</td>
      <td><strong>Color motivos internos</strong></td>
      <td>{{ $datos->color_motivos_superficie_interna }}</td>
    </tr>
    <tr>
      <td colspan="4"><strong>Descripción de la decoración</strong></td>
    </tr>
    <tr>
      <td colspan="4" class="ws-pw">{{ $datos->descripcion_decoracion }}</td>
    </tr>
  </table>
  <div class="break"></div>
  <h2 class="subtitle">6. ANÁLISIS MORFOLÓGICO</h2>
  <table class="fixed bordered">
    <tr>
      <td><strong>Labio</strong></td>
      <td>
        @if ($datos->labio)
          {{ $datos->labio()->first()->denominacion }}
        @endif
      </td>
      <td><strong>Base</strong></td>
      <td>
        @if ($datos->base)
          {{ $datos->base()->first()->denominacion }}
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Borde</strong></td>
      <td>
        @if ($datos->borde)
          {{ $datos->borde()->first()->denominacion }}
        @endif
      </td>
      <td><strong>Diámetro Base</strong></td>
      <td>
        @if ($datos->diametro_base)
          {{ $datos->diametro_base }} mm
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Diámetro Borde</strong></td>
      <td>
        @if ($datos->diametro_borde)
          {{ $datos->diametro_borde }} mm
        @endif
      </td>
      <td><strong>Espesor promedio</strong></td>
      <td>
        @if ($datos->espesor_promedio)
          {{ $datos->espesor_promedio }} mm
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Cuello</strong></td>
      <td>
        @if ($datos->cuello)
          {{ $datos->cuello()->first()->denominacion }}
        @endif
      </td>
      <td><strong>Mango</strong></td>
      <td>
        @if ($datos->mango)
          {{ $datos->mango()->first()->denominacion }}
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Diámetro Cuello</strong></td>
      <td>
        @if ($datos->diametro_cuello)
          {{ $datos->diametro_cuello }} mm
        @endif
      </td>
      <td><strong>Apéndice</strong></td>
      <td>{{ $datos->apendice }}</td>
    </tr>
    <tr>
      <td><strong>Cuerpo</strong></td>
      <td>
        @if ($datos->cuerpo)
          {{ $datos->cuerpo()->first()->denominacion }}
        @endif
      </td>
      <td><strong>Soporte</strong></td>
      <td>
        @if ($datos->soporte)
          {{ $datos->soporte()->first()->denominacion }}
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Clase de Asa</strong></td>
      <td>
        @if ($datos->asa)
          {{ $datos->asa()->first()->denominacion }}
        @endif
      </td>
      <td><strong>Reutilización</strong></td>
      <td>{{ $datos->reutilizacion }}</td>
    </tr>
    <tr>
      <td><strong>Tipo de Asa</strong></td>
      <td>{{ $datos->tipo_asa }}</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><strong>Posición del Asa</strong></td>
      <td>{{ $datos->posicion_asa }}</td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <h2 class="subtitle">7. ANÁLISIS DE LA PASTA</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-2"><strong>Tamaño de los antiplásticos</strong></td>
      <td class="w-3">{{ $datos->tamano_antiplasticos }}</td>
      <td class="w-2"><strong>Color</strong></td>
      <td class="w-3">{{ $datos->color_pasta }}</td>
    </tr>
    <tr>
      <td><strong>Color de la pasta</strong></td>
      <td>{{ $datos->color_munsell_pasta }}</td>
      <td><strong>Textura</strong></td>
      <td>{{ $datos->textura }}</td>
    </tr>
    <tr>
      <td><strong>Cocción</strong></td>
      <td>{{ $datos->coccion }}</td>
      <td><strong>Dureza</strong></td>
      <td>{{ $datos->dureza }}</td>
    </tr>
    <tr>
      <td><strong>Ordenación de inclusiones</strong></td>
      <td>{{ $datos->ordenacion_inclusiones }}</td>
      <td><strong>Porcentaje inclusiones</strong></td>
      <td>
        @if ($datos->porcentaje_inclusiones)
          {{ $datos->porcentaje_inclusiones }} %
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Porcentaje porosidad</strong></td>
      <td>
        @if ($datos->porcentaje_porosidad)
          {{ $datos->porcentaje_porosidad }} %
        @endif
      </td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <h2 class="subtitle">8. ANÁLISIS DE SUPERFICIE</h2>
  <table class="fixed bordered">
    <tr>
      <td><strong>Color de la superficie externa</strong></td>
      <td>{{ $datos->color_superficie_externa }}</td>
      <td><strong>Color de la superficie interna</strong></td>
      <td>{{ $datos->color_superficie_interna }}</td>
    </tr>
    <tr>
      <td><strong>Tratamiento externo</strong></td>
      <td>{{ $datos->tratamiento_superficie_externa }}</td>
      <td><strong>Tratamiento interno</strong></td>
      <td>{{ $datos->tratamiento_superficie_interna }}</td>
    </tr>
  </table>
  <h2 class="subtitle">9. OBSERVACIONES</h2>
  <p class="bordered">{{ $datos->observaciones }}</p>
  <h2 class="subtitle">10. DATOS DE CONTROL</h2>
  <table class="fixed bordered">
    <tr>
      <td><strong>Responsable del Análisis</strong></td>
      <td>{{ $datos->registrador->name }}</td>
      <td><strong>Fecha de Análisis</strong></td>
      <td>{{ $datos->fecha_clasificacion }}</td>
    </tr>
  </table>
@endsection
