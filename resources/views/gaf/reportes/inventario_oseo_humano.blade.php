@extends('gaf.reportes.partials.base')

@section('title', 'FICHA DE INVENTARIO ÓSEO HUMANO')

@section('content')
  <h1 class="text-center"><strong>FICHA DE INVENTARIO ÓSEO HUMANO</strong></h1>
  <h2 class="subtitle">1. DATOS GENERALES</h2>
  <table class="bordered fixed">
    <tr>
      <td colspan="2">1.1 Datos de identificación</td>
      <td colspan="2">1.2 Datos del individuo</td>
    </tr>
    <tr>
      <td><strong>Ficha N°</strong></td>
      <td>{{ $datos->nro_ficha }}</td>
      <td><strong>Sexo</strong></td>
      <td>{{ $datos->sexo }}</td>
    </tr>
    <tr>
      <td><strong>Contexto Funerario N°</strong></td>
      <td>{{ $datos->nro_contexto_funerario }}</td>
      <td><strong>Edad</strong></td>
      <td>{{ $datos->edad }}</td>
    </tr>
    <tr>
      <td><strong>Individuo N°</strong></td>
      <td>{{ $datos->nro_individuo }}</td>
      <td><strong>Estatura</strong></td>
      <td>{{ $datos->estatura }}</td>
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
  </table>
  <h2 class="subtitle">2. LOCALIZACIÓN GEOGRÁFICA</h2>
  <table class="fixed full-bordered">
    <tr>
      <td colspan="2"><strong>2.1. UBICACIÓN:</strong></td>
      <td colspan="2"><strong>2.2. LOCALIZACIÓN DEL CONTEXTO FUNERARIO:</strong></td>
    </tr>
    <tr>
      <td><strong>Origen / Sitio:</strong></td>
      <td>{{ $datos->proyecto->origen }}</td>
      <td><strong>Sector:</strong></td>
      <td>{{ $datos->sector }}</td>
    </tr>
    <tr>
      <td ><strong>Ubigeo:</strong></td>
      <td>{{ $datos->proyecto->ubigeo }}</td>
      <td><strong>Sub Sector:</strong></td>
      <td>{{ $datos->subsector }}</td>
    </tr>
    <tr>
      <td><strong>Departamento:</strong></td>
      <td>{{ $datos->proyecto->departamento }}</td>
      <td><strong>Unidad:</strong></td>
      <td>{{ $datos->unidad_excavacion }}</td>
    </tr>
    <tr>
      <td><strong>Provincia:</strong></td>
      <td>{{ $datos->proyecto->provincia }}</td>
      <td><strong>Contexto:</strong></td>
      <td>{{ $datos->contexto }}</td>
    </tr>
    <tr>
      <td><strong>Distrito:</strong></td>
      <td>{{ $datos->proyecto->distrito }}</td>
      <td><strong>Capa / Nivel:</strong></td>
      <td>{{ $datos->capa_nivel }}</td>
    </tr>
    <tr>
      <td><strong>Anexo:</strong></td>
      <td>{{ $datos->proyecto->anexo }}</td>
      <td><strong>Coordenadas UTM:</strong></td>
      <td>{{ $datos->coordenadas_utm }}</td>
    </tr>
    <tr>
      <td><strong>Centro Poblado:</strong></td>
      <td>{{ $datos->proyecto->centro_poblado }}</td>
    </tr>
  </table>
  <h2 class="subtitle">3. INVENTARIO ÓSEO</h2>
  <h3>3.1 Cráneo</h3>
  <table class="full-bordered">
    <tr class="text-center">
      <td colspan="3"></td>
      <td><strong>DER.</strong></td>
      <td><strong>IZQ.</strong></td>
      <td></td>
      <td><strong>DER.</strong></td>
      <td><strong>IZQ.</strong></td>
      <td></td>
      <td><strong>DER.</strong></td>
      <td><strong>IZQ.</strong></td>
    </tr>
    <tr>
      <td>Frontal</td>
      <td class="text-center">@gafclave($datos->craneo_frontal)</td>
      <td>Parietal</td>
      <td class="text-center">@gafclave($datos->craneo_parietal_derecho)</td>
      <td class="text-center">@gafclave($datos->craneo_parietal_izquierdo)</td>
      <td>Malar</td>
      <td class="text-center">@gafclave($datos->craneo_malar_derecho)</td>
      <td class="text-center">@gafclave($datos->craneo_malar_izquierdo)</td>
      <td>Cornete</td>
      <td class="text-center">@gafclave($datos->craneo_cornete_derecho)</td>
      <td class="text-center">@gafclave($datos->craneo_cornete_izquierdo)</td>
    </tr>
    <tr>
      <td>Occipital</td>
      <td class="text-center">@gafclave($datos->craneo_occipital)</td>
      <td>Temporal</td>
      <td class="text-center">@gafclave($datos->craneo_temporal_derecho)</td>
      <td class="text-center">@gafclave($datos->craneo_temporal_izquierdo)</td>
      <td>Lacrimal</td>
      <td class="text-center">@gafclave($datos->craneo_lacrimal_derecho)</td>
      <td class="text-center">@gafclave($datos->craneo_lacrimal_izquierdo)</td>
      <td>Martillo</td>
      <td class="text-center">@gafclave($datos->craneo_martillo_derecho)</td>
      <td class="text-center">@gafclave($datos->craneo_martillo_izquierdo)</td>
    </tr>
    <tr>
      <td>Esfenoides</td>
      <td class="text-center">@gafclave($datos->craneo_esfenoides)</td>
      <td>Maxilar</td>
      <td class="text-center">@gafclave($datos->craneo_maxilar_derecho)</td>
      <td class="text-center">@gafclave($datos->craneo_maxilar_izquierdo)</td>
      <td>Palatino</td>
      <td class="text-center">@gafclave($datos->craneo_palatino_derecho)</td>
      <td class="text-center">@gafclave($datos->craneo_palatino_izquierdo)</td>
      <td>Yunque</td>
      <td class="text-center">@gafclave($datos->craneo_yunque_derecho)</td>
      <td class="text-center">@gafclave($datos->craneo_yunque_izquierdo)</td>
    </tr>
    <tr>
      <td>Vómer</td>
      <td class="text-center">@gafclave($datos->craneo_vomer)</td>
      <td>Nasal</td>
      <td class="text-center">@gafclave($datos->craneo_nasal_derecho)</td>
      <td class="text-center">@gafclave($datos->craneo_nasal_izquierdo)</td>
      <td colspan="3"></td>
      <td>Estribo</td>
      <td class="text-center">@gafclave($datos->craneo_estribo_derecho)</td>
      <td class="text-center">@gafclave($datos->craneo_estribo_izquierdo)</td>
    </tr>
    <tr>
      <td>Mandíbula</td>
      <td class="text-center">@gafclave($datos->craneo_mandibula)</td>
      <td colspan="9"></td>
    </tr>
    <tr>
      <td>Hioides</td>
      <td class="text-center">@gafclave($datos->craneo_hioides)</td>
      <td colspan="9"></td>
    </tr>
  </table>
  <h3>3.2 Post Cráneo</h3>
  <table class="full-bordered">
    <tr class="text-center">
      <td></td>
      <td><strong>PRES.</strong></td>
      <td><strong>N°</strong></td>
      <td></td>
      <td><strong>PRES.</strong></td>
      <td><strong>N°</strong></td>
      <td></td>
      <td><strong>DER.</strong></td>
      <td><strong>IZQ.</strong></td>
    </tr>
    <tr>
      <td>Esternón</td>
      <td class="text-center">@gafclave($datos->esternon)</td>
      <td class="text-right">{{ $datos->nro_esternon }}</td>
      <td>Vert. Cervicales</td>
      <td class="text-center">@gafclave($datos->vertebras_cervicales)</td>
      <td class="text-right">{{ $datos->nro_vertebras_cervicales }}</td>
      <td>Costillas</td>
      <td class="text-center">@gafclave($datos->costillas_derechas)</td>
      <td class="text-center">@gafclave($datos->costillas_izquierdas)</td>
    </tr>
    <tr>
      <td>Sacro</td>
      <td class="text-center">@gafclave($datos->sacro)</td>
      <td class="text-right">{{ $datos->nro_sacro }}</td>
      <td>Vert. Dorsales</td>
      <td class="text-center">@gafclave($datos->vertebras_dorsales)</td>
      <td class="text-right">{{ $datos->nro_vertebras_dorsales }}</td>
      <td colspan="3"></td>
    </tr>
    <tr>
      <td colspan="3"></td>
      <td>Vert. Lumbares</td>
      <td class="text-center">@gafclave($datos->vertebras_lumbares)</td>
      <td class="text-right">{{ $datos->nro_vertebras_lumbares }}</td>
      <td colspan="3"></td>
    </tr>
  </table>
  <table class="full-bordered">
    <tr>
      <td colspan="4">3.3 Extremidades Superiores</td>
      <td colspan="4">3.4 Extremidades Inferiores</td>
    </tr>
    <tr>
      <td></td>
      <td class="text-center"><strong>DER.</strong></td>
      <td class="text-center"><strong>IZQ.</strong></td>
      <td colspan="2"></td>
      <td class="text-center"><strong>DER.</strong></td>
      <td class="text-center"><strong>IZQ.</strong></td>
      <td></td>
    </tr>
    <tr>
      <td>Clavícula</td>
      <td class="text-center">@gafclave($datos->clavicula_derecha)</td>
      <td class="text-center">@gafclave($datos->clavicula_izquierda)</td>
      <td class="text-right">{{ $datos->longitud_clavicula }}</td>
      <td>Ilión</td>
      <td class="text-center">@gafclave($datos->ilion_derecho)</td>
      <td class="text-center">@gafclave($datos->ilion_izquierdo)</td>
      <td class="text-right">{{ $datos->longitud_ilion }}</td>
    </tr>
    <tr>
      <td>Omóplato</td>
      <td class="text-center">@gafclave($datos->omoplato_derecho)</td>
      <td class="text-center">@gafclave($datos->omoplato_izquierdo)</td>
      <td class="text-right">{{ $datos->longitud_omoplato }}</td>
      <td>Isquión</td>
      <td class="text-center">@gafclave($datos->isquion_derecho)</td>
      <td class="text-center">@gafclave($datos->isquion_izquierdo)</td>
      <td class="text-right">{{ $datos->longitud_isquion }}</td>
    </tr>
    <tr>
      <td>Húmero</td>
      <td class="text-center">@gafclave($datos->humero_derecho)</td>
      <td class="text-center">@gafclave($datos->humero_izquierdo)</td>
      <td class="text-right">{{ $datos->longitud_humero }}</td>
      <td>Pubis</td>
      <td class="text-center">@gafclave($datos->pubis_derecho)</td>
      <td class="text-center">@gafclave($datos->pubis_izquierdo)</td>
      <td class="text-right">{{ $datos->longitud_pubis }}</td>
    </tr>
    <tr>
      <td>Radio</td>
      <td class="text-center">@gafclave($datos->radio_derecho)</td>
      <td class="text-center">@gafclave($datos->radio_izquierdo)</td>
      <td class="text-right">{{ $datos->longitud_radio }}</td>
      <td>Fémur</td>
      <td class="text-center">@gafclave($datos->femur_derecho)</td>
      <td class="text-center">@gafclave($datos->femur_izquierdo)</td>
      <td class="text-right">{{ $datos->longitud_femur }}</td>
    </tr>
    <tr>
      <td>Cúbito</td>
      <td class="text-center">@gafclave($datos->cubito_derecho)</td>
      <td class="text-center">@gafclave($datos->cubito_izquierdo)</td>
      <td class="text-right">{{ $datos->longitud_cubito }}</td>
      <td>Rótula</td>
      <td class="text-center">@gafclave($datos->rotula_derecha)</td>
      <td class="text-center">@gafclave($datos->rotula_izquierda)</td>
      <td class="text-right">{{ $datos->longitud_rotula }}</td>
    </tr>
    <tr>
      <td>Mano</td>
      <td class="text-center">@gafclave($datos->mano_derecha)</td>
      <td class="text-center">@gafclave($datos->mano_izquierda)</td>
      <td class="text-right">{{ $datos->longitud_mano }}</td>
      <td>Tibia</td>
      <td class="text-center">@gafclave($datos->tibia_derecha)</td>
      <td class="text-center">@gafclave($datos->tibia_izquierda)</td>
      <td class="text-right">{{ $datos->longitud_tibia }}</td>
    </tr>
    <tr>
      <td colspan="4"></td>
      <td>Peroné</td>
      <td class="text-center">@gafclave($datos->perone_derecho)</td>
      <td class="text-center">@gafclave($datos->perone_izquierdo)</td>
      <td class="text-right">{{ $datos->longitud_perone }}</td>
    </tr>
    <tr>
      <td colspan="4"></td>
      <td>Pie</td>
      <td class="text-center">@gafclave($datos->pie_derecho)</td>
      <td class="text-center">@gafclave($datos->pie_izquierdo)</td>
      <td class="text-right">{{ $datos->longitud_pie }}</td>
    </tr>
  </table>
  <div class="break"></div>
  <h2 class="subtitle">4. ESTADO DE CONSERVACIÓN DEL INDIVIDUO</h2>
  <table class="full-bordered">
    <tr>
      <td>Cráneo</td>
      <td>@gafclave($datos->estadoConservacionCraneo->denominacion)</td>
      <td>%</td>
      <td>{{ $datos->porcentaje_craneo }}</td>
      <td>Ext. Sup</td>
      <td>@gafclave($datos->estadoConservacionExtremidadesSuperiores->denominacion)</td>
      <td>%</td>
      <td>{{ $datos->porcentaje_extremidades_superiores }}</td>
      <td>Ext. Inf.</td>
      <td>@gafclave($datos->estadoConservacionExtremidadesInferiores->denominacion)</td>
      <td>%</td>
      <td>{{ $datos->porcentaje_extremidades_inferiores }}</td>
      <td>Costilla</td>
      <td>@gafclave($datos->estadoConservacionCostillas->denominacion)</td>
      <td>%</td>
      <td>{{ $datos->porcentaje_costillas }}</td>
    </tr>
    <tr>
      <td>Vértebras</td>
      <td>@gafclave($datos->estadoConservacionVertebras->denominacion)</td>
      <td>%</td>
      <td>{{ $datos->porcentaje_vertebras }}</td>
      <td>Esternón</td>
      <td>@gafclave($datos->estadoConservacionEsternon->denominacion)</td>
      <td>%</td>
      <td>{{ $datos->porcentaje_esternon }}</td>
      <td>Pelvis</td>
      <td>@gafclave($datos->estadoConservacionPelvis->denominacion)</td>
      <td>%</td>
      <td>{{ $datos->porcentaje_pelvis }}</td>
      <td>Sacro</td>
      <td>@gafclave($datos->estadoConservacionSacro->denominacion)</td>
      <td>%</td>
      <td>{{ $datos->porcentaje_sacro }}</td>
    </tr>
  </table>
  <h2 class="subtitle">5. REGISTRO FOTOGRÁFICO DEL CONTEXTO FUNERARIO</h2>
  <table class="full-bordered">
    <tr>
      <td>
        <img class="fotografia center-block" src="{{ url($datos->fotografia_contexto_funerario_1) }}" alt="">
      </td>
      <td>
        <img class="fotografia center-block" src="{{ url($datos->fotografia_contexto_funerario_2) }}" alt="">
      </td>
    </tr>
  </table>
  <h2 class="subtitle">6. REGISTRO FOTOGRÁFICO EN EL GABINETE</h2>
  <table class="full-bordered">
    <tr>
      <td>
        <img class="fotografia center-block" src="{{ url($datos->fotografia_gabinete_1) }}" alt="">
      </td>
      <td>
        <img class="fotografia center-block" src="{{ url($datos->fotografia_gabinete_2) }}" alt="">
      </td>
    </tr>
  </table>
  <h2 class="subtitle">7. OBSERVACIONES</h2>
  <p class="bordered descripcion">{{ $datos->observaciones }}</p>
  <h2 class="subtitle">8. DATOS DE CONTROL</h2>
  <table class="bordered fixed">
    <tr>
      <td><strong>Responsable</strong></td>
      <td class="w-5">{{ $datos->registrador->name }}</td>
      <td><strong>Fecha</strong></td>
      <td>{{ $datos->fecha }}</td>
    </tr>
  </table>
@endsection
