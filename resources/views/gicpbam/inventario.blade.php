@extends('templates.gmcpcam.layout')

@section('title', 'Fichas de Inventario')

@section('breadcrumb')
  <li class="active">Fichas de Inventario</li>
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
  <div v-show="esProcesoListado">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th class="max">Proyecto</th>
            <th>Período</th>
            <th>Fecha Clasificación</th>
            <th class="th-acciones">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="inventarioAux in inventarios">
            <td>@{{ inventarioAux | proyectoNombre }}</td>
            <td>@{{ inventarioAux.periodo_intervencion }}</td>
            <td>@{{ inventarioAux.fecha_clasificacion }}</td>
            <td>
              <div class="btn-group" role="group">
                <a class="btn btn-success" v-on:click="editarInventario(inventarioAux)"><tooltip text="Editar"><span class="glyphicon glyphicon-edit"></span></tooltip></a>
                <a class="btn btn-danger" v-on:click="eliminarInventario(inventarioAux.id)"><tooltip text="Eliminar"><span class="glyphicon glyphicon-trash"></span></tooltip></a>
                <a class="btn btn-primary" v-bind:href="crearAnalisisCeramologico(inventarioAux.id)"><tooltip text="Crear Análisis Ceramológico"><i class="fa fa-file-text-o" aria-hidden="true"></i></tooltip></a>
                <a class="btn btn-default" v-bind:href="enlaceReporte(inventarioAux.id)" target="_blank"><tooltip text="Ver Reporte"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></tooltip></a>
                <a class="btn btn-danger" v-bind:href="enlaceReporteF2(inventarioAux.id)" target="_blank"><tooltip text="Ver Reporte F2"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></tooltip></a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <nav>
      <ul class="pagination">
        <li v-if="pagination.current_page > 1">
          <a href="#" aria-label="Previous" v-on:click.prevent="cambiarPagina(pagination.current_page - 1)">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li v-for="pagina in numerosPagina" :class="pagina == paginaActiva ? 'active' : ''">
          <a href="#" v-on:click.prevent="cambiarPagina(pagina)">@{{ pagina }}</a>
        </li>
        <li v-if="pagination.current_page < pagination.last_page">
          <a href="#" aria-label="Next" v-on:click.prevent="cambiarPagina(pagination.current_page + 1)">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</transition>
<div v-show="!esProcesoListado">
</div>
@endsection

@section('scripts')
<script>
let app = new Vue({
  el: '#app',
  computed: {
    numerosPagina: function () {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + (this.offset * 2);
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
    paginaActiva: function () {
      return this.pagination.current_page;
    },
  },
  created: function () {
    this.listarInventarios(this.pagination.current_page)
  },
  data: {
    abrirModal: false,
    alertarError: false,
    alertarExito: false,
    esProcesoListado: true,
    inventarios: [],
    mensajeError: '',
    mensajeExito: '',
    offset: 5,// Número de páginas que se muestran a cada lado de la página actual en el paginador
    pagination: {
      total: 0,
      per_page: 5,
      from: 1,
      to: 0,
      current_page: 1
    },
    titulo: 'Listar Fichas de Inventario',
  },
  filters: {
    proyectoNombre: function (inventario) {
      return inventario.tipo_proyecto === 'cir_pmas' ? inventario.proyecto.PMA_varNombreProyecto : inventario.proyecto.PROY_varNombre
    },
  },
  methods: {
    cambiarPagina: function (page) {
      this.pagination.current_page = page;
      this.listarInventarios(page);
    },
    crearAnalisisCeramologico: function (idInventario) {
      return '/gicpbam/fichas/ceramologico/inventario/' + idInventario + '/crear'
    },
    editarInventario: function (fichaEditar) {
    },
    eliminarInventario: function (idFicha) {
    },
    enlaceReporte: function (idFicha) {
      return '/gicpbam/fichas/inventario/' + idFicha + '/reporte'
    },
    enlaceReporteF2: function (idFicha) {
      return '/gicpbam/fichas/inventario_f2/' + idFicha + '/reporte'
    },
    listarInventarios: function (page) {
      var vm = this
      var uri = '/gicpbam/fichas/inventario/listar?page=' + page
      axios.get(uri)
      .then(function (response) {
        vm.inventarios = response.data.data.data
        vm.pagination = response.data.pagination
      })
      .catch(function (error) {
        console.log(error)
      });
    },
  }
});
</script>
@endsection
