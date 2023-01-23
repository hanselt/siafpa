@extends('dfq.reportes.partials.base')

@section('title', 'FICHA DE ANÁLISIS DE MATERIALES')

@section('content')
<h1 class="text-center"><strong>FICHA DE ANÁLISIS DE MATERIALES</strong></h1>
<h2 class="subtitle">1. INFORMACIÓN GENERAL</h2>
<table class="fixed bordered">
  <tr>
    <td class="w-2"><strong>Nro. Ficha</strong></td>
    <td class="w-2">{{ $datos->nro_ficha }}</td>
    <td class="w-1"><strong>Código</strong></td>
    <td class="w-5">{{ $datos->codigo }}</td>
  </tr>
  <tr>
    <td><strong>Gestión Documentaria</strong></td>
    <td>{{ $datos->gestion_documentaria }}</td>
    <td><strong>Solicitante</strong></td>
    <td>{{ $datos->solicitante }}</td>
  </tr>
  <tr>
    <td><strong>Solicitud de servicio</strong></td>
    <td>{{ $datos->solicitud_servicio }}</td>
    <td><strong>Fecha</strong></td>
    <td>{{ $datos->fecha_solicitud_servicio }}</td>
  </tr>
  <tr>
    <td><strong>Documento respuesta</strong></td>
    <td>{{ $datos->documento_respuesta }}</td>
    <td><strong>Fecha</strong></td>
    <td>{{ $datos->fecha_documento_respuesta }}</td>
  </tr>
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
    <td class="w-2"><strong>Tipo de muestra</strong></td>
    <td class="w-3">{{ $datos->tipo_muestra }}</td>
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
    <td colspan="4"><strong>Servicio solicitado</strong></td>
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
    <td><strong>Código de muestra</strong></td>
    <td>{{ $datos->codigo_muestra }}</td>
    <td><strong>Muestreado por</strong></td>
    <td>{{ $datos->muestreado_por }}</td>
  </tr>
  <tr>
    <td><strong>Fecha de muestreo</strong></td>
    <td>{{ $datos->fecha_muestreo }}</td>
    <td colspan="2"></td>
  </tr>
</table>
<h2 class="subtitle">5. DATOS MORFOLÓGICOS</h2>
<table class="fixed bordered">
  <tr>
    <td><strong>Estructura</strong></td>
    <td>{{ $datos->estructura }}</td>
    <td><strong>Textura</strong></td>
    <td>{{ $datos->textura }}</td>
    <td><strong>Tamaño de grano</strong></td>
    <td>{{ $datos->tamano_grano }}</td>
  </tr>
  <tr>
    <td><strong>Compactación</strong></td>
    <td>{{ $datos->compactacion }}</td>
    <td><strong>Color</strong></td>
    <td>{{ $datos->color }}</td>
    <td><strong>Datos relevantes</strong></td>
    <td>{{ $datos->datos_relevantes }}</td>
  </tr>
</table>
<h2 class="subtitle">6. ANÁLISIS FÍSICO</h2>
<table class="fixed bordered">
  <tr>
    <td><strong>Densidad real</strong></td>
    <td>
      @if ($datos->densidad_real)
      {{ $datos->densidad_real }} g/cm<sup>3</sup>
      @endif
    </td>
    <td><strong>% Humedad equivalente</strong></td>
    <td>{{ $datos->porcentaje_humedad_equivalente }}</td>
    <td><strong>Color Munsell</strong></td>
    <td>{{ $datos->color_munsell }}</td>
  </tr>
  <tr>
    <td><strong>Densidad aparente</strong></td>
    <td>
      @if ($datos->densidad_aparente)
      {{ $datos->densidad_aparente }} g/cm<sup>3</sup>
      @endif
    </td>
    <td><strong>% Capacidad de campo</strong></td>
    <td>{{ $datos->porcentaje_capacidad_campo }}</td>
    <td colspan="2"><strong>Análisis textural por sedimentación</strong></td>
  </tr>
  <tr>
    <td><strong>% Porosidad</strong></td>
    <td>{{ $datos->porcentaje_porosidad }}</td>
    <td><strong>Conductividad</strong></td>
    <td>
      @if ($datos->conductividad)
      {{ $datos->conductividad }} µs/cm
      @endif
    </td>
    <td colspan="2">{{ $datos->analisis_textural }}</td>
  </tr>
  <tr>
    <td><strong>% Humedad</strong></td>
    <td>{{ $datos->porcentaje_humedad }}</td>
    <td><strong>TDS</strong></td>
    <td>
      @if ($datos->tds)
      {{ $datos->tds }} mg/L
      @endif
    </td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td><strong>Compacidad</strong></td>
    <td>{{ $datos->compacidad }}</td>
    <td><strong>pH</strong></td>
    <td>{{ $datos->ph }}</td>
    <td colspan="2"></td>
  </tr>
