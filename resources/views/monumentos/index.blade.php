@extends('templates.mantenimientos.layout')

@section('title', 'Listar Monumentos')

@section('breadcrumb')
<li class="active">Listar Monumentos</li>
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
    <buscador :columnas="columnas" :procesando="procesandoBusqueda" v-on:buscar="buscar" v-on:reiniciar="reiniciarTerminos"></buscador>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Abreviatura</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="monumentoAux in monumentos">
            <td>@{{ monumentoAux.MONU_varNombre }}</td>
            <td>@{{ monumentoAux.abreviatura }}</td>
            <td>
              <div class="btn-group" role="group">
                @can('editar_monumentos')
                <tooltip text="Editar"><a class="btn btn-success" v-on:click="editarMonumento(monumentoAux)"><span class="glyphicon glyphicon-edit"></span></a></tooltip>
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
  <monumento :monumento="monumento" :es-edicion="true" v-on:mensaje="mostrarMensaje" v-on:cancelar="cancelar"></monumento>
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
        { value: 'MONU_varNombre', label: 'Nombre' },
        { value: 'abreviatura', label: 'Abreviatura' },
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
      procesandoBusqueda: false,
      monumento: {},
      monumentos: [],
      titulo: 'Listar Monumentos',
    },
    created: function () {
      this.listarMonumentos(this.pagination.current_page);
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
        this.listarMonumentos(1)
      },
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarMonumentos(page);
      },
      cancelar: function () {
        this.listar = true
        this.titulo = 'Listar Monumentos'
      },
      editarMonumento: function (monumentoEditar) {
        let vm = this
        vm.errors.clear()
        vm.titulo = 'Editar Monumento'
        vm.monumento = monumentoEditar
        vm.listar = false
      },
      listarMonumentos: function (page) {
        let vm = this
        let uri = '/listar/monumentos?page=' + page + '&columna=' + vm.busqueda.columna + '&texto=' + vm.busqueda.texto
        axios.get(uri)
        .then(function (response) {
          vm.monumentos = response.data.data.data
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
          this.listarMonumentos(this.pagination.current_page);
          this.listar = true
        } else {
          this.alertarError = true
          this.mensajeError = mensaje
        }
        window.scrollTo(0, 0)
      },
      reiniciarTerminos: function () {
        this.busqueda = {
          columna: '',
          texto: '',
        }
        this.listarMonumentos(1)
      },
    }
  });
</script>
@endsection
