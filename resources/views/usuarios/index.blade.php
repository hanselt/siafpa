@extends('templates.mantenimientos.layout')

@section('title', 'Listar Usuarios')

@section('breadcrumb')
  <li class="active">Usuarios</li>
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
  <div v-show="esProcesoListado">
    <buscador :columnas="columnas" :procesando="procesandoBusqueda" v-on:buscar="buscar" v-on:reiniciar="reiniciarListado"></buscador>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-condensed" style="table-layout: fixed;">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Estado</th>
            <th>Rol</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="usuario in usuarios">
            <td>@{{ usuario.name }}</td>
            <td>@{{ usuario.email }}</td>
            <td>@{{ usuario.estado ? 'Habilitado' : 'Inhabilitado' }}</td>
            <td>@{{ usuario.roles[0].name }}</td>
            <td>
              <div class="btn-group" role="group">
                @can('editar_usuarios')
                <btn v-tooltip="'Editar'" type="success" v-on:click="editarUsuario(usuario)"><span class="glyphicon glyphicon-edit"></span></btn>
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
  <usuario v-model="usuario" :es-edicion="true" v-on:mensaje="mostrarMensaje" v-on:volver="volverAlListado"></usuario>
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
        { value: 'name', label: 'Nombre' },
        { value: 'email', label: 'Email' },
      ],
      esProcesoListado: true,
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
      usuario: null,
      usuarios: [],
      titulo: 'Listar Usuarios',
    },
    created: function () {
      this.listarUsuarios(this.pagination.current_page);
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
        this.listarUsuarios(1)
      },
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarUsuarios(page);
      },
      editarUsuario: function (usuarioEditar) {
        let vm = this
        vm.titulo = 'Editar Usuario'
        vm.usuario = jQuery.extend(true, {}, usuarioEditar)
        vm.esProcesoListado = false
      },
      listarUsuarios: function (page) {
        let vm = this
        let uri = '/listar/usuarios?page=' + page + '&columna=' + vm.busqueda.columna + '&texto=' + vm.busqueda.texto
        axios.get(uri)
        .then(function (response) {
          vm.usuarios = response.data.data.data
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
        } else {
          this.alertarError = true
          this.mensajeError = mensaje
        }
        window.scrollTo(0, 0)
      },
      volverAlListado: function () {
        this.esProcesoListado = true
        this.listarUsuarios(this.pagination.current_page)
        this.titulo = 'Listar Usuarios'
      },
      reiniciarListado: function () {
        this.busqueda = {
          columna: '',
          texto: '',
        }
        this.listarUsuarios(1)
      },
    }
  });
</script>
@endsection
