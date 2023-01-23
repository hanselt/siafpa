@extends('templates.layout')

@section('content')
  <h1 class="page-header">Esta no es la página que estás buscando.</h1>
  <p>Si llegaste aquí es probable que el recurso que busques haya cambiado de nombre o se haya movido.</p>
  <p><small>404 error. @{{ fechaHora }}</small></p>
@endsection

@section('scripts')
  <script>
  let app = new Vue({
    el: '#app',
    computed: {
      fechaHora: function () {
        return moment().format('DD/MM/YYYY HH:mm:ss A')
      },
    }
  })
  </script>
@endsection