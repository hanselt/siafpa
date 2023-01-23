@extends('templates.mantenimientos.layout')

@section('title', 'Listar Términos')

@section('breadcrumb')
<li class="active">Listar Término</li>
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
    <buscador :columnas="columnas" :procesando="procesandoBusqueda" v-on:buscar="buscar" v-on:reiniciar="reiniciarTerminos"></buscador>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th>Denominación</th>
            <th>Tipo</th>
            <th>Material</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="termino in terminos">
            <td>@{{ termino.denominacion }}</td>
            <td>@{{ _.startCase(termino.tipo) }}</td>
            <td>@{{ termino.material ? termino.material.denominacion : '' }}</td>
            <td>@{{ termino.estado ? 'Habilitado' : 'Inhabilitado' }}</td>
            <td>
              <div class="btn-group" role="group">
                @can('editar_terminos')
                <btn type="success" v-on:click="editarTermino(termino)" v-tooltip="'Editar'"><span class="glyphicon glyphicon-edit"></span></btn>
                @endcan
                @can('eliminar_terminos')
                <a class="btn btn-danger" v-on:click="eliminarTermino(termino.id)"><tooltip text="Eliminar"><span class="glyphicon glyphicon-trash"></span></tooltip></a>
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
  <form action="" class="form-horizontal" v-on:submit.prevent="actualizarTermino" novalidate="">
    <div class="form-group" :class="errorDenominacion ? 'has-error' : ''">
      <label for="denominacion" class="col-sm-2 control-label">Denominación</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="denominacion" id="denominacion" v-model="termino.denominacion" ref='first'>
        <span class="help-block" v-show="errorDenominacion">La Denominación no puede estar vacía.</span>
      </div>
    </div>
    <div class="form-group" :class="errorTipo ? 'has-error' : ''">
      <label for="tipo" class="col-sm-2 control-label">Tipo</label>
      <div class="col-sm-4">
        <select name="tipo" id="tipo" class="form-control" v-model="termino.tipo" v-on:change="cambioTipo">
          <option disabled value="">-- Seleccione --</option>
          <option v-for="tipoAux in $datosGlobales.tipos" v-bind:value="tipoAux">@{{ _.startCase(tipoAux) }}</option>
        </select>
        <span class="help-block" v-show="errorTipo">Seleccione un Tipo.</span>
      </div>
    </div>
    <div class="form-group">
      <label for="subtipo" class="col-sm-2 control-label">Subtipo</label>
      <div class="col-sm-4">
        <select name="subtipo" id="subtipo" class="form-control" v-model="subtipo">
          <option disabled value="">-- Seleccione --</option>
          <option v-for="subtipoAux in subtipos" v-bind:value="subtipoAux.denominacion">@{{ _.startCase(subtipoAux.denominacion) }}</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="material" class="col-sm-2 control-label">Material</label>
      <div class="col-sm-4">
        <select name="material" id="material" class="form-control" v-model="termino.id_material">
          <option disabled value="">-- Seleccione --</option>
          <option v-for="materialAux in materiales" v-bind:value="materialAux.id">@{{ materialAux.denominacion }}</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="estado" class="col-sm-2 control-label">Estado</label>
      <div class="col-sm-4">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="estado" id="estado" v-model="termino.estado"> Marque esta opción para habilitar el termino
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-4">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default" v-on:click="cancelar">Cancelar</button>
      </div>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script>
  let app = new Vue({
    el: '#app',
    data: {
      alertarExito: false,
      alertarError: false,
      busqueda: {
        columna: '',
        texto: '',
      },
      columnas: [
        { value: 'denominacion', label: 'Denominación' },
      ],
      errorDenominacion : false,
      errorTipo : false,
      listar: true,
      materiales: [],
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
      subtipo: '',
      subtipos: [],
      termino: {
        denominacion: null,
        estado: null,
        id_material: null,
        tipo: null,
      },
      terminos: [],
      titulo: 'Listar Términos',
    },
    created: function () {
      this.listarTerminos(this.pagination.current_page);
      this.listarMateriales();
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
      actualizarTermino: function () {
        if (!this.esFormValido()) {
          return;
        }
        let vm = this
        let uri = '/terminos/' + vm.termino.id
        axios.put(uri, {
          tipo : vm.termino.tipo,
          subtipo : typeof vm.subtipo !== 'undefined' && vm.subtipo != '' ? (vm.termino.tipo + '_' + vm.subtipo) : null,
          id_material : vm.termino.id_material,
          denominacion : vm.termino.denominacion,
          id_padre : null,
          estado : vm.termino.estado,
        })
        .then(function (response) {
          if (response.data.resultado) {
            // Mostrar alerta
            vm.mensajeExito = 'Término actualizado satisfactoriamente.'
            vm.alertarExito = true;
            vm.listarTerminos(vm.pagination.current_page);
            vm.listar = true
          } else {
            // Mostrar alerta
            vm.mensajeError = response.data.mensaje
            vm.alertarError = true;
          }
        })
        .catch(function (error) {
          // Mostrar alerta de error
          vm.mensajeError = ''
          vm.alertarError = true;
          console.log(error);
        })
      },
      buscar: function (texto, columna) {
        this.procesandoBusqueda = true
        this.busqueda.texto = texto
        this.busqueda.columna = columna
        this.listarTerminos(1)
      },
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarTerminos(page);
      },
      cambioTipo: function () {
        let vm = this
        vm.subtipo = ''
        vm.subtipos = vm.$datosGlobales.subtipos_lista.filter(function(item) {
          return item.tipo == vm.termino.tipo
        })
      },
      cancelar: function () {
        this.listar = true
        this.titulo = 'Listar Términos'
      },
      editarTermino: function (termino_editar) {
        let vm = this
        vm.titulo = 'Editar Término'
        vm.termino = termino_editar
        vm.cambioTipo()
        vm.subtipo = vm.termino.subtipo == null ? '' : vm.termino.subtipo.slice(vm.termino.tipo.length + 1)
        vm.listar = false
      },
      eliminarTermino: function (id) {
        let vm = this
        vm.$swal({
          title: '¿Está seguro de eliminar?',
          text: "Esta acción no se puede revertir.",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
        })
        .then(function () {
          let uri = '/terminos/' + id
          axios.delete(uri).then(function (response) {
            if (response.data.resultado) {
              // Mostrar alerta
              vm.mensajeExito = 'Término eliminado satisfactoriamente.'
              vm.alertarExito = true;
              vm.listarTerminos(vm.pagination.current_page);
            } else {
              // Mostrar alerta
              vm.mensajeError = response.data.mensaje
              vm.alertarError = true;
            }
          })
          .catch(function (error) {
            // Mostrar alerta de error
            vm.mensajeError = ''
            vm.alertarError = true;
            console.log(error);
          })
        })
      },
      esFormValido : function () {
        this.errorDenominacion = (this.termino.denominacion == '')
        this.errorTipo = (this.termino.tipo == '')
        return !this.errorDenominacion && !this.errorTipo
      },
      listarMateriales: function () {
        let uri = '/materiales';
        let vm = this
        axios.get(uri)
        .then(function (response) {
          vm.materiales = response.data
        })
        .catch(function (error) {
          console.log(error);
        });
      },
      listarTerminos: function (page) {
        let vm = this
        let uri = '/listar/terminos?page=' + page + '&columna=' + vm.busqueda.columna + '&texto=' + vm.busqueda.texto
        axios.get(uri)
        .then(function (response) {
          vm.terminos = response.data.data.data
          vm.pagination = response.data.pagination
        })
        .then(function () {
          vm.procesandoBusqueda = false
        })
        .catch(function (error) {
          console.log(error)
        });
      },
      reiniciarTerminos: function () {
        this.busqueda = {
          columna: '',
          texto: '',
        }
        this.listarTerminos(1)
      },
    }
  });
</script>
@endsection
