@extends('dfq.reportes.partials.base')

@section('title', 'FICHA DE ANÁLISIS DE METALES')

@section('content')
<h1 class="text-center"><strong>FICHA DE ANÁLISIS DE METALES</strong></h1>
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
    <td colspan="2"></td>
  </tr>
</table>
<h2 class="subtitle">4. OBJETO Y DIMENSIONES</h2>
<table class="fixed bordered">
  <tr>
    <td class="w-2"><strong>Morfología</strong></td>
    <td class="w-3">{{ $datos->morfologia->denominacion }}</td>
    <td class="w-2"><strong>Peso</strong></td>
    <td class="w-3">
      @if ($datos->peso)
      {{ $datos->peso }} g
      @endif
    </td>
  </tr>
  <tr>
    <td><strong>Altura</strong></td>
    <td>
      @if ($datos->altura)
      {{ $datos->altura }} mm
      @endif
    </td>
    <td><strong>Largo</strong></td>
    <td>
      @if ($datos->largo)
      {{ $datos->largo }} mm
      @endif
    </td>
  </tr>
  <tr>
    <td><strong>Diámetro superior</strong></td>
    <td>
      @if ($datos->diametro_superior)
      {{ $datos->diametro_superior }} mm
      @endif
    </td>
    <td><strong>Diámetro inferior</strong></td>
    <td>
      @if ($datos->diametro_inferior)
      {{ $datos->diametro_inferior }} mm
      @endif
    </td>
  </tr>
  <tr>
    <td><strong>Ancho mínimo</strong></td>
    <td>
      @if ($datos->ancho_minimo)
      {{ $datos->ancho_minimo }} mm
      @endif
    </td>
    <td><strong>Ancho máximo</strong></td>
    <td>
      @if ($datos->ancho_maximo)
      {{ $datos->ancho_maximo }} mm
      @endif
    </td>
  </tr>
  <tr>
    <td><strong>Espesor mayor</strong></td>
    <td>
      @if ($datos->espesor_mayor)
      {{ $datos->espesor_mayor }} mm
      @endif
    </td>
    <td><strong>Espesor menor</strong></td>
    <td>
      @if ($datos->espesor_menor)
      {{ $datos->espesor_menor }} mm
      @endif
    </td>
  </tr>
</table>
<h2 class="subtitle">5. ESTADOS FÍSICO Y DE CONSERVACIÓN</h2>
<table class="fixed bordered">
  <tr>
    <td class="w-2"><strong>Estado físico</strong></td>
    <td class="w-3">{{ $datos->reporte_estado_fisico }}</td>
    <td class="w-2"><strong>Aspecto de la superficie</strong></td>
    <td class="w-3">{{ $datos->reporte_aspecto_superficie }}</td>
  </tr>
  <tr>
    <td><strong>Tipo de corrosión</strong></td>
    <td>{{ $datos->reporte_tipo_corrosion }}</td>
    <td><strong>Estado de corrosión</strong></td>
    <td>{{ $datos->reporte_estado_corrosion }}</td>
  </tr>
  <tr>
    <td><strong>Productos de corrosión</strong></td>
    <td>{{ $datos->reporte_productos_corrosion }}</td>
    <td colspan="2"></td>
  </tr>
</table>
<h2 class="subtitle">6. MANUFACTURA</h2>
<table class="fixed bordered">
  <tr>
    <td class="w-2"><strong>Técnicas de fabricación</strong></td>
    <td class="w-3">{{ $datos->reporte_tecnicas_fabricacion }}</td>
    <td class="w-2"><strong>Técnicas de agujereados</strong></td>
    <td class="w-3">{{ $datos->reporte_tecnicas_agujereados }}</td>
  </tr>
  <tr>
    <td><strong>Técnicas de cortado</strong></td>
    <td>{{ $datos->reporte_tecnicas_cortado }}</td>
    <td><strong>Técnicas de uniones mecánicas</strong></td>
    <td>{{ $datos->reporte_tecnicas_uniones_mecanicas }}</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Técnicas de uniones metálicas por calor</strong></td>
    <td colspan="2">{{ $datos->reporte_tecnicas_uniones_metalicas }}</td>
  </tr>
</table>
<h2 class="subtitle">7. ORNAMENTACIÓN</h2>
<table class="fixed bordered">
  <tr>
    <td class="w-2"><strong>Técnicas decorativas</strong></td>
    <td class="w-3">{{ $datos->reporte_tecnicas_decorativas }}</td>
    <td class="w-2"><strong>Técnicas de acabado</strong></td>
    <td class="w-3">{{ $datos->reporte_tecnicas_acabado }}</td>
  </tr>
  <tr>
    <td><strong>Decoraciones no metálicas</strong></td>
    <td>{{ $datos->reporte_decoraciones_no_metalicas }}</td>
    <td><strong>Otras decoraciones no metálicas</strong></td>
    <td>{{ $datos->reporte_otras_decoraciones_no_metalicas }}</td>
  </tr>
</table>
<h2 class="subtitle">8. ANÁLISIS QUÍMICO</h2>
<table class="fixed bordered">
  <tr>
    <td class="w-2"><strong>Aleaciones</strong></td>
    <td class="w-3">{{ $datos->reporte_aleaciones }}</td>
    <td class="w-2"><strong>Otras aleaciones</strong></td>
    <td class="w-3">{{ $datos->otras_aleaciones }}</td>
  </tr>
  <tr>
    <td><strong>Cubrimientos metálicos</strong></td>
    <td colspan="3">{{ $datos->reporte_cubrimientos_metalicos }}</td>
  </tr>
</table>
<div class="break"></div>
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
