@extends('templates.mantenimientos.layout')

@section('title', 'Crear Requisa')

@section('breadcrumb')
  <li class="active">Crear Requisa</li>
@endsection

@section('content')
<div class="page-header">
  <h1>Crear Requisa</h1>
</div>
<!-- Alertas -->
<alert type="success" dismissible v-if="alertarExito" @dismissed="alertarExito=false" :duration="4500">
  <p><strong>¡Éxito!</strong><br>
  @{{ mensajeExito }}</p>
</alert>
<alert type="danger" dismissible v-if="alertarError" @dismissed="alertarError=false" :duration="9000">
  <p><strong>Ocurrió un error durante la creación.</strong><br>
  @{{ mensajeError }}</p>
</alert>
<!-- /Alertas -->
<!-- Componente para manejar la lógica de Requisas -->
<requisa v-on:mensaje="mostrarMensaje"></requisa>
<!-- /Componente para manejar la lógica de Requisas -->
@endsection

@section('scripts')
<script>
  const app = new Vue({
    el: '#app',
    data: {
      alertarExito: false,
      alertarError: false,
      mensajeExito: '',
      mensajeError: '',
    },
    methods: {
      mostrarMensaje: function (mensaje, esExito) {
        if (esExito) {
          this.alertarExito = true
          this.mensajeExito = mensaje
        } else {
          this.alertarError = true
          this.mensajeError = mensaje
        }
        // Scroll top de la página
        this.$scrollTo('body', 200)
      }
    },
  })
</script>
@endsection
