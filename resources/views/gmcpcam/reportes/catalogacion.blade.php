@extends('gmcpcam.reportes.partials.base')

@section('title', 'FICHA DE CATALOGACIÓN DE BIENES ARQUEOLOGICOS MUEBLES')

@section('body-class', 'font-regular')

@section('content')
  <p class="text-center"><strong>FICHA TECNICA DE CATALOGACION - BIENES CULTURALES ARQUEOLOGICOS</strong></p>
  <p class="text-center"><strong>LEY N° 28296 (Cap. III Arts. 14, 15 y 16)</strong></p>
  <table class="full-bordered fixed">
    <tr class="text-center">
      <td><strong>N° DE REGISTRO NACIONAL</strong></td>
      <td><strong>POSEEDOR</strong></td>
      <td><strong>INV.GAB.</strong></td>
      <td><strong>GRUPO</strong></td>
      <td><strong>TIPO</strong></td>
      <td><strong>CÓDIGO</strong></td>
    </tr>
    <tr class="text-center">
      <td>{{ $datos->nro_registro_nacional }}</td>
      <td>{{ $datos->poseedor }}</td>
      <td>{{ $datos->detalleInventario->nro_inv }}</td>
      <td>{{ $datos->grupo }}</td>
      <td>{{ $datos->material->codificacion }}</td>
      <td>{{ $datos->material->abreviatura }} {{ $datos->codigo }}</td>
    </tr>
  </table>
  <h2 class="subtitle">1. DATOS DE IDENTIFICACION</h2>
  <table class="fixed bordered">
    <tr>
      <td><strong>BIEN CULTURAL:</strong></td>
      <td colspan="2">{{ $datos->bienCultural->denominacion }}</td>
      <td class="text-center w-4 bordered"><strong>FOTOGRAFIA</strong></td>
    </tr>
    <tr>
      <td><strong>MATERIAL:</strong></td>
      <td>{{ $datos->material->denominacion }}</td>
      <td>{{ $datos->reporte_especie_tipo_clase }} </td>
      <td rowspan="9" class="bordered">
        <img class="fotografia center-block" src="{{ url($datos->ruta_fotografia) }}" alt="">
        <p class="text-center">Vista general</p>
      </td>
    </tr>
    <tr>
      <td><strong>CULTURA/ESTILO:</strong></td>
      <td colspan="2">{{ $datos->culturaEstilo->denominacion }}</td>
    </tr>
    <tr>
      <td><strong>CRONOLOGIA:</strong></td>
      <td colspan="2">
        {{ $datos->cronologia()->first()->denominacion }}
        @if ($datos->descripcion_adicional_cronologia)
          <br> {{ $datos->descripcion_adicional_cronologia }}
        @endif
      </td>
    </tr>
    <tr>
      <td colspan="3" class="bordered subtitle">2. DATOS DE PROCEDENCIA</td>
    </tr>
    <tr>
      <td><strong>2.1. MODALIDAD DE INTERVENCION:</strong></td>
      <td colspan="2">{{ $datos->detalleInventario->inventario->proyecto->modalidad_intervencion }}</td>
    </tr>
    <tr>
      <td colspan="3"><strong>2.2. NOMBRE DEL PROYECTO:</strong></td>
    </tr>
    <tr>
      <td colspan="3" class="text-justify">{{ $datos->detalleInventario->inventario->reporte_proyecto_nombre }}</td>
    </tr>
    <tr>
      <td><strong>2.3. PERÍODO DE INTERVENCION:</strong></td>
      <td colspan="2">{{ $datos->detalleInventario->inventario->periodo }}</td>
    </tr>
    <tr>
      <td><strong>2.4. RESPONSABLE:</strong></td>
      <td colspan="2">{{ $datos->detalleInventario->inventario->proyecto->nombre_responsable }}</td>
    </tr>
  </table>
  <table class="fixed full-bordered">
    <tr>
      <td colspan="2"><strong>2.5. UBICACIÓN:</strong></td>
      <td colspan="2"><strong>2.6. DATOS DE TARJETA DE CAMPO:</strong></td>
    </tr>
    <tr>
      <td><strong>ORIGEN:</strong></td>
      <td>{{ $datos->detalleInventario->inventario->proyecto->origen }}</td>
      <td><strong>SITIO / SECTOR:</strong></td>
      <td>{{ $datos->sector }}</td>
    </tr>
    <tr>
      <td ><strong>CN-N°:</strong></td>
      <td>{{ $datos->detalleInventario->inventario->proyecto->ubigeo }}</td>
      <td><strong>SUB SECTOR:</strong></td>
      <td>{{ $datos->subsector }}</td>
    </tr>
    <tr>
      <td><strong>DEPARTAMENTO:</strong></td>
      <td>{{ $datos->detalleInventario->inventario->proyecto->departamento }}</td>
      <td><strong>U.E:</strong></td>
      <td>{{ $datos->unidad_excavacion }}</td>
    </tr>
    <tr>
      <td><strong>PROVINCIA:</strong></td>
      <td>{{ $datos->detalleInventario->inventario->proyecto->provincia }}</td>
      <td><strong>CONTEXTO:</strong></td>
      <td>{{ $datos->contexto }}</td>
    </tr>
    <tr>
      <td><strong>DISTRITO:</strong></td>
      <td>{{ $datos->detalleInventario->inventario->proyecto->distrito }}</td>
      <td><strong>CAPA/NIVEL:</strong></td>
      <td>{{ $datos->capa_nivel }}</td>
    </tr>
    <tr>
      <td><strong>ANEXO :</strong></td>
      <td>{{ $datos->detalleInventario->inventario->proyecto->anexo }}</td>
      <td><strong>COORDENADAS UTM:</strong></td>
      <td>{{ $datos->coordenadas_utm }}</td>
    </tr>
    <tr>
      <td><strong>CC.PP:</strong></td>
      <td>{{ $datos->detalleInventario->inventario->proyecto->centro_poblado }}</td>
      <td><strong>FECHA DE HALLAZGO:</strong></td>
      <td>{{ $datos->fecha_hallazgo }}</td>
    </tr>
  </table>
  <h2 class="subtitle">3. DATOS DEL POSEEDOR DEL BIEN CULTURAL</h2>
  <table class="fixed bordered">
    <tr>
      <td><strong>COD. DE CAJA DE INGRESO:</strong></td>
      <td colspan="4">{{ $datos->detalleInventario->inventario->proyecto->codigo_caja }}</td>
    </tr>
    <tr>
      <td><strong>DOC. INGRESO:</strong></td>
      <td colspan="4">{{ $datos->detalleInventario->inventario->proyecto->documento_ingreso }}</td>
    </tr>
    <tr>
      <td><strong>SITUACIÓN LEGAL:</strong></td>
      <td colspan="4">{{ $datos->situacion_legal }}</td>
    </tr>
    <tr>
      <td rowspan="3" class="text-center bordered"><strong>REGISTROS ANTERIORES</strong></td>
      <td class="bordered"><strong>INVENTARIOS</strong></td>
      <td class="bordered">{{ $datos->registros_anteriores[0] }}</td>
      <td class="bordered">{{ $datos->registros_anteriores[1] }}</td>
      <td class="bordered">{{ $datos->registros_anteriores[2] }}</td>
    </tr>
    <tr>
      <td class="bordered"><strong>OTROS</strong></td>
      <td class="bordered">{{ $datos->registros_anteriores[3] }}</td>
      <td class="bordered">{{ $datos->registros_anteriores[4] }}</td>
      <td class="bordered">{{ $datos->registros_anteriores[5] }}</td>
    </tr>
    <tr>
      <td class="bordered"><strong>CÓDIGOS</strong></td>
      <td class="bordered">{{ $datos->registros_anteriores[6] }}</td>
      <td class="bordered">{{ $datos->registros_anteriores[7] }}</td>
      <td class="bordered">{{ $datos->registros_anteriores[8] }}</td>
    </tr>
  </table>
  <h2 class="subtitle">4. DESCRIPCIÓN DEL BIEN</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-3"><strong>4.1. MANUFACTURA:</strong></td>
      <td class="w-7">{{ $datos->reporte_manufactura }}</td>
    </tr>
    <tr>
      <td><strong>4.2. ACABADO DE SUPERFICIE:</strong></td>
      <td>{{ $datos->acabado_superficie }}</td>
    </tr>
    <tr>
      <td><strong>4.3. DECORACION:</strong></td>
      <td>{{ $datos->reporte_decoracion }}</td>
    </tr>
    <tr>
      <td colspan="2"><strong>4.4. DESCRIPCION DEL MOTIVO O DISEÑO DECORATIVO:</strong></td>
    </tr>
    <tr>
      <td colspan="2" class="descripcion">{{ $datos->descripcion_decoracion }}</td>
    </tr>
  </table>
  <p class="bordered"><strong>4.5. MORFOLOGIA:</strong></p>
  @if ($datos->material->abreviatura === "CE")
    <table class="full-bordered">
      <thead>
        <tr>
          <td class="text-center"><strong>Labio</strong></td>
          <td class="text-center"><strong>Borde</strong></td>
          <td class="text-center"><strong>Cuello</strong></td>
          <td class="text-center"><strong>Cuerpo</strong></td>
          <td class="text-center"><strong>Paredes</strong></td>
          <td class="text-center"><strong>Base</strong></td>
          <td class="text-center"><strong>Soporte</strong></td>
          <td class="text-center"><strong>Asa/mango</strong></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>@if ($datos->morfologia['labio'])
            {{ $datos->morfologia['labio']['denominacion'] }}
          @endif</td>
          <td>@if ($datos->morfologia['borde'])
            {{ $datos->morfologia['borde']['denominacion'] }}
          @endif</td>
          <td>@if ($datos->morfologia['cuello'])
            {{ $datos->morfologia['cuello']['denominacion'] }}
          @endif</td>
          <td>@if ($datos->morfologia['cuerpo'])
            {{ $datos->morfologia['cuerpo']['denominacion'] }}
          @endif</td>
          <td>@if ($datos->morfologia['paredes'])
            {{ $datos->morfologia['paredes']['denominacion'] }}
          @endif</td>
          <td>@if ($datos->morfologia['base'])
            {{ $datos->morfologia['base']['denominacion'] }}
          @endif</td>
          <td>@if ($datos->morfologia['soporte'])
            {{ $datos->morfologia['soporte']['denominacion'] }}
          @endif</td>
          <td>@if ($datos->morfologia['asa_mango'])
            {{ $datos->morfologia['asa_mango']['denominacion'] }}
          @endif</td>
        </tr>
      </tbody>
    </table>
  @elseif ($datos->material->abreviatura !== "TE")
    @if ($datos->morfologia['no_textil'])
      <p class="bordered">{{ $datos->morfologia['no_textil']['denominacion'] }}</p>
    @endif
  @elseif($datos->material->abreviatura === "TE")
    <p class="bordered">{{ $datos->morfologia['textil'] }}</p>
  @endif
  <div class="break"></div>
  <table class="bordered">
    <tr>
      <td><strong>4.6. DESCRIPCIÓN ADICIONAL:</strong></td>
    </tr>
    <tr>
      <td class="descripcion">{{ $datos->descripcion_adicional }}</td>
    </tr>
    <tr>
      <td><strong>4.7. FUNCIÓN/USO:</strong></td>
    </tr>
    <tr>
      <td>
        @if ($datos->funcionUso)
          @if (trim($datos->funcionUso->denominacion) === 'Otras denominaciones')
            {{ $datos->otra_funcion_uso }}
          @else
            {{ $datos->funcionUso->denominacion }}
          @endif
        @endif
      </td>
    </tr>
  </table>
  <p class="bordered"><strong>4.8. DIMENSIONES (milimetros y gramos).</strong></p>
  <table class="fixed">
    <tr>
      <td class="bordered" colspan="2"><strong>ALTO:</strong></td>
      <td class="bordered text-right" colspan="2">
        @if ($datos->alto) {{ $datos->alto }} mm @endif
      </td>
      <td></td>
      <td class="bordered" colspan="2"><strong>DIAMETRO DE BASE:</strong></td>
      <td class="bordered text-right" colspan="2">
        @if ($datos->diametro_base) {{ $datos->diametro_base }} mm @endif
      </td>
    </tr>
    <tr>
      <td colspan="2" class="bordered"><strong>LARGO:</strong></td>
      <td colspan="2" class="bordered text-right">
        @if ($datos->largo) {{ $datos->largo }} mm @endif
      </td>
      <td></td>
      <td colspan="2" class="bordered"><strong>DIAMETRO MÁXIMO:</strong></td>
      <td colspan="2" class="bordered text-right">
        @if ($datos->diametro_maximo) {{ $datos->diametro_maximo }} mm @endif
      </td>
    </tr>
    <tr>
      <td colspan="2" class="bordered"><strong>ANCHO:</strong></td>
      <td colspan="2" class="bordered text-right">
        @if ($datos->ancho) {{ $datos->ancho }} mm @endif
      </td>
      <td></td>
      <td colspan="2" class="bordered"><strong>DIÁMETRO MÍNIMO</strong></td>
      <td colspan="2" class="bordered text-right">
        @if ($datos->diametro_minimo) {{ $datos->diametro_minimo }} mm @endif
      </td>
    </tr>
    <tr>
      <td colspan="2" class="bordered"><strong>ESPESOR:</strong></td>
      <td colspan="2" class="bordered text-right">
        @if ($datos->espesor) {{ $datos->espesor }} mm @endif
      </td>
      <td></td>
      <td colspan="2" class="bordered"><strong>PESO:</strong></td>
      <td colspan="2" class="bordered text-right">
        @if ($datos->peso) {{ $datos->peso }} g @endif
      </td>
    </tr>
  </table>
  <h2 class="subtitle">5. ESTADO GENERAL DEL BIEN</h2>
  <table class="fixed bordered">
    <tr>
      <td class="w-3"><strong>5.1. ESTADO DE CONSERVACIÓN:</strong></td>
      <td class="w-7">{{ $datos->estadoConservacion->denominacion }}</td>
    </tr>
    <tr>
      <td><strong>DESCRIPCION:</strong></td>
      <td class="descripcion">{{ $datos->descripcion_estado }}</td>
    </tr>
    <tr>
      <td><strong>ESTADO DE INTEGRIDAD:</strong></td>
      <td>{{ $datos->estadoIntegridad->denominacion }}</td>
    </tr>
    <tr><td colspan="2"><strong>5.2. TRATAMIENTO:</strong></td></tr>
    <tr>
      <td colspan="2">
        <ul class="list-inline">
          <li><strong>DIAGNÓSTICO:</strong></li>
          <li>@if ($datos->es_diagnostico)
            X
          @endif</li>
          <li><strong>INTERVENCIÓN:</strong></li>
          <li>@if ($datos->es_intervencion)
            X
          @endif</li>
          <li><strong>OTROS:</strong></li>
          <li>@if ($datos->es_otros_tratamientos)
            X
          @endif</li>
        </ul>
      </td>
    </tr>
    <tr>
      <td colspan="2"><strong>TIPO DE INTERVENCIÓN:</strong></td>
    </tr>
    <tr>
      <td colspan="2">
        <ul class="list-inline">
          <li><strong>CONSER. PREVENTIVA:</strong></li>
          <li>@if ($datos->es_conservacion_preventiva)
            X
          @endif</li>
          <li><strong>CONSERV. CURATIVA:</strong></li>
          <li>@if ($datos->es_conservacion_curativa)
            X
          @endif</li>
          <li><strong>CONSER. RESTAURATIVA:</strong></li>
          <li>@if ($datos->es_conservacion_restaurativa)
            X
          @endif</li>
        </ul>
      </td>
    </tr>
    <tr>
      <td colspan="2"><strong>DOCUMENTO DE AUTORIZACIÓN</strong></td>
    </tr>
    <tr>
      <td colspan="2">
        <ul class="list-inline">
          <li><strong>RESOLUCIÓN N°:</strong></li>
          <li>{{ $datos->nro_resolucion_autorizacion }}</li>
          <li><strong>FICHA N°:</strong></li>
          <li>{{ $datos->nro_ficha_autorizacion }}</li>
          <li><strong>INFORME:</strong></li>
          <li>{{ $datos->nro_informe_autorizacion }}</li>
          <li><strong>NINGUNO:</strong></li>
          <li>@if (!$datos->nro_resolucion_autorizacion && !$datos->nro_ficha_autorizacion && !$datos->nro_informe_autorizacion)
            X
          @endif</li>
        </ul>
      </td>
    </tr>
    <tr>
      <td><strong>DETALLE DE INTERVENCIÓN:</strong></td>
      <td>{{ $datos->detalle_intervencion }}</td>
    </tr>
    <tr>
      <td><strong>OBSERVACIONES:</strong></td>
      <td>{{ $datos->observaciones_intervencion }}</td>
    </tr>
  </table>
  <h2 class="subtitle">6. FOTOGRAFIAS ADICIONALES</h2>
  <table class="fixed">
    <tr>
      <td class="w-5"></td>
      <td class="w-5"></td>
    </tr>
    <tr class="row-foto medium">
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
  <table class="fixed bordered">
    <tr>
      <td class="w-3"><strong>7. BIBLIOGRAFÍA:</strong></td>
      <td class="ws-pw w-7">{{ $datos->bibliografia }}</td>
    </tr>
    <tr>
      <td><strong>8. UBICACIÓN ACTUAL:</strong></td>
      <td>{{ $datos->ubicacionActual }}</td>
    </tr>
    <tr>
      <td><strong>8.1 UBICACIÓN ESPECIFICA DEL BIEN:</strong></td>
      <td>{{ $datos->ubicacionEspecifica }}</td>
    </tr>
    <tr>
      <td><strong>9. ARQUEÓLOGO REGISTRADOR:</strong></td>
      <td>@if ($datos->registrador)
        {{ $datos->registrador()->first()->nombre_completo }}
      @endif</td>
    </tr>
    <tr>
      <td><strong>10. ARQUEOLOGO CATALOGADOR:</strong></td>
      <td>{{ $datos->catalogador()->first()->name }}</td>
    </tr>
    <tr>
      <td><strong>11. FECHA DE CATALOGACIÓN</strong></td>
      <td>{{ $datos->fecha_catalogacion }}</td>
    </tr>
    <tr>
      <td class="va-top"><strong>12. SELLO Y FIRMA</strong></td>
      <td>
        <br>
        <br>
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
