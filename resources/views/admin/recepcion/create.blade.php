<!-- JWCC SE MODIFICA EL LAYOUT-->
@extends('templates.mantenimientos.layout')
@section('content')

  <!--13 nov-->  
    <div class="container mrg15T row">
      <div class="col-md-12">
        <div class="content-box" style="background-color:#f5f8fa">
            <h3 class="content-box-header bg-danger" style="background-color:#cf4436">
                Recepción de expedientes de Certificaciones
            </h3>
            <form method="POST" action="recepcionPA">
                <input type="hidden" value="{{ csrf_token() }}" />
                <div class="form-inline"> 
                <center>        
                  <div class="form-group ">
                    <input type="text" class="form-control" id="hr" name="hr" placeholder="HOJA DE RUTA">
                    <button type="submit" class="btn btn-primary" name="action">Recepcionar</button>
                  </div>
                </center>    
                </div>         
                @include('admin.recepcion.form')            
            </form>
            
        </div>
      </div>
    </div>

<div class="hero-box poly-bg-5 hero-box-smaller font-inverse" style="background:url('{{ URL::asset('img/poly-bg/poly-bg-5.jpg') }}')">
            <div class="container">
                <h2 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Advertencia</h2>
                <p class="hero-text wow bounceInUp" data-wow-duration="0.9s" data-wow-delay="0.2s">Acceso Restringido.</p>
            </div>
</div>
@endsection
@section('scripts')
<script>
  let app = new Vue({
    el: '#app',
    data: {
      alertarExito: false,
      alertarError: false,
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
      subtipo: '',
      subtipos: [],
      termino: {
        denominacion: null,
        estado: null,
        id_material: null,
        tipo: null,
      },
      terminos: [],
      titulo: 'Listar Personas',
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
        var from = this.pagination.current_page - this.offset;
        if (from < 1) {
          from = 1;
        }
        var to = from + (this.offset * 2);
        if (to >= this.pagination.last_page) {
          to = this.pagination.last_page;
        }
        var pagesArray = [];
        while (from <= to) {
          pagesArray.push(from);
          from++;
        }
        return pagesArray;
      }
    },
    methods: {
      cancelar: function () {
        this.listar = true
        this.titulo = 'Listar Términos'
      },
      listarTerminos: function (page) {
        var vm = this
        var uri = '/terminos?page=' + page
        axios.get(uri)
        .then(function (response) {
          vm.terminos = response.data.data.data
          vm.pagination = response.data.pagination
        })
        .catch(function (error) {
          console.log(error)
        });
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
      cambiarPagina: function (page) {
        this.pagination.current_page = page;
        this.listarTerminos(page);
      },
      editarTermino: function (termino_editar) {
        var vm = this
        vm.titulo = 'Editar Término'
        vm.termino = termino_editar
        vm.cambioTipo()
        vm.subtipo = vm.termino.subtipo == null ? '' : vm.termino.subtipo.slice(vm.termino.tipo.length + 1)
        vm.listar = false
      },
      cambioTipo: function () {
        var vm = this
        vm.subtipo = ''
        vm.subtipos = vm.$datosGlobales.subtipos_lista.filter(function(item) {
          return item.tipo == vm.termino.tipo
        })
      },
      eliminarTermino: function (id) {
        var vm = this
        vm.$swal({
          title: '¿Está seguro de eliminar?',
          text: "Esta acción no se puede revertir.",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Aceptar',
          cancelButtonText: 'Cancelar',
        })
        .then(function () {
          var uri = '/terminos/' + id
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
      actualizarTermino: function () {
        if (!this.esFormValido()) {
          return;
        }
        var vm = this
        var uri = '/terminos/' + vm.termino.id
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
      esFormValido : function () {
        this.errorDenominacion = (this.termino.denominacion == '')
        this.errorTipo = (this.termino.tipo == '')
        return !this.errorDenominacion && !this.errorTipo
      },
    }
  });
</script>
@endsection