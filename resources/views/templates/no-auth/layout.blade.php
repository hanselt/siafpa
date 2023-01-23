<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }} | @yield('title') </title>
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/base/app.css') }}">
  <!-- Fuentes -->
  <link rel="stylesheet" href="{{ asset('css/base/fonts.css') }}">
  <script>
  window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
    ]) !!};
  </script>
  @yield('styles')
</head>
<body @yield('body-attrs')>
  <!-- Page Content -->
  <div id="app" v-cloak>
    @yield('content')
  </div>
  <!-- /Page Content -->
  <!-- Scripts -->
  <script src="{{ mix('js/manifest.js') }}"></script>
  <script src="{{ mix('js/vendor.js') }}"></script>
  <script src="{{ mix('js/app.js') }}"></script>
  @yield('scripts')
</body>
</html>