</table>
<h2 class="subtitle">7. ANÁLISIS QUÍMICO</h2>
<table class="fixed bordered">
  <tr>
    <td class="w-3"></td>
    <td class="w-1"></td>
    <td class="w-3"></td>
    <td class="w-1"></td>
    <td class="w-3"></td>
    <td class="w-1"></td>
  </tr>
  <tr>
    <td colspan="2" class="text-center"><strong>Determinación de componentes en morteros de tierra</strong></td>
    <td colspan="2" class="text-center"><strong>Determinación de componentes en morteros con cal</strong></td>
    <td colspan="2" class="text-center"><strong>Determinación de nutrientes en tierras de cultivo*</strong></td>
  </tr>
  <tr>
    <td><strong>% de material fino</strong></td>
    <td class="text-center">{{ $datos->porcentaje_material_fino }}</td>
    <td><strong>% de residuo insoluble</strong></td>
    <td class="text-center">{{ $datos->porcentaje_residuo_insoluble }}</td>
    <td><strong>NPK (nutrientes)</strong></td>
    <td class="text-center">{{ $datos->nutrientes }}</td>
  </tr>
  <tr>
    <td><strong>% de material grava mediana</strong></td>
    <td class="text-center">{{ $datos->porcentaje_material_grava_mediana }}</td>
    <td><strong>% de fracción soluble</strong></td>
    <td class="text-center">{{ $datos->porcentaje_fraccion_soluble }}</td>
    <td><strong>% de Materia Orgánica</strong></td>
    <td class="text-center">{{ $datos->porcentaje_materia_organica }}</td>
  </tr>
  <tr>
    <td><strong>% de material grava gruesa</strong></td>
    <td class="text-center">{{ $datos->porcentaje_material_grava_gruesa }}</td>
    <td><strong>% CaOH<sub>2 (Cal apagada)</sub></strong></td>
    <td class="text-center">{{ $datos->porcentaje_cal_apagada }}</td>
    <td><strong>Análisis de micronutrientes</strong></td>
    <td class="text-center">{{ $datos->analisis_micronutrientes }}</td>
  </tr>
  <tr>
    <td><strong>% de material orgánico presente</strong></td>
    <td class="text-center">{{ $datos->porcentaje_material_organico_presente }}</td>
    <td><strong>% Agregado</strong></td>
    <td class="text-center">{{ $datos->porcentaje_agregado }}</td>
    <td><strong>Bases intercambiables</strong></td>
    <td class="text-center">{{ $datos->bases_intercambiables }}</td>
  </tr>
  <tr>
    <td><strong>% de otros aditivos</strong></td>
    <td class="text-center">{{ $datos->porcentaje_otros_aditivos }}</td>
    <td><strong>Relación conglomerante / agregado</strong></td>
    <td class="text-center">{{ $datos->relacion_conglomerante_agregado }}</td>
    <td><strong>Capacidad Intercambio Catiónico</strong></td>
    <td class="text-center">{{ $datos->capacidad_intercambio_cationico }}</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Análisis Químico elemental por:</strong></td>
    <td>Análisis químico por FRX</td>
    <td class="text-center">
      @if ($datos->analisis_quimico_por === 'FRX')
        X
      @endif
    </td>
    <td>Análisis Químico por UV -VIS</td>
    <td class="text-center">
      @if ($datos->analisis_quimico_por === 'UV -VIS')
        X
      @endif
    </td>
  </tr>
