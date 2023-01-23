@extends('templates.gmcpcam.layout')

@section('title', 'Movimientos de Fragmentos')

@section('breadcrumb')
  <li class="active">Movimientos de Fragmentos</li>
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
            <th>Nro. Ficha</th>
            <th>Código de Fragmento</th>
            <th>Procedencia</th>
            <th>Destino</th>
            <th>Fecha de entrega</th>
            <th>Fecha de devolución</th>
            <th class="th-acciones min">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="movimientoAux in movimientosFragmentos">
            <td>@{{ movimientoAux.nro_ficha }}</td>
            <td>@{{ movimientoAux.fragmento.codigo_fragmento }}</td>
            <td>@{{ movimientoAux.procedencia }}</td>
            <td>@{{ movimientoAux.destino }}</td>
            <td>@{{ movimientoAux.fecha_entrega }}</td>
            <td>@{{ movimientoAux.fecha_devolucion }}</td>
            <td>
              <div class="btn-group" role="group">
                @can('editar_movimiento_fragmento')
                <btn v-tooltip="'Editar'" type="success" v-on:click="editarMovimientoFragmento(movimientoAux)"><span class="glyphicon glyphicon-edit"></span></btn>
                @endcan
                @can('eliminar_movimiento_fragmento')
                <btn v-tooltip="'Eliminar'" type="danger" v-on:click="eliminarMovimientoFragmento(movimientoAux.id)"><span class="glyphicon glyphicon-trash"></span></btn>
                @endcan
                @can('ver_movimiento_fragmento_reporte')
                <btn :href="enlaceReporte(movimientoAux.id)" v-tooltip="'Ver Reporte'" type="default" target="_blank"><i class="fa fa-file-pdf-o"></i></btn>
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
  <gicpbam-movimiento :es-edicion="true" v-model="movimiento" v-on:volver="mostrarListado" v-on:actualizar="listarMovimientosFragmentos(pagination.current_page)" v-on:mensaje="mostrarMensaje"></gicpbam-movimiento>
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
      this.listarMovimientosFragmentos(this.pagination.current_page)
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
        { value: 'procedencia', label: 'Procedencia' },
        { value: 'destino', label: 'Destino' },
        { value: 'fecha_entrega', label: 'Fecha de Entrega' },
        { value: 'fecha_devolucion', label: 'Fecha de Devolución' },
      ],
      esProcesoListado: true,
      movimiento: null,
      movimientosFragmentos: [],
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
      titulo: 'Listar Movimientos de Fragmentos',
    },
    methods: {
      buscar: function (texto, columna) {
        this.procesandoBusqueda = true
        this.busqueda.texto = texto
        this.busqueda.columna = columna
        this.listarMovimientosFragmentos(1)
      },
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarMovimientosFragmentos(page);
      },
      editarMovimientoFragmento: function (movimientoEditar) {
        this.esProcesoListado = false
        this.movimiento = jQuery.extend(true, {}, movimientoEditar)
        this.titulo = 'Editar Movimiento de Fragmento'
      },
      eliminarMovimientoFragmento: function (idFicha) {
      },
      enlaceReporte: function (idFicha) {
        return '/gicpbam/fichas/movimiento/' + idFicha + '/reporte'
      },
      listarMovimientosFragmentos: function (page) {
        let vm = this
        let uri = '/gicpbam/fichas/movimiento/listar?page=' + page + '&columna=' + vm.busqueda.columna + '&texto=' + vm.busqueda.texto
        axios.get(uri)
        .then(function (response) {
          vm.movimientosFragmentos = response.data.data.data
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
        this.titulo = 'Listar Movimientos de Fragmentos'
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
        this.listarMovimientosFragmentos(1)
      },
    }
  });
</script>
@endsection
