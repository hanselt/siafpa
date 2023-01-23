@extends('dfq.reportes.partials.base')

@section('title', 'FICHA DE ANÁLISIS DE MATERIALES CERÁMICOS')

@section('content')
<h1 class="text-center"><strong>FICHA DE ANÁLISIS DE MATERIALES CERÁMICOS</strong></h1>
<h2 class="subtitle">1. INFORMACIÓN GENERAL</h2>
<table class="fixed bordered">
  <tr>
    <td><strong>Nro. Ficha</strong></td>
    <td>{{ $datos->nro_ficha }}</td>
    <td><strong>Código</strong></td>
    <td>{{ $datos->codigo }}</td>
    <td class="w-4 bordered" rowspan="8">
      <img class="fotografia center-block" src="{{ url($datos->ruta_fotografia) }}" alt="">
    </td>
  </tr>
  <tr>
    <td colspan="2"><strong>Gestión Documentaria</strong></td>
    <td colspan="2"><strong>Solicitante</strong></td>
  </tr>
  <tr>
    <td colspan="2">{{ $datos->gestion_documentaria }}</td>
    <td colspan="2">{{ $datos->solicitante }}</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Solicitud de servicio</strong></td>
    <td colspan="2"><strong>Fecha</strong></td>
  </tr>
  <tr>
    <td colspan="2">{{ $datos->solicitud_servicio }}</td>
    <td colspan="2">{{ $datos->fecha_solicitud_servicio }}</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Documento respuesta</strong></td>
    <td colspan="2"><strong>Fecha</strong></td>
  </tr>
  <tr>
    <td colspan="2">{{ $datos->documento_respuesta }}</td>
    <td colspan="2">{{ $datos->fecha_documento_respuesta }}</td>
  </tr>
  <tr><td colspan="4"></td></tr>
</table>
<h2 class="subtitle">2. DATOS DE LOCALIZACIÓN</h2>
<table class="bordered fixed">
  <tr>
    <td class="w-2"><strong>Modalidad</strong></td>
    <td class="w-3">{{ $datos->proyecto->modalidad_intervencion }}</td>
    <td class="w-2"><strong>Ubigeo</strong></td>
    <td class="w-3">{{ $datos->proyecto->ubigeo }}</td>
  </tr>
  <tr>
    <td colspan="4"><strong>Nombre del proyecto</strong></td>
  </tr>
  <tr>
    <td colspan="4">{{ $datos->proyecto->nombre }}</td>
  </tr>
  <tr>
    <td><strong>Origen (Zona/Sitio Arqueológico)</strong></td>
    <td>{{ $datos->proyecto->origen }}</td>
    <td><strong>Departamento</strong></td>
    <td>{{ $datos->proyecto->departamento }}</td>
  </tr>
  <tr>
    <td><strong>Provincia</strong></td>
    <td>{{ $datos->proyecto->provincia }}</td>
    <td><strong>Distrito</strong></td>
    <td>{{ $datos->proyecto->distrito }}</td>
  </tr>
  <tr>
    <td><strong>Anexo</strong></td>
    <td>{{ $datos->proyecto->anexo }}</td>
    <td><strong>Centro Poblado</strong></td>
    <td>{{ $datos->proyecto->centro_poblado }}</td>
  </tr>
