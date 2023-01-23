@extends('templates.mantenimientos.layout')

@section('title', 'Crear Término')

@section('breadcrumb')
  <li class="active">Crear Término</li>
@endsection

@section('content')
<div class="page-header">
  <h1>Crear Término</h1>
</div>
<!-- Alertas -->
<alert type="success" dismissible v-if="alertarExito" @dismissed="alertarExito=false" :duration="4500">
  <p><strong>¡Éxito!</strong><br>
  Término creado satisfactoriamente.</p>
</alert>
<alert type="danger" dismissible v-if="alertarError" @dismissed="alertarError=false" :duration="9000">
  <p><strong>Ocurrió un error durante la creación</strong><br>
  Por favor intente nuevamente en unos minutos.</p>
</alert>
<!-- /Alertas -->
<form action="" class="form-horizontal" v-on:submit.prevent="guardar" novalidate="">
  <div class="form-group" :class="errorDenominacion ? 'has-error' : ''">
    <label for="denominacion" class="col-sm-2 control-label">Denominación</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="denominacion" id="denominacion" v-model="denominacion" ref='first'>
      <span class="help-block" v-show="errorDenominacion">La Denominación no puede estar vacía.</span>
    </div>
  </div>
  <div class="form-group" :class="errorTipo ? 'has-error' : ''">
    <label for="tipo" class="col-sm-2 control-label">Tipo</label>
    <div class="col-sm-4">
      <select name="tipo" id="tipo" class="form-control" v-model="tipo" v-on:change="cambioTipo">
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
      <select name="material" id="material" class="form-control" v-model="material">
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
          <input type="checkbox" name="estado" id="estado" v-model="estado"> Marque esta opción para habilitar el elemento
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
  </div>
</form>
@endsection

@section('scripts')
<script>
  const app = new Vue({
    el : '#app',
    created : function() {
      this.listarMateriales();
    },
    mounted : function () {
      this.$refs.first.focus();
    },
    data : {
      alertarExito: false,
      alertarError: false,
      denominacion : '',
      errorDenominacion : false,
      errorTipo : false,
      estado : true,
      material : '',
      materiales : [],
      subtipo : '',
      subtipos : [],
      tipo : '',
    },
    methods : {
      cambioTipo: function () {
        var vm = this
        vm.subtipo = ''
        vm.subtipos = vm.$datosGlobales.subtipos_lista.filter(function(item) {
          return item.tipo == vm.tipo
        })
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
      guardar: function () {
        if (!this.esFormValido()) {
          return;
        }
        let vm = this
        let uri = '/terminos';
        axios.post(uri, {
          tipo : vm.tipo,
          subtipo : typeof vm.subtipo !== 'undefined' && vm.subtipo != '' ? (vm.tipo + '_' + vm.subtipo) : null,
          id_material : vm.material,
          denominacion : vm.denominacion,
          id_padre : null,
          estado : vm.estado,
        })
        .then(function (response) {
          vm.denominacion = ''
          vm.tipo = ''
          vm.subtipo = ''
          vm.material = ''
          vm.estado = true
          // Mostrar alerta y recuperar foco
          vm.alertarExito = true;
          vm.$refs.first.focus();
        })
        .catch(function (error) {
          // Mostrar alerta de error
          vm.alertarError = true;
          console.log(error);
        })
      },
      esFormValido : function () {
        this.errorDenominacion = (this.denominacion == '')
        this.errorTipo = (this.tipo == '')
        return !this.errorDenominacion && !this.errorTipo
      },
    },
  })
</script>
@endsection
