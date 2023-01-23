@extends('templates.dfq.layout')

@section('title', 'Análisis de Material Lítico')

@section('breadcrumb')
  <li class="active">Análisis de Material Lítico</li>
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
    <buscador :columnas="columnas" :procesando="procesandoBusqueda" v-on:buscar="buscar" v-on:reiniciar="reiniciarListado"></buscador>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th>Nro. de Ficha</th>
            <th>Código</th>
            <th>Gestión Documentaria</th>
            <th class="th-acciones min">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="fichaAux in analisisLiticos">
            <td>@{{ fichaAux.nro_ficha }}</td>
            <td>@{{ fichaAux.codigo }}</td>
            <td>@{{ fichaAux.gestion_documentaria }}</td>
            <td>
              <div class="btn-group" role="group">
                @can('editar_analisis_material_litico')
                <btn v-tooltip="'Editar'" type="success" v-on:click="editarAnalisisLitico(fichaAux)"><span class="glyphicon glyphicon-edit"></span></btn>
                @endcan
                @can('eliminar_analisis_material_litico')
                <btn v-tooltip="'Eliminar'" type="danger" v-on:click="eliminarAnalisisLitico(fichaAux.id)"><span class="glyphicon glyphicon-trash"></span></btn>
                @endcan
                @can('ver_analisis_material_litico_reporte')
                <btn :href="enlaceReporte(fichaAux.id)" v-tooltip="'Ver Reporte'" type="default" target="_blank"><i class="fa fa-file-pdf-o"></i></btn>
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
<div v-show="!esProcesoListado">
  <dfq-analisis-material-litico :es-edicion="true" v-model="analisis" v-on:volver="mostrarListado" v-on:actualizar="listarAnalisisLiticos(pagination.current_page)" v-on:mensaje="mostrarMensaje"></dfq-analisis-material-litico>
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
      },
      paginaActiva: function () {
        return this.pagination.current_page;
      },
    },
    created: function () {
      this.listarAnalisisLiticos(this.pagination.current_page)
    },
    data: {
      abrirModal: false,
      alertarError: false,
      alertarExito: false,
      busqueda: {
        columna: '',
        texto: '',
      },
      columnas: [
        { value: 'codigo', label: 'Código' },
        { value: 'gestion_documentaria', label: 'Gestión Documentaria' },
      ],
      esProcesoListado: true,
      mensajeError: '',
      mensajeExito: '',
      analisis: null,
      analisisLiticos: [],
      offset: 5,// Número de páginas que se muestran a cada lado de la página actual en el paginador
      pagination: {
        total: 0,
        per_page: 5,
        from: 1,
        to: 0,
        current_page: 1
      },
      procesandoBusqueda: false,
      titulo: 'Análisis de Material Lítico',
    },
    methods: {
      buscar: function (texto, columna) {
        this.procesandoBusqueda = true
        this.busqueda.texto = texto
        this.busqueda.columna = columna
        this.listarAnalisisLiticos(1)
      },
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarAnalisisLiticos(page);
      },
      editarAnalisisLitico: function (analisisEditar) {
        this.esProcesoListado = false
        this.analisis = jQuery.extend(true, {}, analisisEditar)
        this.titulo = 'Editar Análisis de Material Lítico'
      },
      eliminarAnalisisLitico: function (idFicha) {
      },
      enlaceReporte: function (idFicha) {
        return '/dfq/fichas/analisis_material_litico/' + idFicha + '/reporte'
      },
      listarAnalisisLiticos: function (page) {
        let vm = this
        let uri = '/dfq/fichas/analisis_material_litico/listar?page=' + page + '&columna=' + vm.busqueda.columna + '&texto=' + vm.busqueda.texto
        axios.get(uri)
        .then(function (response) {
          vm.analisisLiticos = response.data.data.data
          vm.pagination = response.data.pagination
        })
        .then(function () {
          vm.procesandoBusqueda = false
        })
        .catch(function (error) {
          console.log(error)
        });
      },
      mostrarListado: function () {
        this.esProcesoListado = true
        this.titulo = 'Análisis de Material Lítico'
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
      reiniciarListado: function () {
        this.busqueda = {
          columna: '',
          texto: '',
        }
        this.listarAnalisisLiticos(1)
      },
    }
  });
</script>
@endsection
