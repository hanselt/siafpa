<!DOCTYPE html>
<html lang="en" class="{{ config('app.os', 'unix') }}">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{{ asset('css/base/reportes.css') }}">
</head>
<body>
  <header>
    <p class="text-center">{{ $ficha }}</p>
    <img src="{{ url('img/ddcc.jpeg') }}" alt="" class="ddcc center-block">
  </header>
</body>
</html>
