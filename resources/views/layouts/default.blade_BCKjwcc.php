<!DOCTYPE html>
<html lang ="es">

<head>
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Área Funcional de Patrimonio Arqueológico</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ URL::asset('assets/bootstrap/css/bootstrap.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/cssmapa.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/dropzone.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets-minified/frontend-all-demo.css') }}">

    <script  type="text/javascript" src="{{URL::asset('assets/jquery/jquery.min.js')}}"></script>
    <script  type="text/javascript" src="{{URL::asset('assets/fancybox/jquery.fancybox.min.js') }}"></script>
    
    <script  type="text/javascript" src="{{URL::asset('js/Conversor.js') }}"></script>
    <script  type="text/javascript" src="{{URL::asset('js/moment.js') }}"></script>
    <script  type="text/javascript" src="{{URL::asset('js/Control.js') }}"></script>
    <script src="{{URL::asset('js/dropzone.js') }}"></script>

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
    <div class="top-bar bg-topbar">
        <div class="container">
            <div class="float-left">
                @include('layouts.partials.login_menu')
            </div>
            <div class="float-right">
                <a href="#" class="btn btn-sm bg-facebook tooltip-button" data-placement="bottom" title="Siguenos en Facebook">
                    <i class="glyph-icon icon-facebook"></i>
                </a>
                <a href="#" class="btn btn-sm bg-twitter tooltip-button" data-placement="bottom" title="Siguenos en Twitter">
                    <i class="glyph-icon icon-twitter"></i>
                </a>
                <a href="#" class="btn btn-top btn-sm" title="Give us a call">
                    <i class="glyph-icon icon-phone"></i>
                    084-582030
                </a>
            </div>
        </div><!-- .container -->
    </div><!-- .top-bar -->
    

    {{-- @include('layouts/nav') --}}

    @yield('nav')

    <div style="background-color:#F2F7F8">
    @yield('content')
    </div>

    <div class="main-footer bg-red font-inverse clearfix" style="background-color: #e74c3c">
        <div class="container clearfix">
            <div class="col-xs-12 col-sm-5">
                <img class="img-responsive" src="{{ URL::asset('img/ddc-cusco.png') }}" alt="Ministerio de Cultura" style="float:left; max-width: 300px; margin-top: 10px " />
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
                        <a href="#" title="">direccionregional@drc-cusco.gob.pe</a>
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


    @yield('scripts')

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
    <script src="{{URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{URL::asset('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{URL::asset('js/jszip.min.js') }}"></script>
    <script src="{{URL::asset('js/pdfmake.min.js') }}"></script>
    <script src="{{URL::asset('js/vfs_fonts.js') }}"></script>
    <script src="{{URL::asset('js/buttons.html5.min.js') }}"></script>
    <script src="{{URL::asset('js/buttons.print.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>


    <script type="text/javascript" src="{{URL::asset('assets/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{URL::asset('js/datatable-bootstrap.js') }}"></script> 

    <script>
        $(document).ready(function(){
            $('#selectTable').DataTable();
            $('#MyTable').dataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'pageLength',
                    {   extend: "copy",
                        text:       'Copiar <i class="fa fa-files-o" aria-hidden="true"></i>',
                        titleAttr:  'Copiar registros',
                        messageTop: $('#tittle').text(),
                        exportOptions: {
                            format: {
                                body: function (data, row, column, node) { 
                                    var texts = new Array();
                                    $(data).filter('.toExport').each(function () {
                                        texts.push($(this).text());
                                    });
                                    return texts;
                                }
                            }
                        }
                    },
                    {   extend: "excel",
                        text:       'Excel <i class="fa fa-file-excel-o" aria-hidden="true"></i>',
                        titleAttr:  'Exportar Excel',
                        messageTop: $('#tittle').text(),
                        exportOptions: {
                            format: {
                                body: function (data, row, column, node) { 
                                    var texts = new Array();
                                    $(data).filter('.toExport').each(function () {
                                        texts.push($(this).text());
                                    });
                                    return texts;
                                }
                            }
                        }
                    },
                    {   extend: "pdf",
                        text:       'PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i>',
                        titleAttr:  'Exportar a PDF',
                        orientation: 'landscape',
                        title: $('#tittle').text(),
                        exportOptions: {
                            columns: ':visible',
                            format: {
                                body: function (data, row, column, node) { 
                                    var texts = new Array();
                                    $(data).filter('.toExport').each(function () {
                                        texts.push($(this).text());
                                    });
                                    return texts;
                                }
                            }
                        },
                        customize: function ( doc ) {
                        // Splice the image in after the header, but before the table
                        doc.content.splice( 0, 0, 
                            {
                            margin: [ 1, 1, 3, 1 ],
                            alignment: 'center',
                            image: 'data:image/png;base64,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'
                            } )
                        }
                    },
                    {   extend: "print",
                        text:       'Imprimir <i class="fa fa-print" aria-hidden="true"></i>',
                        titleAttr:  'Imprimir',
                        messageTop: $('#tittle').text(),
                        exportOptions: {
                            columns: ':visible',
                            format: {
                                body: function (data, row, column, node) { 
                                    var texts = new Array();
                                    $(data).filter('.toExport').each(function () {
                                        texts.push($(this).text());
                                    });
                                    return texts;
                                }
                            }
                        }
                    },
                    
                ],

                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            } );
        });
        

</script>
</body>
</html>