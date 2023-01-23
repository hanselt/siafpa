@extends('templates.mantenimientos.layout')

@section('title', 'Listar Planes de Monitoreos Arqueológicos')

@section('breadcrumb')
  <li class="active">Listar Planes de Monitoreos Arqueológicos</li>
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
  <div v-show="listar">
    <div class="table-responsive">
    <buscador :columnas="columnas" :procesando="procesandoBusqueda" v-on:buscar="buscar" v-on:reiniciar="reiniciarListado"></buscador>
      <table class="table table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th>Denominación</th>
            <th>Período</th>
            <th class="min-2x">Código Caja</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pma in pmas">
            <td>@{{ pma.PMA_varNombreProyecto }}</td>
            <td>@{{ pma.PMA_varPeriodo }}</td>
            <td>@{{ pma.codigo_caja }}</td>
            <td>
              <div class="btn-group" role="group">
                @can('editar_pmas')
                <tooltip text="Editar"><a class="btn btn-success" v-on:click="editarPma(pma)"><span class="glyphicon glyphicon-edit"></span></a></tooltip>
                @endcan
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
<div v-show="!listar">
  <pma :pma="pma" :es-edicion="true" v-on:mensaje="mostrarMensaje" v-on:cancelar="cancelar"></pma>
</div>
@endsection

@section('scripts')
<script>
  const app = new Vue({
    el: '#app',
    data: {
      alertarExito: false,
      alertarError: false,
      busqueda: {
        columna: '',
        texto: '',
      },
      columnas: [
        { value: 'PMA_varNombreProyecto', label: 'Denominación' },
        { value: 'PMA_varPeriodo', label: 'Período' },
        { value: 'codigo_caja', label: 'Código de Caja' },
      ],
      listar: true,
      mensajeExito: '',
      mensajeError: '',
      offset: 5,// Número de páginas que se muestran a cada lado de la página actual en el paginador
      pagination: {
        total: 0,
        per_page: 5,
        from: 1,
        to: 0,
        current_page: 1
      },
      pma: {},
      pmas: [],
      procesandoBusqueda: false,
      titulo: 'Listar Planes de Monitoreos Arqueológicos',
    },
    created: function () {
      this.listarPmas(this.pagination.current_page);
    },
    computed: {
      paginaActiva: function () {
        return this.pagination.current_page;
      },
      numerosPagina: function () {
        if (!this.pagination.to) {
          return [];
        }
        let from = this.pagination.current_page - this.offset;
        if (from < 1) {
          from = 1;
        }
        let to = from + (this.offset * 2);
        if (to >= this.pagination.last_page) {
          to = this.pagination.last_page;
        }
        let pagesArray = [];
        while (from <= to) {
          pagesArray.push(from);
          from++;
        }
        return pagesArray;
      }
    },
    methods: {
      buscar: function (texto, columna) {
        this.procesandoBusqueda = true
        this.busqueda.texto = texto
        this.busqueda.columna = columna
        this.listarPmas(1)
      },
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarPmas(page);
      },
      cancelar: function () {
        this.listar = true
        this.titulo = 'Listar Planes de Monitoreos Arqueológicos'
      },
      editarPma: function (pmaEditar) {
        let vm = this
        vm.errors.clear()
        vm.titulo = 'Editar Plan de Monitoreos Arqueológicos'
        vm.pma = Vue.util.extend({}, pmaEditar)
        vm.listar = false
      },
      listarPmas: function (page) {
        let vm = this
        let uri = '/listar/pmas?page=' + page + '&columna=' + vm.busqueda.columna + '&texto=' + vm.busqueda.texto
        axios.get(uri)
        .then(function (response) {
          vm.pmas = response.data.data.data
          vm.pagination = response.data.pagination
        })
        .then(function () {
          vm.procesandoBusqueda = false
        })
        .catch(function (error) {
          console.log(error)
        });
      },
      mostrarMensaje: function (mensaje, esExito) {
        if (esExito) {
          this.alertarExito = true
          this.mensajeExito = mensaje
          this.listarPmas(this.pagination.current_page);
          this.listar = true
        } else {
          this.alertarError = true
          this.mensajeError = mensaje
        }
        window.scrollTo(0, 0)
      },
      reiniciarListado: function () {
        this.busqueda = {
          columna: '',
          texto: '',
        }
        this.listarPmas(1)
      },
    }
  });
</script>
@endsection
