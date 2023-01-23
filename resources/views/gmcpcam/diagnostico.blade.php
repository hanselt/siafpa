@extends('templates.gmcpcam.layout')

@section('title', 'Fichas de Diagnóstico')

@section('breadcrumb')
<li class="active">Fichas de Diagnóstico</li>
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
            <th>Número</th>
            <th>Código</th>
            <th class="max">Proyecto</th>
            <th>Fecha Diagnóstico</th>
            <th class="th-acciones">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="fichaAux in fichasDiagnostico">
            <td>@{{ fichaAux.nro_ficha }}</td>
            <td>@{{ fichaAux.catalogacion.material.abreviatura }} @{{ fichaAux.catalogacion.codigo }}</td>
            <td>@{{ fichaAux.catalogacion.detalle_inventario.inventario.proyecto.nombre }}</td>
            <td>@{{ fichaAux.fecha_diagnostico }}</td>
            <td>
              <div class="btn-group" role="group">
                <div class="btn-group">
                  @can('editar_diagnostico')
                  <btn v-tooltip="'Editar'" type="success" v-on:click="editarFichaDiagnostico(fichaAux)"><span class="glyphicon glyphicon-edit"></span></btn>
                  @endcan
                  @can('eliminar_diagnostico')
                  <btn v-tooltip="'Eliminar'" type="danger" v-on:click="eliminarFichaDiagnostico(fichaAux.id)"><span class="glyphicon glyphicon-trash"></span></btn>
                  @endcan
                  @can('ver_diagnostico_reporte')
                  <btn :href="enlaceReporte(fichaAux.id)" v-tooltip="'Ver Reporte'" type="default" target="_blank"><i class="fa fa-file-pdf-o"></i></btn>
                  @endcan
                </div>
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
  <ficha-diagnostico :es-edicion="true" v-model="ficha" v-on:volver="mostrarListado" v-on:actualizar="listarFichasDiagnostico(pagination.current_page)" v-on:mensaje="mostrarMensaje"></ficha-diagnostico>
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
      this.listarFichasDiagnostico(this.pagination.current_page)
    },
    data: {
      alertarError: false,
      alertarExito: false,
      busqueda: {
        columna: '',
        texto: '',
      },
      columnas: [
        { value: 'codigo', label: 'Código' },
        { value: 'proyecto', label: 'Proyecto' },
        { value: 'fecha_diagnostico', label: 'Fecha de Diagnóstico' },
      ],
      esProcesoListado: true,
      ficha: null,
      fichasDiagnostico: [],
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
      procesandoBusqueda: false,
      titulo: 'Listar Fichas de Diagnóstico',
    },
    methods: {
      buscar: function (texto, columna) {
        this.procesandoBusqueda = true
        this.busqueda.texto = texto
        this.busqueda.columna = columna
        this.listarFichasDiagnostico(1)
      },
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarFichasDiagnostico(page);
      },
      editarFichaDiagnostico: function (fichaEditar) {
        this.esProcesoListado = false
        this.ficha = jQuery.extend(true, {}, fichaEditar)
        this.titulo = 'Editar Ficha de Diagnóstico'
      },
      eliminarFichaDiagnostico: function (idFichaDiagnostico) {
      },
      enlaceReporte: function (idFicha) {
        return '/gmcpcam/fichas/diagnostico/' + idFicha + '/reporte'
      },
      listarFichasDiagnostico: function (page) {
        let vm = this
        let url = '/gmcpcam/fichas/diagnostico/listar?page=' + page + '&columna=' + vm.busqueda.columna + '&texto=' + vm.busqueda.texto
        axios.get(url)
        .then(function (response) {
          vm.fichasDiagnostico = response.data.data.data
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
        this.titulo = 'Listar Fichas de Diagnóstico'
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
        this.listarFichasDiagnostico(1)
      },
    },
  })
</script>
@endsection
