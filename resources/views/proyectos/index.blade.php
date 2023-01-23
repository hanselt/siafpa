@extends('templates.mantenimientos.layout')

@section('title', 'Listar Proyectos')

@section('breadcrumb')
  <li class="active">Listar Proyectos</li>
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
  <p><strong>Ocurrió un error durante la eliminación.</strong><br>
  @{{ mensajeError }}</p>
</alert>
<!-- /Alertas -->
<transition name="fade">
  <div v-show="listar">
    <buscador :columnas="columnas" :procesando="procesandoBusqueda" v-on:buscar="buscar" v-on:reiniciar="reiniciarListado"></buscador>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th>Modalidad</th>
            <th>Denominación</th>
            <th>Período</th>
            <th class="min-2x">Código Caja</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="proyecto in proyectos">
            <td>@{{ proyecto.PROY_varTipo }}</td>
            <td>@{{ proyecto.PROY_varNombre }}</td>
            <td>@{{ proyecto | proyectoPeriodo }}</td>
            <td>@{{ proyecto.codigo_caja }}</td>
            <td>
              <div class="btn-group" role="group">
                @can('editar_proyectos')
                <tooltip text="Editar"><a class="btn btn-success" v-on:click="editarProyecto(proyecto)"><span class="glyphicon glyphicon-edit"></span></a></tooltip>
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
  <proyecto :proyecto="proyecto" :es-edicion="true" v-on:mensaje="mostrarMensaje" v-on:cancelar="cancelar"></proyecto>
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
        { value: 'PROY_varTipo', label: 'Modalidad' },
        { value: 'PROY_varNombre', label: 'Denominación' },
        { value: 'periodo', label: 'Período' },
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
      procesandoBusqueda: false,
      proyecto: {},
      proyectos: [],
      titulo: 'Listar Proyectos',
    },
    created: function () {
      this.listarProyectos(this.pagination.current_page);
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
    filters: {
      proyectoPeriodo: function (proyecto) {
        return new Date(proyecto.PROY_datFechaIngreso).getFullYear()
      },
    },
    methods: {
      buscar: function (texto, columna) {
        this.procesandoBusqueda = true
        this.busqueda.texto = texto
        this.busqueda.columna = columna
        this.listarProyectos(1)
      },
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarProyectos(page);
      },
      cancelar: function () {
        this.listar = true
        this.titulo = 'Listar Proyectos'
      },
      editarProyecto: function (proyectoEditar) {
        let vm = this
        vm.errors.clear()
        vm.titulo = 'Editar Proyecto'
        vm.proyecto = proyectoEditar
        vm.listar = false
      },
      listarProyectos: function (page) {
        let vm = this
        let uri = '/listar/proyectos?page=' + page + '&columna=' + vm.busqueda.columna + '&texto=' + vm.busqueda.texto
        axios.get(uri)
        .then(function (response) {
          vm.proyectos = response.data.data.data
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
          this.listarProyectos(this.pagination.current_page);
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
        this.listarProyectos(1)
      },
    }
  });
</script>
@endsection