</table>
<h2 class="subtitle">3. INFORMACIÓN EN LA ETIQUETA DE REMISIÓN</h2>
<table class="fixed bordered">
  <tr>
    <td class="w-2"><strong>Sitio</strong></td>
    <td class="w-3">{{ $datos->sitio }}</td>
    <td class="w-2"><strong>Sector</strong></td>
    <td class="w-3">{{ $datos->sector }}</td>
  </tr>
  <tr>
    <td><strong>Subsector</strong></td>
    <td>{{ $datos->subsector }}</td>
    <td><strong>Unidad de excavación</strong></td>
    <td>{{ $datos->unidad_excavacion }}</td>
  </tr>
  <tr>
    <td><strong>Contexto</strong></td>
    <td>{{ $datos->contexto }}</td>
    <td><strong>Capa</strong></td>
    <td>{{ $datos->capa }}</td>
  </tr>
  <tr>
    <td><strong>Nivel</strong></td>
    <td>{{ $datos->nivel }}</td>
    <td><strong>Profundidad</strong></td>
    <td>{{ $datos->profundidad }}</td>
  </tr>
  <tr>
    <td><strong>WGS84 Este</strong></td>
    <td>{{ $datos->wgs84_este }}</td>
    <td><strong>WGS84 Norte</strong></td>
    <td>{{ $datos->wgs84_norte }}</td>
  </tr>
  <tr>
    <td><strong>Peso</strong></td>
    <td>
      @if ($datos->peso)
      {{ $datos->peso }} g
      @endif
    </td>
    <td><strong>Código de muestra</strong></td>
    <td>{{ $datos->codigo_muestra }}</td>
  </tr>
  <tr>
    <td><strong>Muestreado por</strong></td>
    <td>{{ $datos->muestreado_por }}</td>
    <td><strong>Fecha de muestreo</strong></td>
    <td>{{ $datos->fecha_muestreo }}</td>
  </tr>
</table>
<h2 class="subtitle">4. OBSERVACIÓN Y REGISTRO MEDIANTE MICROSCOPÍA ÓPTICA</h2>
<h3>4.1 Generalidades</h3>
<table class="fixed full-bordered">
  <tr>
    <td class="w-2"></td>
    <td class="w-4"></td>
    <td class="w-6"><strong>Observaciones</strong></td>
  </tr>
  <tr>
    <td><strong>Estado de conservación</strong></td>
    <td>{{ $datos->estadoConservacion->denominacion }}</td>
    <td>
      {{ $datos->observaciones_estado_conservacion }}
    </td>
  </tr>
  <tr>
    <td><strong>Parte de la vasija</strong></td>
    <td>{{ $datos->reporte_parte_vasija }}</td>
    <td>
      {{ $datos->observaciones_parte_vasija }}
    </td>
  </tr>
  <tr>
    <td><strong>Posible forma del objeto</strong></td>
    <td>{{ $datos->tipo_vasija }}</td>
    <td>
      {{ $datos->observaciones_tipo_vasija }}
    </td>
  </tr>
  <tr>
    <td><strong>Decoración</strong></td>
    <td>
      @if ($datos->decoracion_presente)
        Si
      @else
        No
      @endif
    </td>
    <td>
      {{ $datos->observaciones_decoracion }}
    </td>
  </tr>
  <tr>
    <td><strong>Tratamiento de la superficie externa</strong></td>
    <td>{{ $datos->reporte_tratamiento_superficie_externa }}</td>
    <td>
      {{ $datos->observaciones_tratamiento_externo }}
    </td>
  </tr>
  <tr>
    <td><strong>Tratamiento de la superficie interna</strong></td>
    <td>{{ $datos->reporte_tratamiento_superficie_interna }}</td>
    <td>
      {{ $datos->observaciones_tratamiento_interno }}
    </td>
  </tr>
</table>
<h3>4.2 Observaciones en sección pulida o pasta fresca</h3>
<table class="fixed full-bordered">
  <tr>
    <td class="w-2"></td>
    <td class="w-4 text-right"><strong>Microfotografía</strong></td>
    <td class="w-6" rowspan="4">
      <img class="foto-adicional center-block" src="{{ url($datos->ruta_microfotografia) }}" alt="">
    </td>
  </tr>
  <tr>
    <td><strong>Espesor de sección</strong></td>
    <td>
      @if ($datos->espesor_seccion)
      {{ $datos->espesor_seccion }} mm
      @endif
    </td>
  </tr>
  <tr>
    <td><strong>Color inclusiones</strong></td>
    <td>
      {{ $datos->color_inclusiones }}
    </td>
  </tr>
  <tr>
    <td><strong>Estimación visual del área en % de inclusiones</strong></td>
    <td>
      {{ $datos->area_porcentaje_inclusiones }}
    </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td><strong>Observaciones</strong></td>
  </tr>
  <tr>
    <td><strong>Textura de pasta</strong></td>
    <td>{{ $datos->textura_pasta }}</td>
    <td>{{ $datos->observaciones_textura_pasta }}</td>
  </tr>
  <tr>
    <td><strong>Forma de inclusiones</strong></td>
    <td>{{ $datos->reporte_forma_inclusiones }}</td>
    <td>{{ $datos->observaciones_forma_inclusiones }}</td>
  </tr>
  <tr>
    <td><strong>Porosidad</strong></td>
    <td>{{ $datos->porosidad }}</td>
    <td>{{ $datos->metodos_obtencion_porosidad }}</td>
  </tr>
  <tr>
    <td><strong>Modo de cocción</strong></td>
    <td>{{ $datos->reporte_modo_coccion }}</td>
    <td>{{ $datos->observaciones_modo_coccion }}</td>
  </tr>
  <tr>
    <td><strong>Rangos granulométricos</strong></td>
    <td>{{ $datos->rangos_granulometricos }}</td>
    <td>{{ $datos->metodos_obtencion_rangos_granulometricos }}</td>
  </tr>
  <tr>
    <td><strong>Relación: inclusiones/matriz arcillosa</strong></td>
    <td>{{ $datos->relaciones_inclusiones_matriz_arcillosa }}</td>
    <td>{{ $datos->metodos_obtencion_relaciones_inclusiones_matriz }}</td>
  </tr>
