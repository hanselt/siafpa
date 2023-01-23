@extends('templates.gmcpcam.layout')

@section('title', 'Análisis Ceramológicos')

@section('breadcrumb')
<li class="active">Análisis Ceramológicos</li>
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
            <th>Código de Fragmento</th>
            <th class="max-2">Proyecto</th>
            <th>Período</th>
            <th>Fecha de Clasificación</th>
            <th class="th-acciones">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="fragmentoAux in fragmentos">
            <td>@{{ fragmentoAux.codigo_fragmento }}</td>
            <td>@{{ fragmentoAux.detalle_inventario.inventario.proyecto.nombre }}</td>
            <td>@{{ fragmentoAux.detalle_inventario.inventario.periodo }}</td>
            <td>@{{ fragmentoAux.fecha_clasificacion }}</td>
            <td>
              <div class="btn-group" role="group">
                @can('editar_ceramologico')
                <btn v-tooltip="'Editar'" type="success" v-on:click="editarAnalisisCeramologico(fragmentoAux)"><span class="glyphicon glyphicon-edit"></span></btn>
                @endcan
                @can('eliminar_ceramologico')
                <btn v-tooltip="'Eliminar'" type="danger" v-on:click="eliminarAnalisisCeramologico(fragmentoAux.id)"><span class="glyphicon glyphicon-trash"></span></btn>
                @endcan
                @can('crear_conservacion')
                <btn :href="crearConservacion(fragmentoAux.id)" v-tooltip="'Registrar Conservación Preventiva'" type="primary"><i class="fa fa-file-text-o"></i></btn>
                @endcan
                @can('crear_dibujo_tecnico')
                <btn :href="crearDibujoTecnico(fragmentoAux.id)" v-tooltip="'Registrar Dibujo Técnico'" type="primary"><i class="fa fa-file-image-o"></i></btn>
                @endcan
                @can('crear_resultado_analisis')
                <btn :href="crearAnalisisMuestras(fragmentoAux.id)" v-tooltip="'Registrar Resultado de Análisis de Muestras'" type="primary"><i class="fa fa-file-text"></i></btn>
                @endcan
                @can('crear_movimiento_fragmento')
                <btn :href="crearMovimientoFragmento(fragmentoAux.id)" v-tooltip="'Registrar Movimiento de Fragmento'" type="primary"><i class="fa fa-file"></i></btn>
                @endcan
                @can('ver_ceramologico_reporte')
                <btn :href="enlaceReporte(fragmentoAux.id)" v-tooltip="'Ver Reporte'" type="default" target="_blank"><i class="fa fa-file-pdf-o"></i></btn>
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
  <gicpbam-ceramologico :es-edicion="true" v-model="fragmento" v-on:volver="mostrarListado" v-on:actualizar="listarAnalisisCeramologicos(pagination.current_page)" v-on:mensaje="mostrarMensaje"></gicpbam-ceramologico>
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
      this.listarAnalisisCeramologicos(this.pagination.current_page)
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
      { value: 'codigo_fragmento', label: 'Código' },
      { value: 'proyecto', label: 'Proyecto' },
      { value: 'fecha_clasificacion', label: 'Fecha de Clasificación' },
      ],
      esProcesoListado: true,
      fragmento: null,
      fragmentos: [],
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
      titulo: 'Listar Análisis Ceramológicos',
    },
    methods: {
      buscar: function (texto, columna) {
        this.procesandoBusqueda = true
        this.busqueda.texto = texto
        this.busqueda.columna = columna
        this.listarAnalisisCeramologicos(1)
      },
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarAnalisisCeramologicos(page);
      },
      crearAnalisisMuestras: function (idFragmento) {
        return '/gicpbam/fichas/analisis_muestras/analisis_ceramologico/' + idFragmento + '/crear'
      },
      crearConservacion: function (idFragmento) {
        return '/gicpbam/fichas/conservacion/analisis_ceramologico/' + idFragmento + '/crear'
      },
      crearDibujoTecnico: function (idFragmento) {
        return '/gicpbam/fichas/dibujo_tecnico/analisis_ceramologico/' + idFragmento + '/crear'
      },
      crearMovimientoFragmento: function (idFragmento) {
        return '/gicpbam/fichas/movimiento/analisis_ceramologico/' + idFragmento + '/crear'
      },
      editarAnalisisCeramologico: function (fragmentoEditar) {
        this.esProcesoListado = false
        this.fragmento = jQuery.extend(true, {}, fragmentoEditar)
        this.titulo = 'Editar Análisis Ceramológico'
      },
      eliminarAnalisisCeramologico: function (idFicha) {
      },
      enlaceReporte: function (idFicha) {
        return '/gicpbam/fichas/analisis_ceramologico/' + idFicha + '/reporte'
      },
      listarAnalisisCeramologicos: function (page) {
        let vm = this
        let uri = '/gicpbam/fichas/ceramologico/listar?page=' + page+ '&columna=' + vm.busqueda.columna + '&texto=' + vm.busqueda.texto
        axios.get(uri)
        .then(function (response) {
          vm.fragmentos = response.data.data.data
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
        this.titulo = 'Listar Análisis Ceramológicos'
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
        this.listarAnalisisCeramologicos(1)
      },
    }
  });
</script>
@endsection
