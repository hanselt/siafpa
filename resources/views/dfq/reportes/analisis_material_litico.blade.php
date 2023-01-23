@extends('dfq.reportes.partials.base')

@section('title', 'FICHA DE ANÁLISIS DE MATERIAL LÍTICO')

@section('content')
<h1 class="text-center"><strong>FICHA DE ANÁLISIS DE MATERIAL LÍTICO</strong></h1>
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
<h2 class="subtitle">3. INFORMACIÓN DE LA MUESTRA</h2>
<table class="bordered fixed">
  <tr>
    <td class="w-2"><strong>Tipo</strong></td>
    <td class="w-3">{{ $datos->tipo_muestra['label'] }}</td>
    <td class="w-2"><strong>Cantidad</strong></td>
    <td class="w-3">{{ $datos->cantidad_muestra }}</td>
  </tr>
  <tr>
    <td><strong>Unidad de medida</strong></td>
    <td>{{ $datos->unidad_medida_muestra }}</td>
    <td><strong>Observaciones</strong></td>
    <td>{{ $datos->observaciones_muestra }}</td>
  </tr>
  <tr>
    <td colspan="4"><strong>Sobre los análisis solicitados</strong></td>
  </tr>
  <tr>
    <td colspan="4">{{ $datos->analisis_solicitados_muestra }}</td>
  </tr>
</table>
<h2 class="subtitle">4. INFORMACIÓN EN LA ETIQUETA DE REMISIÓN</h2>
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
<h2 class="subtitle">5. CARACTERIZACIÓN DE LA MUESTRA</h2>
<h3>5.1 Análisis Químico</h3>
<table class="fixed bordered">
  <tr>
    <td><strong>Método de análisis</strong></td>
    <td>{{ $datos->metodo_analisis }}</td>
    <td><strong>Modo</strong></td>
    <td>{{ $datos->modo }}</td>
  </tr>
  <tr>
    <td><strong>Tiempo total de irradiación</strong></td>
    <td>{{ $datos->tiempo_total_irradiacion }}</td>
    <td><strong>Tiempo por filtro</strong></td>
    <td>{{ $datos->tiempo_por_filtro }}</td>
  </tr>
  <tr>
    <td><strong>N° filtros</strong></td>
    <td>{{ $datos->nro_filtros }}</td>
    <td><strong>N° lecturas ejecutadas</strong></td>
    <td>{{ $datos->nro_lecturas_ejecutadas }}</td>
  </tr>
</table>
<h3>5.2 Resultados de caracterización química</h3>
<table class="fixed bordered">
  <tr>
    <td><strong>Elementos mayoritarios</strong></td>
    <td><strong>Elementos traza</strong></td>
  </tr>
  <tr>
    <td>{{ $datos->elementos_mayoritarios }}</td>
    <td>{{ $datos->elementos_traza }}</td>
  </tr>
  <tr>
    <td><strong>Rasgos significativos</strong></td>
    <td><strong>Elementos químicos seleccionados para determinar procedencia</strong></td>
  </tr>
  <tr>
    <td>{{ $datos->rasgos_significativos }}</td>
    <td>{{ $datos->elementos_procedencia }}</td>
  </tr>
</table>
@if ($datos->tipo_muestra['tipo'] === 'obsidiana')
<h3>5.3 Análisis estadístico</h3>
<table class="bordered fixed">
  <tr>
    <td><strong>Estadísticos descriptivos</strong></td>
    <td>{{ $datos->estadisticos_descriptivos }}</td>
    <td><strong>Nivel de confianza</strong></td>
    <td>
      @if ($datos->textura)
      {{ $datos->textura }} %
      @endif
    </td>
  </tr>
  <tr>
    <td><strong>Estadístico multivariante</strong></td>
    <td>{{ $datos->estadistico_multivariante }}</td>
    <td><strong>Método de clasificación</strong></td>
    <td>{{ $datos->metodo_clasificacion }}</td>
  </tr>
  <tr>
    <td><strong>Distancia</strong></td>
    <td>{{ $datos->distancia }}</td>
    <td><strong>Paquete estadístico</strong></td>
    <td>{{ $datos->paquete_estadistico }}</td>
  </tr>
</table>
<h3>5.4 Resultados de procedencia</h3>
<table class="bordered fixed">
  <tr>
    <td><strong>Patrón comparativo</strong></td>
    <td>{{ $datos->patron_comparativo }}</td>
    <td><strong>Cantera / Tipo Químico</strong></td>
    <td>{{ $datos->cantera_tipo_quimico }}</td>
  </tr>
  <tr>
    <td><strong>Descripción de ubicación</strong></td>
    <td>{{ $datos->descripcion_ubicacion }}</td>
    <td><strong>Procedencia de la muestra</strong></td>
    <td>{{ $datos->procedencia_muestra }}</td>
  </tr>
</table>
@elseif($datos->tipo_muestra['tipo'] === 'litico')
<h3>5.3 Descripción megascópica</h3>
<table class="bordered fixed">
  <tr>
    <td><strong>Estructura</strong></td>
    <td>{{ $datos->estructura }}</td>
    <td><strong>Textura</strong></td>
    <td>{{ $datos->textura }}</td>
  </tr>
  <tr>
    <td><strong>Color de matriz</strong></td>
    <td>{{ $datos->color_matriz }}</td>
    <td><strong>Color de clastos o granos</strong></td>
    <td>{{ $datos->color_clastos_granos }}</td>
  </tr>
  <tr>
    <td><strong>Tamaño de grano</strong></td>
    <td>{{ $datos->tamano_grano }}</td>
    <td><strong>Dureza</strong></td>
    <td>{{ $datos->dureza }}</td>
  </tr>
</table>
<h3>5.4 Descripción microscópica</h3>
<table class="bordered fixed">
  <tr>
    <td><strong>Minerales primarios</strong></td>
    <td>{{ $datos->minerales_primarios }}</td>
    <td><strong>Minerales secundarios</strong></td>
    <td>{{ $datos->minerales_secundarios }}</td>
  </tr>
  <tr>
    <td><strong>Minerales accesorios</strong></td>
    <td colspan="3">{{ $datos->minerales_accesorios }}</td>
  </tr>
</table>
<h3>5.5 Resultados</h3>
<table class="bordered fixed">
  <tr>
    <td><strong>Origen</strong></td>
    <td>{{ $datos->origen }}</td>
    <td><strong>Clasificación</strong></td>
    <td>{{ $datos->clasificacion }}</td>
  </tr>
  <tr>
    <td><strong>Nombre</strong></td>
    <td colspan="3">{{ $datos->nombre }}</td>
  </tr>
</table>
@endif
<h2 class="subtitle">6. CONCLUSIONES</h2>
<p class="bordered descripcion">{{ $datos->conclusiones }}</p>
<h2 class="subtitle">7. OBSERVACIONES</h2>
<p class="bordered descripcion">{{ $datos->observaciones }}</p>
<h2 class="subtitle">8. DATOS DE CONTROL</h2>
<table class="bordered fixed">
  <tr>
    <td><strong>Responsable</strong></td>
    <td class="w-5">{{ $datos->registrador->name }}</td>
    <td><strong>Fecha</strong></td>
    <td>{{ $datos->created_at }}</td>
  </tr>
</table>
@endsection
