@extends('templates.gmcpcam.layout')

@section('title', 'Crear Ficha de Catalogación')

@section('breadcrumb')
  <li class="active">Crear Ficha de Catalogación</li>
@endsection

@section('content')
<div class="page-header">
  <h1>Crear Ficha de Catalogación</h1>
</div>
<!-- Alertas -->
<alert type="success" dismissible v-if="alertarExito" @dismissed="alertarExito=false" :duration="4500">
  <p><strong>¡Éxito!</strong><br>
  @{{ mensajeExito }}</p>
</alert>
<alert type="danger" dismissible v-if="alertarError" @dismissed="alertarError=false" :duration="9000">
  <p><strong>Ocurrió un error. Intente nuevamente en unos minutos.</strong><br>
  @{{ mensajeError }}</p>
</alert>
<!-- /Alertas -->
<!-- Componente que maneja la lógica de Ficha de CAtalogación -->
<gmcpcam-catalogacion v-on:mensaje="mostrarMensaje"></gmcpcam-catalogacion>
<!-- /Componente que maneja la lógica de Ficha de CAtalogación -->
@endsection

@section('scripts')
<script>
  let app = new Vue({
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