</table>
<h2 class="subtitle">8. ANÁLISIS MECÁNICO</h2>
<table class="fixed bordered">
  <tr>
    <td class="w-3"></td>
    <td class="w-1"></td>
    <td class="w-3"></td>
    <td class="w-1"></td>
    <td class="w-3"></td>
    <td class="w-1"></td>
  </tr>
  <tr>
    <td colspan="2" class="text-center"><strong>Límites de Atterberg</strong></td>
    <td><strong>Contracción Lineal</strong></td>
    <td class="text-center">{{ $datos->contraccion_lineal }}</td>
    <td colspan="2" class="text-center"><strong>Análisis de Resistencia</strong></td>
  </tr>
  <tr>
    <td><strong>Límite Líquido</strong></td>
    <td class="text-center">{{ $datos->limite_liquido }}</td>
    <td colspan="2" class="text-center"><strong>Análisis Granulométrico</strong></td>
    <td rowspan="2"><strong>Resistencia a compresión simple</strong></td>
    <td rowspan="2" class="text-center">
      @if ($datos->resistencia_simple)
        {{ $datos->resistencia_simple }} kg/cm<sup>2</sup>
      @endif
    </td>
  </tr>
  <tr>
    <td><strong>Límite Plástico</strong></td>
    <td class="text-center">{{ $datos->limite_plastico }}</td>
    <td><strong>Coeficiente de Uniformidad</strong></td>
    <td class="text-center">{{ $datos->coeficiente_uniformidad }}</td>
  </tr>
  <tr>
    <td><strong>Índice de Plasticidad</strong></td>
    <td class="text-center">{{ $datos->indice_plasticidad }}</td>
    <td><strong>Coeficiente de Curvatura</strong></td>
    <td class="text-center">{{ $datos->coeficiente_curvatura }}</td>
    <td rowspan="2"><strong>Resistencia a compresión Triaxial</strong></td>
    <td rowspan="2" class="text-center">
      @if ($datos->resistencia_triaxial)
        {{ $datos->resistencia_triaxial }} kg/cm<sup>2</sup>
      @endif
    </td>
  </tr>
  <tr>
    <td colspan="2" class="text-center"><strong>Clasificación SUCS</strong></td>
    <td colspan="2" class="text-center"><strong>Clasificación SUCS</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="text-center">
      CL<br>
      {{ $datos->clasificacion_sucs_cl }}
    </td>
    <td colspan="2" class="text-center">
      GP<br>
      {{ $datos->clasificacion_sucs_gp }}
    </td>
    <td colspan="2"></td>
  </tr>
</table>
<h2 class="subtitle">9. ANÁLISIS ESTRATIGRÁFICO</h2>
<table class="bordered">
  <thead>
    <tr>
      <th class="text-center">N° de<br>estrato</th>
      <th class="text-center">Color</th>
      <th class="text-center">Espesor</th>
      <th class="text-center">Denominación</th>
      <th class="text-center">Medio<br>aglutinante</th>
      <th class="text-center">Caracterización<br>química</th>
      <th class="text-center">Descripción del estrato</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datos->estratos as $estrato)
    <tr>
      <td class="text-center">{{ $loop->index + 1 }}</td>
      <td class="text-center">{{ $estrato['color'] }}</td>
      <td class="text-center">{{ $estrato['espesor'] }} µm</td>
      <td class="text-center">{{ $estrato['denominacion'] }}</td>
      <td class="text-center">{{ $estrato['medio_aglutinante'] }}</td>
      <td class="text-center">{{ $estrato['caracterizacion_quimica'] }}</td>
      <td class="text-center">{{ $estrato['descripcion'] }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<h2 class="subtitle">10. REGISTRO FOTOGRÁFICO</h2>
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
<h2 class="subtitle">11. CONCLUSIONES</h2>
<p class="bordered descripcion">{{ $datos->conclusiones }}</p>
<h2 class="subtitle">12. OBSERVACIONES</h2>
<p class="bordered descripcion">{{ $datos->observaciones }}</p>
<h2 class="subtitle">13. DATOS DE CONTROL</h2>
<table class="bordered fixed">
  <tr>
    <td><strong>Responsable</strong></td>
    <td class="w-5">{{ $datos->registrador->name }}</td>
    <td><strong>Fecha</strong></td>
    <td>{{ $datos->created_at }}</td>
  </tr>
</table>
@endsection
