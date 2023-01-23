@extends('dfq.reportes.partials.base')

@section('title', 'FICHA DE ANÁLISIS DE AGUAS')

@section('content')
<h1 class="text-center"><strong>FICHA DE ANÁLISIS DE AGUAS</strong></h1>
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
    <td><strong>Código de muestra</strong></td>
    <td>{{ $datos->codigo_muestra }}</td>
    <td><strong>Muestreado por</strong></td>
    <td>{{ $datos->muestreado_por }}</td>
  </tr>
  <tr>
    <td><strong>Fecha de muestreo</strong></td>
    <td>{{ $datos->fecha_muestreo }}</td>
    <td><strong>Peso</strong></td>
    <td>
      @if ($datos->peso)
        {{ $datos->peso }} g
      @endif
    </td>
  </tr>
  <tr>
    <td><strong>Fuente</strong></td>
    <td>{{ $datos->fuente }}</td>
    <td><strong>Volumen</strong></td>
    <td>
      @if ($datos->volumen)
        {{ $datos->volumen }} ml
      @endif
    </td>
  </tr>
</table>
<h2 class="subtitle">4. ANÁLISIS FÍSICO</h2>
<table class="fixed bordered">
  <tr>
    <td><strong>Color</strong></td>
    <td>{{ $datos->color }}</td>
    <td><strong>Olor</strong></td>
    <td>{{ $datos->olor }}</td>
    <td><strong>Sabor</strong></td>
    <td>{{ $datos->sabor }}</td>
  </tr>
  <tr>
    <td><strong>pH</strong></td>
    <td>{{ $datos->ph }}</td>
    <td><strong>Conductividad</strong></td>
    <td>{{ $datos->conductividad }}</td>
    <td><strong>Turbidez</strong></td>
    <td>{{ $datos->turbidez }}</td>
  </tr>
  <tr>
    <td><strong>Sólidos disueltos</strong></td>
    <td>{{ $datos->solidos_disueltos }}</td>
    <td><strong>Sólidos suspendidos</strong></td>
    <td>{{ $datos->solidos_suspendidos }}</td>
    <td><strong>Sólidos totales</strong></td>
    <td>{{ $datos->solidos_totales }}</td>
  </tr>
</table>
<h2 class="subtitle">5. ANÁLISIS QUÍMICO</h2>
<table class="fixed bordered">
  <tr>
    <td><strong>Alcalinidad</strong></td>
    <td>{{ $datos->alcalinidad }}</td>
    <td><strong>Acidez</strong></td>
    <td>{{ $datos->acidez }}</td>
    <td><strong>Dureza</strong></td>
    <td>{{ $datos->dureza }}</td>
  </tr>
  <tr>
    <td><strong>Cloruros</strong></td>
    <td>{{ $datos->cloruros }}</td>
    <td><strong>Cloro libre</strong></td>
    <td>{{ $datos->cloro_libre }}</td>
    <td><strong>Sulfatos</strong></td>
    <td>{{ $datos->sulfatos }}</td>
  </tr>
  <tr>
    <td><strong>Nitratos</strong></td>
    <td>{{ $datos->nitratos }}</td>
    <td><strong>Fosfatos</strong></td>
    <td>{{ $datos->fosfatos }}</td>
    <td><strong>DBO</strong></td>
    <td>{{ $datos->dbo }}</td>
  </tr>
  <tr>
    <td><strong>Detergentes</strong></td>
    <td>{{ $datos->detergentes }}</td>
    <td><strong>Hierro</strong></td>
    <td>{{ $datos->hierro }}</td>
    <td><strong>Cobre</strong></td>
    <td>{{ $datos->cobre }}</td>
  </tr>
</table>
<h2 class="subtitle">6. ANÁLISIS MICROBIOLÓGICO</h2>
<table class="fixed bordered">
  <tr>
    <td></td>
    <td></td>
    <td><strong>Valores referenciales</strong></td>
  </tr>
  <tr>
    <td><strong>Coliformes totales NMP/100ml</strong></td>
    <td>{{ $datos->coliformes_totales }}</td>
    <td>{{ $datos->valores_referenciales_coliformes_totales }}</td>
  </tr>
  <tr>
    <td><strong>Coliformes termotolerantes NMP/100ml</strong></td>
    <td>{{ $datos->coliformes_termotolerantes }}</td>
    <td>{{ $datos->valores_referenciales_coliformes_termotolerantes }}</td>
  </tr>
  <tr>
    <td><strong>Escherichia coli UFC/ml</strong></td>
    <td>{{ $datos->escherichia_coli }}</td>
    <td>{{ $datos->valores_referenciales_escherichia_coli }}</td>
  </tr>
</table>
<table class="bordered">
  <tr>
    <td><strong>Conclusión</strong></td>
  </tr>
  <tr>
    <td>{{ $datos->conclusion_analisis_microbiologico }}</td>
  </tr>
</table>
<h2 class="subtitle">7. ANÁLISIS PARASITOLÓGICO</h2>
<table class="fixed bordered">
  <tr>
    <td class="w-2"><strong>Parásito hallado</strong></td>
    <td class="w-3">{{ $datos->reporte_parasito_hallado }}</td>
    <td class="w-2"><strong>Forma infectante</strong></td>
    <td class="w-3">{{ $datos->reporte_forma_infectante }}</td>
  </tr>
  <tr>
    <td><strong>Otra forma infectante</strong></td>
    <td>{{ $datos->otra_forma_infectante }}</td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Taxonomía</strong></td>
    <td colspan="2"><strong>Descripción</strong></td>
  </tr>
  <tr>
    <td colspan="2" class="ws-pw">{{ $datos->taxonomia_parasito }}</td>
    <td colspan="2" class="ws-pw">{{ $datos->descripcion_parasito }}</td>
  </tr>
</table>
<table class="bordered">
  <tr>
    <td><strong>Conclusión</strong></td>
  </tr>
  <tr>
    <td>{{ $datos->conclusion_analisis_parasitologico }}</td>
  </tr>
</table>
<h2 class="subtitle">8. DETERMINACIÓN DE ALGAS</h2>
<table class="fixed bordered">
  <tr>
    <td><strong>Taxonomía</strong></td>
    <td><strong>Descripción</strong></td>
  </tr>
  <tr>
    <td class="ws-pw">{{ $datos->taxonomia_algas }}</td>
    <td class="ws-pw">{{ $datos->descripcion_algas }}</td>
  </tr>
</table>
<table class="bordered">
  <tr>
    <td><strong>Conclusión</strong></td>
  </tr>
  <tr>
    <td>{{ $datos->conclusion_determinacion_algas }}</td>
  </tr>
</table>
<h2 class="subtitle">9. REGISTRO FOTOGRÁFICO</h2>
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
<h2 class="subtitle">10. CONCLUSIONES</h2>
<p class="bordered descripcion">{{ $datos->conclusiones }}</p>
<h2 class="subtitle">11. OBSERVACIONES</h2>
<p class="bordered descripcion">{{ $datos->observaciones }}</p>
<h2 class="subtitle">12. DATOS DE CONTROL</h2>
<table class="bordered fixed">
  <tr>
    <td><strong>Responsable</strong></td>
    <td class="w-5">{{ $datos->registrador->name }}</td>
    <td><strong>Fecha</strong></td>
    <td>{{ $datos->created_at }}</td>
  </tr>
</table>
@endsection
