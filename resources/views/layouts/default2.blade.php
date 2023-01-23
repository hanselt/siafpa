<!DOCTYPE html>
<html lang ="es">

<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Area Funcional de Patrimonio Arqueológico</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/cssmapa.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery.fancybox.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets-minified/frontend-all-demo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/icons/iconic/iconic.css') }}">

    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script  type="text/javascript" src="{{URL::asset('js/jquery.fancybox.min.js') }}"></script>
    <script  type="text/javascript" src="{{URL::asset('js/functions.js') }}"></script>
    <script  type="text/javascript" src="{{URL::asset('js/Conversor.js') }}"></script>

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- JS Core -->
    <script type="text/javascript" src="{{ URL::asset('assets-minified/js-core.js') }}"></script>
    
</head>

<body>
<div id="page-wrapper">

    @yield('nav')

    <div style="background-color:#F2F7F8">
    @yield('content')
    </div>

    <div class="main-footer bg-red font-inverse clearfix">
        <div class="container clearfix">
            <div class="col-xs-12 col-sm-5">
                <img class="img-responsive" src="{{ URL::asset('img/footer_logo2.png') }}" alt="Ministerio de Cultura" style="float:left; max-width: 400px; margin-top: 10px;background-color: blue" />
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="header">DIRECTOR</div>
                <p class="about-us">
                    Víctor Vidal Pino Zambrano.
                </p>
            </div>
            <div class="col-xs-12 col-sm-4">
                <h3 class="header">Sede Central:</h3>
                <ul class="footer-contact">
                    <li>
                        <i class="glyph-icon icon-home"></i>
                        Calle Maruri s/n, Cusco. Local Cusicancha
                    </li>
                    <li>
                        <i class="glyph-icon icon-phone"></i>
                        084-582030
                    </li>
                    <li>
                        <i class="glyph-icon icon-envelope-o"></i>
                        <a href="#" title="">direccionregional@drc-cusco.gob.pe/a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-pane">
            <div class="container clearfix">
                <div class="logo">&copy; 2017 Area Funcional de Patrimonio Arqueológico, Inc.</div>
            </div>
        </div>
    </div><!-- .main-footer -->
</div><!-- .page-wrapper -->


    

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
(function (b, o, i, l, e, r) {
b.GoogleAnalyticsObject = l;
b[l] || (b[l] =
    function () {
        (b[l].q = b[l].q || []).push(arguments)
    });
b[l].l = +new Date;
e = o.createElement(i);
r = o.getElementsByTagName(i)[0];
e.src = 'https://www.google-analytics.com/analytics.js';
r.parentNode.insertBefore(e, r)
}(window, document, 'script', 'ga'));
ga('create', 'UA-XXXXX-X', 'auto');
ga('send', 'pageview');
</script>
<script type="text/javascript">
    //$('#result').load('http://www.geopatrimoniocusco.pe/index.php #container');
    $("#htmlcatastro123").html('<object data="http://www.geopatrimoniocusco.pe/index.php" width="100%" height="900" frameborder="0" style="border:0" allowfullscreen>');
    
</script>
    <!-- JS Demo -->
    <script type="text/javascript" src="{{ URL::asset('assets-minified/frontend-all-demo.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{URL::asset('js/chosen.jquery.js') }}"></script> 
    @yield('scripts')
</body>
</html>