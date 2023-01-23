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
    <buscador :columnas="columnas" :procesando="procesandoBusqueda" v-on:buscar="buscar" v-on:reiniciar="reiniciarListado"></buscador>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th class="max">Proyecto / Poseedor / Registrador</th>
            <th>Documento Ingreso</th>
            <th>Fecha Registro</th>
            <th class="th-acciones">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="fichaAux in fichasInventario">
            <td>@{{ fichaAux.proyecto.nombre }}<br><b>Poseedor:</b> @{{ fichaAux.poseedor }}<br><b>Registrador:</b> @{{ fichaAux.registrador.name }}</td>
            <td>@{{ fichaAux.proyecto.documento_ingreso }}</td>
            <td>@{{ fichaAux.fecha_registro }}</td>
            <td>
              <div class="btn-group">
                @can('editar_inventario')
                <btn v-tooltip="'Editar'" type="success" v-on:click="editarFichaInventario(fichaAux)"><span class="glyphicon glyphicon-edit"></span></btn>
                @endcan
                @can('eliminar_inventario')
                <btn v-tooltip="'Eliminar'" type="danger" v-on:click="eliminarFichaInventario(fichaAux.id)"><span class="glyphicon glyphicon-trash"></span></btn>
                @endcan
                @can('crear_catalogacion')
                <btn :href="crearFichaCatalogacion(fichaAux.id)" v-tooltip="'Crear Ficha de Catalogación'" type="primary"><i class="fa fa-file-text-o"></i></btn>
                @endcan
                @can('crear_ceramologico')
                <btn :href="crearAnalisisCeramologico(fichaAux.id)" v-tooltip="'Crear Análisis Ceramológico'" type="primary"><i class="fa fa-file-text"></i></btn>
                @endcan
                @can('ver_inventario_reporte')
                <btn :href="enlaceReporte(fichaAux.id)" v-tooltip="'Ver Reporte'" type="default" target="_blank"><i class="fa fa-file-pdf-o"></i></btn>
                @endcan
                @can('ver_inventario_reporte_detalle')
                <btn :href="enlaceReporteDetalle(fichaAux.id)" v-tooltip="'Ver Reporte Detalle'" type="default" target="_blank"><i class="fa fa-file-pdf-o"></i></btn>
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
  <gmcpcam-inventario :es-edicion="true" v-model="ficha" v-on:volver="mostrarListado" v-on:actualizar="listarFichasInventario(pagination.current_page)" v-on:mensaje="mostrarMensaje"></gmcpcam-inventario>
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
      this.listarFichasInventario(this.pagination.current_page)
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
        { value: 'proyecto', label: 'Proyecto' },
        { value: 'registrador', label: 'Registrador' },
        { value: 'fecha_registro', label: 'Fecha de Registro' },
      ],
      esProcesoListado: true,
      ficha: null,
      fichasInventario: [],
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
      titulo: 'Listar Fichas de Inventario',
    },
    methods: {
      buscar: function (texto, columna) {
        this.procesandoBusqueda = true
        this.busqueda.texto = texto
        this.busqueda.columna = columna
        this.listarFichasInventario(1)
      },
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarFichasInventario(page);
      },
      crearAnalisisCeramologico: function (idInventario) {
        return '/gicpbam/fichas/ceramologico/inventario/' + idInventario + '/crear'
      },
      crearFichaCatalogacion: function (idFichaInventario) {
        return '/gmcpcam/fichas/catalogacion/inventario/' + idFichaInventario + '/crear'
      },
      editarFichaInventario: function (fichaEditar) {
        this.esProcesoListado = false
        this.ficha = fichaEditar
        this.titulo = 'Editar Ficha de Inventario'
      },
      eliminarFichaInventario: function (idFicha) {
      },
      enlaceReporte: function (idFicha) {
        return '/gmcpcam/fichas/inventario/' + idFicha + '/reporte'
      },
      enlaceReporteDetalle: function (idFicha) {
        return '/gicpbam/fichas/inventario_f2/' + idFicha + '/reporte'
      },
      listarFichasInventario: function (page) {
        let vm = this
        let uri = '/gmcpcam/fichas/inventario/listar?page=' + page + '&columna=' + vm.busqueda.columna + '&texto=' + vm.busqueda.texto
        axios.get(uri)
        .then(function (response) {
          vm.fichasInventario = response.data.data.data
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
        this.titulo = 'Listar Fichas de Inventario'
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
        this.listarFichasInventario(1)
      },
    }
  });
</script>
@endsection
