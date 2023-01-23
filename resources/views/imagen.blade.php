
'<div id="modalw" style="max-height: 100%;max-width: 100%">'+
  '<div id="top-bar">'+
  	'<img src="img/modal-top.jpg" width="900" height="14">'+
  '</div>'+
  '<div id="titulo">'+
    '<img src="img/titulo-ma.png" width="460" height="27">'+
  '</div>'+
  '<div id="divisor"></div>'+
  '<div id="info">'+
  '<div id="info-textos">'+
      '<div id="nombre"><br>'++element.MONU_varNombre+'</div>'+
      '<div id="categoria">'++element.MONU_varCategoria+'</div>'+
      '<div id="ubicacion">ANTA - ANTA - CUSCO</div>'+
  '</div>'+
  '<div id="ubi-map"></div>'+
  '</div>'+
    '<div id="docs-gal">'+
      
      '<div id="gal"><br>'+
        '<div class="slider-wrapper">'+
              '<div id="slider" class="lean-slider">'+
                  '<div class="slide1 lean-slider-slide current">'+
                  	'<img src="data/media/no-image.jpg" alt="">'+
                  '</div>'+
              '</div>'+
              '<div id="slider-direction-nav"><a href="#" class="lean-slider-prev">Prev</a><a href="#" class="lean-slider-next">'+
                'Next</a></div>'+
              '<div id="slider-control-nav"><a href="#" class="lean-slider-control-nav active">1</a></div>'+
        '</div>'+
      '</div>'+
    '</div>'+
'</div>';




                                '<div id="{{$actividad->ATRI_intId}}" class="carousel slide" data-ride="carousel">'+
                                  '<ol class="carousel-indicators">'+
                                    '<li data-target="#{{$actividad->ATRI_intId}}" data-slide-to="0" class="active"></li>'+
                                    '<li data-target="#{{$actividad->ATRI_intId}}" data-slide-to="1"></li>'+
                                    '<li data-target="#{{$actividad->ATRI_intId}}" data-slide-to="2"></li>'+
                                  '</ol>'+
                                  '<div class="carousel-inner">'+
                                    '<div class="item active">'+
                                      '<img src="{{$actividad->ATRI_varImagenAntes}}" alt="Antes" style="width:100%; height: 230px">'+
                                      '<p><center>Antes</center></p>'+
                                    '</div>'+
                                    '<div class="item">'+
                                      '<img src="{{$actividad->ATRI_varImagenDurante}}" alt="Durante" style="width:100%; height: 230px" ><p><center>Durante</center></p>'+
                                    '</div>'+
                                    '<div class="item">'+
                                      '<img src="{{$actividad->ATRI_varImagenDespues}}" alt="Después" style="width:100%; height: 230px" ><p><center>Despues</center></p>'+
                                    '</div>'+
                                  '</div>'+
                                  '<a class="left carousel-control" href="#{{$actividad->ATRI_intId}}" data-slide="prev">'+
                                    '<span class="glyphicon glyphicon-chevron-left"></span>'+
                                    '<span class="sr-only">Previous</span>'+
                                  '</a>'+
                                  '<a class="right carousel-control" href="#{{$actividad->ATRI_intId}}" data-slide="next">'+
                                    '<span class="glyphicon glyphicon-chevron-right"></span>'+
                                    '<span class="sr-only">Next</span>'+
                                  '</a>'+
                                '</div>'+
                                '<div class="caption">'+
                                    '<h4 style="text-align: justify;">{{$actividad->ACCI_varDescripcion}}</h4>'+
                                    '<p>{{$actividad->ATRI_intTrimestre}}º Trimestre<br>Planes:{{$actividad->ATRI_varPlanes}}<br>Ejecución Presupuestal:{{$actividad->ATRI_intEjecucionPresupuestal}}%</p><p style="text-align: right;"><a href="{{$actividad->ATRI_varDirDocumento}}">Descargar Documento</a></p>'+
                                '</div>'+
