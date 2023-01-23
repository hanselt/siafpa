@extends('templates.gmcpcam.layout')

@section('title', 'Controles de Humedad')

@section('breadcrumb')
  <li class="active">Controles de Humedad</li>
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
            <th>Espacio</th>
            <th>Humedad</th>
            <th>Temperatura</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th class="th-acciones min">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="controlAux in controlesHumedad">
            <td>@{{ controlAux.nro_ficha }}</td>
            <td>@{{ controlAux.espacio_monitoreado.denominacion }}</td>
            <td>@{{ controlAux.humedad }}</td>
            <td>@{{ controlAux.temperatura }}</td>
            <td>@{{ controlAux.fecha }}</td>
            <td>@{{ controlAux.hora }}</td>
            <td>
              <div class="btn-group" role="group">
                @can('editar_control_humedad')
                <btn v-tooltip="'Editar'" type="success" v-on:click="editarControlHumedad(controlAux)"><span class="glyphicon glyphicon-edit"></span></btn>
                @endcan
                @can('eliminar_control_humedad')
                <btn v-tooltip="'Eliminar'" type="danger" v-on:click="eliminarControlHumedad(controlAux.id)"><span class="glyphicon glyphicon-trash"></span></btn>
                @endcan
                @can('ver_control_humedad_reporte')
                <btn :href="enlaceReporte(controlAux.id)" v-tooltip="'Ver Reporte'" type="default" target="_blank"><i class="fa fa-file-pdf-o"></i></btn>
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
  <gicpbam-control-humedad :es-edicion="true" v-model="control" v-on:volver="mostrarListado" v-on:actualizar="listarControlesHumedad(pagination.current_page)" v-on:mensaje="mostrarMensaje"></gicpbam-control-humedad>
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
      this.listarControlesHumedad(this.pagination.current_page)
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
        { value: 'espacio_monitoreado', label: 'Espacio Monitoreado' },
        { value: 'fecha', label: 'Fecha' },
      ],
      control: null,
      controlesHumedad: [],
      esProcesoListado: true,
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
      titulo: 'Listar Controles de Humedad',
    },
    methods: {
      buscar: function (texto, columna) {
        this.procesandoBusqueda = true
        this.busqueda.texto = texto
        this.busqueda.columna = columna
        this.listarControlesHumedad(1)
      },
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarControlesHumedad(page);
      },
      editarControlHumedad: function (controlEditar) {
        this.esProcesoListado = false
        this.control = jQuery.extend(true, {}, controlEditar)
        this.titulo = 'Editar Control de Humedad'
      },
      eliminarControlHumedad: function (idFicha) {
      },
      enlaceReporte: function (idFicha) {
        return '/gicpbam/fichas/control_humedad/' + idFicha + '/reporte'
      },
      listarControlesHumedad: function (page) {
        let vm = this
        let uri = '/gicpbam/fichas/control_humedad/listar?page=' + page + '&columna=' + vm.busqueda.columna + '&texto=' + vm.busqueda.texto
        axios.get(uri)
        .then(function (response) {
          vm.controlesHumedad = response.data.data.data
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
        this.titulo = 'Listar Controles de Humedad'
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
        this.listarControlesHumedad(1)
      },
    }
  });
</script>
@endsection
