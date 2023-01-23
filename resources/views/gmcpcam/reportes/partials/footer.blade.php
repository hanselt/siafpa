<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <script>
    function substitutePdfVariables() {

      function getParameterByName(name) {
        var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
        return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
      }

      function substitute(name) {
        var value = getParameterByName(name);
        var elements = document.getElementsByClassName(name);

        for (var i = 0; elements && i < elements.length; i++) {
          elements[i].textContent = value;
        }
      }

      ['frompage', 'topage', 'page', 'webpage', 'section', 'subsection', 'subsubsection']
      .forEach(function(param) {
        substitute(param);
      });
    }
  </script>
  <link rel="stylesheet" href="{{ asset('css/base/reportes.css') }}">
</head>
<body onload="substitutePdfVariables()">
  <footer>
    <table style="table-layout: fixed; width: 100%; font-family: Arial, sans-serif;">
      <tr>
        <td></td>
        <td style="text-align: center;"> Página <span class="page"></span></td>
        <td style="text-align: right;">{{ $footer_right }}</td>
      </tr>
    </table>
  </footer>
</body>
</html>
