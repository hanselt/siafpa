@extends('templates.mantenimientos.layout')

@section('title', 'Perfil')

@section('breadcrumb')
<li class="active">Perfil</li>
@endsection

@section('content')
<div class="page-header">
  <h1>Perfil</h1>
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
<usuario v-model="usuario" :es-perfil="true" v-on:mensaje="mostrarMensaje"></usuario>
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
      usuario: null,
    },
    created: function () {
      this.recuperarUsuario();
    },
    methods: {
      recuperarUsuario: function () {
        let vm = this
        let uri = '/perfil/usuario'
        axios.get(uri)
        .then(function (response) {
          if (response.data.resultado) {
            vm.usuario = response.data.usuario
          } else {
            console.log(response.data.mensaje)
          }
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
    }
  });
</script>
@endsection
