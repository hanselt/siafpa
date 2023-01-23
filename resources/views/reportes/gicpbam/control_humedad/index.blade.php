@extends('templates.gmcpcam.layout')

@section('title', 'Controles de Humedad - Reportes')

@section('breadcrumb')
  <li class="active">Controles de Humedad - Reportes</li>
@endsection

@section('content')
<div class="page-header">
  <h1>@{{ titulo }}</h1>
</div>
<!-- Alertas -->
<alert type="success" dismissible v-if="alertarExito" @dismissed="alertarExito=false" :duration="4500">
  <p><strong>¡Éxito!</strong><br>
  @{{ mensajeExito }}</p>
</alert>
<alert type="danger" dismissible v-if="alertarError" @dismissed="alertarError=false" :duration="9000">
  <p><strong>Ocurrió un error.</strong><br>
  @{{ mensajeError }}</p>
</alert>
<!-- /Alertas -->
<transition name="fade">
  <div v-show="!esProcesoReporteGeneral">
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h2 class="panel-title h3">Reporte General</h2>
          </div>
          <div class="panel-body">
            <div class="form-horizontal">
              <div class="form-group">
                <label for="fecha" class="control-label col-md-4">Mes / Año:</label>
                <div class="col-md-4">
                  <select name="mes" id="mes" class="form-control" v-model="reporteGeneral.mes">
                    <option v-for="mes in $datosGlobales.meses" v-bind:value="mes.id">@{{ mes.denominacion }}</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <input type="number" class="form-control" v-model="reporteGeneral.anio" name="anio" id="anio" min="1900" max="2100" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button class="btn btn-primary" type="button" v-on:click="recuperarDatosReporteGeneral">Generar Reporte</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</transition>
<div v-show="esProcesoReporteGeneral">
  <h2 class="h3 text-uppercase">MES DE @{{ $datosGlobales.meses[reporteGeneral.mes].denominacion }} - @{{ reporteGeneral.anio }}</h2>
  <div class="table-responsive" v-if="reporteGeneral.fechas.length">
    <table class="table table-striped table-condensed table-bordered">
      <thead>
        <tr class="text-center">
          <th rowspan="2">Fecha</th>
          <th rowspan="2">Tiempo</th>
          <th colspan="2" v-for="espacio in reporteGeneral.espaciosMonitoreados">@{{ espacio }}</th>
        </tr>
        <tr class="text-center">
          <template v-for="espacio in reporteGeneral.espaciosMonitoreados">
            <th>Humedad (%)</th>
            <th>Temperatura (C°)</th>
          </template>
        </tr>
      </thead>
      <tbody>
        <template v-for="fecha in reporteGeneral.fechas">
          <tr>
            <td rowspan="2">@{{ fecha }}</td>
            <td>Mañana</td>
            <template v-for="espacio in reporteGeneral.espaciosMonitoreados">
              <template v-if="typeof reporteGeneral.transformada[fecha]['manana'] !== 'undefined' && typeof reporteGeneral.transformada[fecha]['manana'][espacio] !== 'undefined'">
                <td class="text-right">@{{ reporteGeneral.transformada[fecha]['manana'][espacio].humedad }}</td>
                <td class="text-right">@{{ reporteGeneral.transformada[fecha]['manana'][espacio].temperatura }}</td>
              </template>
              <template v-else><td></td><td></td></template>
            </template>
          </tr>
          <tr>
            <td>Tarde</td>
            <template v-for="espacio in reporteGeneral.espaciosMonitoreados">
              <template v-if="typeof reporteGeneral.transformada[fecha]['tarde'] !== 'undefined' && typeof reporteGeneral.transformada[fecha]['tarde'][espacio] !== 'undefined'">
                <td class="text-right">@{{ reporteGeneral.transformada[fecha]['tarde'][espacio].humedad }}</td>
                <td class="text-right">@{{ reporteGeneral.transformada[fecha]['tarde'][espacio].temperatura }}</td>
              </template>
              <template v-else><td></td><td></td></template>
            </template>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
  <div v-else>
    No existen registros.
  </div>
  <div class="form-horizontal">
    <div class="form-group">
      <div class="col-md-10 col-md-offset-2">
        <a v-bind:href="enlaceReporteGeneral" class="btn btn-danger" target="_blank"><i class="fa fa-file-pdf-o"></i> Ver PDF</a>
        <button type="button" class="btn btn-default" v-on:click="volver">Volver</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  let app = new Vue({
    el: '#app',
    computed: {
      enlaceReporteGeneral: function () {
        return '/gicpbam/fichas/control_humedad/reportes/general/pdf/' + this.reporteGeneral.anio + '/' + (this.reporteGeneral.mes + 1)
      },
    },
    data: {
      alertarError: false,
      alertarExito: false,
      esProcesoReporteGeneral: false,
      mensajeError: '',
      mensajeExito: '',
      reporteGeneral: {
        anio: new Date().getFullYear(),
        espaciosMonitoreados: [],
        fechas: [],
        mes: new Date().getMonth(),
        transformada: {},
      },
      titulo: 'Controles de Humedad - Reportes',
    },
    created: function () {
    },
    methods: {
      generarPDFReporteGeneral: function () {
      },
      recuperarDatosReporteGeneral: function () {
        let vm = this
        vm.esProcesoReporteGeneral = true
        vm.titulo = 'Ficha de Registro y Control diario de Humedad relativa y Temperatura'
        let url = '/gicpbam/fichas/control_humedad/reportes/general/generar'
        axios.post(url, {
          anio: vm.reporteGeneral.anio,
          mes: vm.reporteGeneral.mes + 1,
        })
        .then(function (response) {
          vm.reporteGeneral.espaciosMonitoreados = response.data.espacios_monitoreados
          vm.reporteGeneral.fechas = response.data.fechas
          vm.reporteGeneral.transformada = response.data.transformada
        }, function (error) {
          console.log(error)
        })
      },
      mostrarMensaje: function (mensaje, esExito) {
        if (esExito) {
          this.alertarExito = true
          this.mensajeExito = mensaje
        } else {
          this.alertarError = true
          this.mensajeError = mensaje
        }
        window.scrollTo(0, 0)
      },
      volver: function () {
        this.titulo = 'Controles de Humedad - Reportes'
        this.esProcesoReporteGeneral = false
      }
    },
  });
</script>
@endsection
