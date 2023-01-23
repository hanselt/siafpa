@extends('templates.dfq.layout')

@section('title', 'Peritaje de Autenticidad de Especímenes Fósiles')

@section('breadcrumb')
  <li class="active">Peritaje de Autenticidad de Especímenes Fósiles</li>
@endsection

@section('content')
<div class="page-header">
  <h1>Peritaje de Autenticidad de Especímenes Fósiles</h1>
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
<dfq-peritaje-fosiles v-on:mensaje="mostrarMensaje"></dfq-peritaje-fosiles>
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
