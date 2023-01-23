@extends('templates.gmcpcam.layout')

@section('title', 'Registrar Control de Humedad')

@section('breadcrumb')
  <li class="active">Registrar Control de Humedad</li>
@endsection

@section('content')
<div class="page-header">
  <h1>Control de Humedad</h1>
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
<gicpbam-control-humedad v-on:mensaje="mostrarMensaje"></gicpbam-control-humedad>
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