</table>
<h2 class="subtitle">5. ANÁLISIS QUÍMICO/ELEMENTAL</h2>
<table class="fixed bordered">
  <tr>
    <td><strong>Técnica</strong></td>
    <td>{{ $datos->tecnica_analisis_quimico }}</td>
    <td><strong>Equipo</strong></td>
    <td>{{ $datos->equipo_analisis_quimico }}</td>
    <td><strong>Análisis destructivo</strong></td>
    <td>
      @if ($datos->analisis_quimico_destructivo)
        Si
      @else
        No
      @endif
    </td>
  </tr>
</table>
<h3>5.1 Pastas</h3>
<table class="fixed bordered">
  <tr>
    <td class="w-2"><strong>Elementos mayores</strong></td>
    <td class="w-4">{{ $datos->elementos_mayores_pasta }}</td>
    <td class="w-2"><strong>Elementos menores y trazas</strong></td>
    <td class="w-4">{{ $datos->elementos_menores_pasta }}</td>
  </tr>
</table>
<h3>5.2 Decoración pintada</h3>
<table class="fixed bordered">
  <tr>
    <td class="w-2"><strong>Elementos mayores</strong></td>
    <td class="w-4">{{ $datos->elementos_mayores_decoracion }}</td>
    <td class="w-2"><strong>Elementos menores y trazas</strong></td>
    <td class="w-4">{{ $datos->elementos_menores_decoracion }}</td>
  </tr>
</table>
<table class="bordered">
  <tr>
    <td><strong>Resultados del análisis químico</strong></td>
  </tr>
  <tr>
    <td>{{ $datos->resultados_analisis_quimico }}</td>
  </tr>
</table>
<h2 class="subtitle">6. ANÁLISIS ESTRUCTURAL</h2>
<table class="fixed bordered">
  <tr>
    <td><strong>Técnica</strong></td>
    <td>{{ $datos->tecnica_analisis_estructural }}</td>
    <td><strong>Equipo</strong></td>
    <td>{{ $datos->equipo_analisis_estructural }}</td>
    <td><strong>Análisis destructivo</strong></td>
    <td>
      @if ($datos->analisis_estructural_destructivo)
        Si
      @else
        No
      @endif
    </td>
  </tr>
</table>
<table class="bordered">
  <tr>
    <td><strong>Resultados del análisis estructural</strong></td>
  </tr>
  <tr>
    <td>{{ $datos->resultados_analisis_estructural }}</td>
  </tr>
</table>
<h2 class="subtitle">7. CONCLUSIONES</h2>
<p class="bordered descripcion">{{ $datos->conclusiones }}</p>
<h2 class="subtitle">8. OBSERVACIONES</h2>
<p class="bordered descripcion">{{ $datos->observaciones }}</p>
<h2 class="subtitle">9. DATOS DE CONTROL</h2>
<table class="bordered fixed">
  <tr>
    <td><strong>Responsable</strong></td>
    <td class="w-5">{{ $datos->registrador->name }}</td>
    <td><strong>Fecha</strong></td>
    <td>{{ $datos->created_at }}</td>
  </tr>
</table>
@endsection
