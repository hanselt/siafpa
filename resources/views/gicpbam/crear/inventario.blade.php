@extends('templates.gicpbam.layout')

@section('title', 'Registrar Inventario y Clasificación')

@section('breadcrumb')
  <li class="active">Registrar Inventario</li>
@endsection

@section('content')
<div class="page-header">
  <h1>Inventario y Clasificación</h1>
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
<!-- Componente que se encarga del manejo de la ficha de catalogación -->
<gicpbam-inventario v-on:mensaje="mostrarMensaje"></gicpbam-inventario>
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
        window.scrollTo(0, 0)
      }
    },
  })
</script>
@endsection
