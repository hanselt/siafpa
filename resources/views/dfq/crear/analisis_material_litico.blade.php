@extends('templates.dfq.layout')

@section('title', 'Análisis de Material Lítico')

@section('breadcrumb')
  <li class="active">Análisis de Material Lítico</li>
@endsection

@section('content')
<div class="page-header">
  <h1>Análisis de Material Lítico</h1>
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
<!-- Componente que se encarga del manejo de la ficha de inventario óseo humano-->
<dfq-analisis-material-litico v-on:mensaje="mostrarMensaje"></dfq-analisis-material-litico>
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
        // Scroll top de la página
        this.$scrollTo('body', 200)
        if (esExito) {
          this.alertarExito = true
          this.mensajeExito = mensaje
        } else {
          this.alertarError = true
          this.mensajeError = mensaje
        }
      }
    },
  })
</script>
@endsection
