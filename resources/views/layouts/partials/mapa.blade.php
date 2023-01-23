
<div class="google-maps" id="map"  width="600" height="900" frameborder="0" style="border:0" allowfullscreen>

</div>
@section('scripts')
<script type="text/javascript">
      /*$(".js-example-basic-single").select2();
      $(".js-example-placeholder-single").select2({
          placeholder: "Seleccione un monumento",
          allowClear: true
        });*/
      
</script>
<script type="text/javascript">
      
      $(document).ready( function () {
          $.get('/monames',function (data){
                    data.forEach(function(element,index){
                        $('#selectNombre').append(
                                '<option> '+element.MONU_varNombre+'</option>');
                    });
                    $('#selectNombre').trigger("chosen:updated");
          });  
         
          $('#selectNombre').
          ({
            placeholder_text_single: "Seleccione un monumento",
            no_results_text: "No se encontro el monumento"
          });
      });
      //$(".chosen").chosen({rtl: true});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1oPtrb4pgftlYN0JcpJ1IpoG8Sx4gMpI&callback=initMap"></script>
<script type="text/javascript" src="{{ URL::asset('js/markerwithlabel.js') }}"></script>
@endsection
<script>
    var MakersCGM=[];
    var MakersCIA=[];
    var MakersCIRA=[];
    var MakersPMA=[];
    var MakersCOORDINACIONES=[];
    var LayersCATASTRO=[];
    var LayersCapaDistritos=[];
    var LayersNombresDistritos=[];
    var LayersCapaProvincias=[];
    var LayersNombresProvincias=[];
    var LayersZonas=[];
    var LayersNombresZ18=[];
    var LayersNombresZ19=[];
    var LayersCarta=[];
    var LayersNombresCarta=[];
    var map;
    var MakersPEA=[];
    var MakersPIA=[];
    var MakersPRIA=[];
    var currWindow =false; 

    function openFancybox($route,$id) {
      
      var src='http://'+document.domain+$route;
      var src2="http://www.youtube.com";//"http://localhost:8000/monumento/vistaindividual/13"
      alert(src2);
      $.fancybox.open({
        href: src,
        type: 'iframe',
        padding: 0
      });  
      //
    }
    function setMarkersCOOR(map) {
      var image = {
          url: '/img/coordinaciones.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(27, 41),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 41)
        };
        var CGM=[];
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        $.get('/coor',function (data){
                    data.forEach(function(element,index){

                        var marker = new google.maps.Marker({
                  position: {lat: element.COOR_varCoordenadaLatitud, lng: element.COOR_varCoordenadaLongitud},
                  map: map,
                  icon: image,
                  shape: shape,
                  title: element.COOR_varNombre,
                  zIndex: element.COOR_intId
                  });
                    var contentString = '';
                    /*contentString=contentString+'<a data-fancybox data-type="ajax" data-src="http://localhost:8000/monumento/vistaindividual/'+element.MONU_intId+'" href="javascript:;">'+
                    '</a>';*/

                    
                  contentString=''+
                  '<div style="width:250px; color:#424242">'+
                       '<div id="info-textos"><strong><center>COORDINACION</center>'+
                        '<div id="nombre"><center>'+element.COOR_varNombre+'</center></strong></div><hr color="#e74d3d" size=3>'+
                        '<div id="atencion"><center>Atención: '+element.COOR_varHorarioAtencion+'</center></div>'+
                        '<div id="ubicacion"><center>Local de Atención: '+element.COOR_varDireccion+'</center></div>'+
                        '<div id="contacto"><center>'+element.COOR_varResenaHistorica+'</center></div>'+
                       '</div>'+
                  '</div>';
                  /*contentString=contentString+'<div>';
                  contentString=contentString+'<div class="col-md-6">';
                  if(element.IMAG_varDirImagen!=null)
                    contentString=contentString+'<img class="img-fluid" src="'+element.IMAG_varDirImagen+'" alt="" width="100%" height="100%" style="max-width: 240px">';
                  else
                    contentString=contentString+'<img class="img-fluid" src="/img/monumentonulo.png" alt="" width="100%">';
                  
                  contentString=contentString+'</div>'+
                    '<div class="col-md-6">'+
                      '<h5>'+element.MONU_varCategoria+'</h5><h3 class="my-3">'+element.MONU_varNombre+'</h3>'+
                      '<h5 class="my-3">Descripción</h5>'+
                      '<p align=justify>'+element.MONU_varDescripcion+'</p>'+
                      '<a href="monumento/vistaindividual/'+element.MONU_intId+'" target="_blank" alt="Edit" title="Ver mas" ><i class="fa fa-external-link-square pull-right" aria-hidden="true" style="color: #433d3a"></i></a>'
                    '</div>'+
                  '</div>';*/
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                CGM.push(marker);
                
                marker.addListener('click', function() {
                  /*var src='/monumento/vistaindividual/13';
                  $.fancybox.open({
                    src: src,
                    type: 'iframe',
                    padding: 0
                  });*/

                  infowindow.open(map, marker);
                  
                  if( currWindow ) {
                    currWindow.close();
                  } 

                  currWindow = infowindow;
                  infowindow.open(map, marker);
                  //window.location.href = '/monumento/vistaindividual/13';

                  
                  //openFancybox('/monumento/vistaindividual/13','a');
                  //
                });
                marker.addListener('cursor_changed', function() {
                  infowindow.close(map, marker);
                });
              
              });

            });
        
        return CGM;
        
        };
    function setMarkersCGM(map) {
      var image = {
          url: '/img/monumentos.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(27, 41),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 41)
        };
        var CGM=[];
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        $.get('/mon',function (data){
                    data.forEach(function(element,index){

                        var marker = new google.maps.Marker({
                  position: {lat: element.MONU_douCoordenadaLatitud, lng: element.MONU_douCoordenadaLongitud},
                  map: map,
                  icon: image,
                  shape: shape,
                  title: element.MONU_varCategoria+' '+element.MONU_varNombre,
                  zIndex: element.MONU_intId
                  });
                    var contentString = '';
                    var contentString2 = '';
                    /*style="width:250px" contentString=contentString+'<a data-fancybox data-type="ajax" data-src="http://localhost:8000/monumento/vistaindividual/'+element.MONU_intId+'" href="javascript:;">'+
                    '</a>';*/
                    
                  contentString=''+
                  '<div id="iw-container" style="width:299px">'+
                        '<div id="categoria" class="iw-title">'+element.MONU_varNombre+'</div>'+
                        '<div id="nombre"><br>'+element.MONU_varCategoria+'</div>'+
                        '<br>';
                    

                    if(element.ACCI_varDescripcion!=null)
                    {
                    contentString=contentString+'<div><div id="'+element.MONU_intId+'" class="carousel slide" data-ride="carousel">'+
                                  '<ol class="carousel-indicators">'+
                                    '<li data-target="#'+element.MONU_intId+'" data-slide-to="0" class="active"></li>'+
                                    '<li data-target="#'+element.MONU_intId+'" data-slide-to="1"></li>'+
                                    '<li data-target="#'+element.MONU_intId+'" data-slide-to="2"></li>'+
                                  '</ol>'+
                                  '<div class="carousel-inner">'+
                                    '<div class="item active">'+
                                      '<center><img src="'+element.ATRI_varImagenAntes+'" alt="Antes" style="width:100%; height: 180px;max-height:100%;max-width:100%"></center>'+
                                      '<p><center>Antes</center></p>'+
                                    '</div>'+
                                    '<div class="item">'+
                                      '<center><img src="'+element.ATRI_varImagenDurante+'" alt="Durante" style="width:100%; height: 180px;max-height:100%;max-width:100%"></center><p><center>Durante</center></p>'+
                                    '</div>'+
                                    '<div class="item">'+
                                      '<center><img src="'+element.ATRI_varImagenDespues+'" alt="Después" style="width:100%; height: 180px;max-height:100%;max-width:100%"></center><p><center>Despues</center></p>'+
                                    '</div>'+
                                  '</div>'+
                                  '<a class="left carousel-control" href="#'+element.MONU_intId+'" data-slide="prev">'+
                                    '<span class="glyphicon glyphicon-chevron-left"></span>'+
                                    '<span class="sr-only">Previous</span>'+
                                  '</a>'+
                                  '<a class="right carousel-control" href="#'+element.MONU_intId+'" data-slide="next">'+
                                    '<span class="glyphicon glyphicon-chevron-right"></span>'+
                                    '<span class="sr-only">Next</span>'+
                                  '</a>'+
                                '</div>'+
                                '<div class="caption">'+
                                    '<p style="text-align: justify;color:#ea4100;font-weight: bold">'+element.ACCI_varDescripcion+'</p>'+
                                    '<p>'+element.ATRI_intTrimestre+'º Trimestre</p><p style="text-align: right;"><a href="monumento/vistaindividual/'+element.MONU_intId+'" target="_blank" alt="Edit" title="Ver mas">Ver más</a></p>'+
                      '</div>'+
                  '</div></div>';
                  }
                  else
                  {
                    contentString=contentString+'<p style="text-align: right;"><a href="monumento/vistaindividual/'+element.MONU_intId+'" target="_blank" alt="Edit" title="Ver mas">Ver más</a></p></div>';
                  }
                  

                  var infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    maxWidth: 350
                });
                
                CGM.push(marker);
                marker.addListener('click', function() {
                  //infowindow.open(map, marker);
                  //
                  if( currWindow ) {
                    currWindow.close();
                  } 

                  currWindow = infowindow;
                  infowindow.open(map, marker);
                  //
                });
                marker.addListener('cursor_changed', function() {
                  infowindow.close(map, marker);
                });
                            
              });

            });
        
        return CGM;
        
        };
        //cira
        function setMarkersCIRA(map) {
        var image = {
            url: '/img/ciras.png',
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(27, 41),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(0, 41)
          };
        var CIA=[];
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        var X=0;
        $.get('/cira',function (data){
                    data.forEach(function(element,index){
                        
                        var marker = new google.maps.Marker({
                  position: {lat: element.CIRA_douCoordenadaX, lng: element.CIRA_douCoordenadaY},
                  map: map,
                  icon: image,
                  shape: shape,
                  title: element.CIRA_varNombreProyecto,
                  zIndex: X
                  });

                    var contentString = '';
                  
                  X++;
                  contentString=''+
                  '<div id="iw-container" style="width:299px">'+
                       '<div id="info-textos"><div class="iw-title">Certificador de Inexistencia de Restos Arqueológicos</div>'+
                        '<div id="nombre">'+element.CIRA_varNombreProyecto+'</div>'+
                        '<div id="ubicacion"><p style="color:#C0A13D"><strong>Administrador o Empresa: </strong></p>'+element.CIRA_varAdministradorEmpresa+'<p style="text-align: right;"><a data-fancybox data-type="iframe" data-src="/ecira/'+element.CIRA_varHojaTramite+'" href="javascript:;">Ver más</a></p></div>'+
                       '</div>'+
                  '</div>';
                  var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                CIA.push(marker);
                
                marker.addListener('click', function() {
                  //infowindow.open(map, marker);
                  //
                  if( currWindow ) {
                    currWindow.close();
                  } 

                  currWindow = infowindow;
                  infowindow.open(map, marker);
                  //
                });
                marker.addListener('cursor_changed', function() {
                  infowindow.close(map, marker);
                });
            });

          });
          return CIA;
        
        };
        //cirafin
        //pmas
      function setMarkersPMA(map) {
        var image = {
            url: '/img/pmas.png',
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(27, 41),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(0, 41)
          };
        var CIA=[];
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        var X=0;
        $.get('/pma',function (data){
                    data.forEach(function(element,index){
                        
                        var marker = new google.maps.Marker({
                  position: {lat: element.PMA_douCoordenadaX, lng: element.PMA_douCoordenadaY},
                  map: map,
                  icon: image,
                  shape: shape,
                  title: element.PMA_varNombreProyecto,
                  zIndex: X
                  });

                    var contentString = '';
                  
                  X++;
                  contentString=''+
                  '<div id="iw-container" style="width:299px">'+
                       '<div id="info-textos"><div class="iw-title">Plan de Monitoreo Arqueológico</div>'+
                        '<div id="nombre">'+element.PMA_varNombreProyecto+'</div>'+
                        '<div id="ubicacion"><p style="color:#3D8CC0"><strong>Solicitante: </strong></p>'+element.PMA_varNombreAdminEmpresaSolicitante+'<p style="text-align: right;"><a data-fancybox data-type="iframe" data-src="/epma/'+element.PMA_varHojaTramite+'" href="javascript:;">Ver más</a></p></div>'+
                       '</div>'+
                  '</div>';
                  var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                CIA.push(marker);
                
                marker.addListener('click', function() {
                  //infowindow.open(map, marker);
                  //
                  if( currWindow ) {
                    currWindow.close();
                  } 

                  currWindow = infowindow;
                  infowindow.open(map, marker);
                  //
                });
                marker.addListener('cursor_changed', function() {
                  infowindow.close(map, marker);
                });
            });

          });
          return CIA;
        
        };
      //set PRIA
      function setMarkersPRIA(map) {
       var image = {
          url: '/img/pria.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(27, 41),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 41)
        };
        var CIA=[];
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        var X=0;
        $.get('/pria',function (data){
                    data.forEach(function(element,index){
                        
                  var marker = new google.maps.Marker({
                  position: {lat: element.PROY_douCoordenadaLatitud, lng: element.PROY_douCoordenadaLongitud},
                  map: map,
                  icon: image,
                  shape: shape,
                  title: element.PROY_varNombre,
                  zIndex: X
                  });
                    var contentString = '';
                  contentString=''+
                  '<div id="iw-container" style="width:299px">'+element.PROY_varTipo+
                       '<div id="info-textos">'+
                        '<div id="nombre" class="iw-title">'+element.PROY_varNombre+'</div>'+
                        '<div id="ubicacion"><p style="color:#09511D"><strong>Descripción: </strong></p>'+element.PROY_varResumenProyecto+'<p style="text-align: right;"><a data-fancybox data-type="iframe" data-src="/ecia/'+element.PROY_varHojaTramite+'" href="javascript:;">Ver más</a></p</div>'+
                       '</div>'+
                  '</div>';
                  X++;
                  var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                CIA.push(marker);
                marker.addListener('click', function() {
                  //infowindow.open(map, marker);
                  //
                  if( currWindow ) {
                    currWindow.close();
                  } 

                  currWindow = infowindow;
                  infowindow.open(map, marker);
                  //
                });
                marker.addListener('cursor_changed', function() {
                  infowindow.close(map, marker);
                });
              });

          });
        return CIA;
        
        };
      //set PEA
      function setMarkersPEA(map) {
       var image = {
          url: '/img/pea.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(27, 41),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 41)
        };
        var CIA=[];
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        var X=0;
        $.get('/pea',function (data){
                    data.forEach(function(element,index){
                        
                  var marker = new google.maps.Marker({
                  position: {lat: element.PROY_douCoordenadaLatitud, lng: element.PROY_douCoordenadaLongitud},
                  map: map,
                  icon: image,
                  shape: shape,
                  title: element.PROY_varNombre,
                  zIndex: X
                  });
                    var contentString = '';
                  contentString=''+
                  '<div id="iw-container" style="width:299px">'+element.PROY_varTipo+
                       '<div id="info-textos">'+
                        '<div id="nombre" class="iw-title">'+element.PROY_varNombre+'</div>'+
                        '<div id="ubicacion"><p style="color:#09511D"><strong>Descripción: </strong></p>'+element.PROY_varResumenProyecto+'<p style="text-align: right;"><a data-fancybox data-type="iframe" data-src="/ecia/'+element.PROY_varHojaTramite+'" href="javascript:;">Ver más</a></p</div>'+
                       '</div>'+
                  '</div>';
                  X++;
                  var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                CIA.push(marker);
                marker.addListener('click', function() {
                  //infowindow.open(map, marker);
                  //
                  if( currWindow ) {
                    currWindow.close();
                  } 

                  currWindow = infowindow;
                  infowindow.open(map, marker);
                  //
                });
                marker.addListener('cursor_changed', function() {
                  infowindow.close(map, marker);
                });
              });

          });
        return CIA;
        
        };
      //set PIA
      function setMarkersPIA(map) {
       var image = {
          url: '/img/pia.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(27, 41),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 41)
        };
        var CIA=[];
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        var X=0;
        $.get('/pia',function (data){
                    data.forEach(function(element,index){
                        
                  var marker = new google.maps.Marker({
                  position: {lat: element.PROY_douCoordenadaLatitud, lng: element.PROY_douCoordenadaLongitud},
                  map: map,
                  icon: image,
                  shape: shape,
                  title: element.PROY_varNombre,
                  zIndex: X
                  });
                    var contentString = '';
                  contentString=''+
                  '<div id="iw-container" style="width:299px">'+element.PROY_varTipo+
                       '<div id="info-textos">'+
                        '<div id="nombre" class="iw-title">'+element.PROY_varNombre+'</div>'+
                        '<div id="ubicacion"><p style="color:#09511D"><strong>Descripción: </strong></p>'+element.PROY_varResumenProyecto+'<p style="text-align: right;"><a data-fancybox data-type="iframe" data-src="/ecia/'+element.PROY_varHojaTramite+'" href="javascript:;">Ver más</a></p</div>'+
                       '</div>'+
                  '</div>';
                  X++;
                  var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                CIA.push(marker);
                marker.addListener('click', function() {
                  //infowindow.open(map, marker);
                  //
                  if( currWindow ) {
                    currWindow.close();
                  } 

                  currWindow = infowindow;
                  infowindow.open(map, marker);
                  //
                });
                marker.addListener('cursor_changed', function() {
                  infowindow.close(map, marker);
                });
              });

          });
        return CIA;
        
        };
        //set Another Marks
       function setMarkersCIA(map) {
       var image = {
          url: '/img/cias.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(27, 41),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 41)
        };
        var CIA=[];
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        var X=0;
        $.get('/cia',function (data){
                    data.forEach(function(element,index){
                        
                        var marker = new google.maps.Marker({
                  position: {lat: element.PROY_douCoordenadaLatitud, lng: element.PROY_douCoordenadaLongitud},
                  map: map,
                  icon: image,
                  shape: shape,
                  title: element.PROY_varNombre,
                  zIndex: X
                  });
                    var contentString = '';
                  contentString=''+
                  '<div id="iw-container" style="width:299px">'+element.PROY_varTipo+
                       '<div id="info-textos">'+
                        '<div id="nombre" class="iw-title">'+element.PROY_varNombre+'</div>'+
                        '<div id="ubicacion"><p style="color:#09511D"><strong>Descripción: </strong></p>'+element.PROY_varResumenProyecto+'<p style="text-align: right;"><a data-fancybox data-type="iframe" data-src="/ecia/'+element.PROY_varHojaTramite+'" href="javascript:;">Ver más</a></p></div>'+
                       '</div>'+
                  '</div>';
                  X++;
                  var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                CIA.push(marker);
                marker.addListener('click', function() {
                  //infowindow.open(map, marker);
                  //
                  if( currWindow ) {
                    currWindow.close();
                  } 

                  currWindow = infowindow;
                  infowindow.open(map, marker);
                  //
                });
                marker.addListener('cursor_changed', function() {
                  infowindow.close(map, marker);
                });
              });

          });
        return CIA;
        
        };
      //
      function loadKmlLayer(map) {
        var Ct=[];
        var src='http://ddcc.gemastic.com/archivos/catastro/kml/doc.kml';
        var kmlLayer = new google.maps.KmlLayer(src, {
          map: map,
          preserveViewport: true
        });
        Ct.push(kmlLayer);
        return Ct;
      }
      //load nombres zonas
      function loadNombreZ18(map)
      {
        var Ndt=[];        
        var layer = new google.maps.FusionTablesLayer({
          query: {
            select: 'geometry',
            from: '1gQxXlkTOTMPEdeL9hIT5nNzVHhgPnFdjyzxdkENP'
          }
        });
        
        layer.setMap(map);
        Ndt.push(layer);
        return Ndt;
      }
      function loadNombreZ19(map)
      {
        var Ndt=[];
        var layer = new google.maps.FusionTablesLayer({
          query: {
            select: 'geometry',
            from: '1GkJk1RWFvDoBKnxnV82DqyBE8rpmgfwV9i1AGKrr'
          },
          styles: [{          
          markerOptions: {
            iconName: "small_green"
          }
        }]

        });
        
        layer.setMap(map);
        Ndt.push(layer);
        return Ndt;
      }
      //load nombres cartas
      function loadNombreCartas(map)
      {
        var Ndt=[];
        var image = {
          url: '/img/transparente.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(27, 41),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 41)
        };
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        var X=0;
        
        var loc_distrito="./archivos/catastro/CartasNac.xml";
        $.get(loc_distrito, function(data) {
            $.each($(data).find("Placemark:has(styleUrl:contains('#FEATURES_LABELS20'))"), function() {
              var c = $(this).find("Point coordinates").text().split(",");
              var l = new google.maps.LatLng(c[1], c[0]);
              var t = $(this).find("name").text();
              var marker2 = new MarkerWithLabel({
                position: l,
                draggable: false,
                raiseOnDrag: true,
                icon: image,
                map: map,
                labelContent: t,
                labelAnchor: new google.maps.Point(22, 0),
                labelClass: "labelsCartas", // the CSS class for the label 
                labelStyle: {opacity: 0.95}
              });
              /*var marker = new google.maps.Marker({
                  position: l,
                  map: map,
                  icon: image,
                  shape: shape,
                  label: {text:t,color:'white',fontFamily:"Comic Sans MS",fontSize:'10px',fontWeight:'bold'},
                  title: t,
                  zIndex: X
                  });*/
              X++;
              Ndt.push(marker2);
            });
        });
        //Dt.push(kmlLayer2);
        return Ndt;
      }
      //load provincias
      function loadNombreProvincias(map)
      {
        var Ndt=[];
        var image = {
          url: '/img/transparente.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(27, 41),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 41)
        };
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        var X=0;
        
        var loc_distrito="./archivos/catastro/Provincia.xml";
        $.get(loc_distrito, function(data) {
            $.each($(data).find("Placemark:has(styleUrl:contains('#FEATURES_LABELS'))"), function() {
              var c = $(this).find("Point coordinates").text().split(",");
              var l = new google.maps.LatLng(c[1], c[0]);
              var t = $(this).find("name").text();
              var marker2 = new MarkerWithLabel({
                position: l,
                draggable: false,
                raiseOnDrag: true,
                icon: image,
                map: map,
                labelContent: t,
                labelAnchor: new google.maps.Point(22, 0),
                labelClass: "labelsProv", // the CSS class for the label 
                labelStyle: {opacity: 0.95}
              });
              /*var marker = new google.maps.Marker({
                  position: l,
                  map: map,
                  icon: image,
                  shape: shape,
                  label: {text:t,color:'white',fontFamily:"Comic Sans MS",fontSize:'10px',fontWeight:'bold'},
                  title: t,
                  zIndex: X
                  });*/
              X++;
              Ndt.push(marker2);
            });
        });
        //Dt.push(kmlLayer2);
        return Ndt;
      }
      function loadNombreDistritos(map)
      {
        var Ndt=[];
        var image = {
          url: '/img/transparente.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(27, 41),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 41)
        };
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        var X=0;
        
        var loc_distrito="./archivos/catastro/Distrito.xml";
        $.get(loc_distrito, function(data) {
            $.each($(data).find("Placemark:has(styleUrl:contains('#FEATURES_LABELS'))"), function() {
              var c = $(this).find("Point coordinates").text().split(",");
              var l = new google.maps.LatLng(c[1], c[0]);
              var t = $(this).find("name").text();
              var marker2 = new MarkerWithLabel({
                position: l,
                draggable: false,
                raiseOnDrag: true,
                icon: image,
                map: map,
                labelContent: t,
                labelAnchor: new google.maps.Point(22, 0),
                labelClass: "labelsDist", // the CSS class for the label 
                labelStyle: {opacity: 0.95}
              });
              /*var marker = new google.maps.Marker({
                  position: l,
                  map: map,
                  icon: image,
                  shape: shape,
                  label: {text:t,color:'white',fontFamily:"Comic Sans MS",fontSize:'10px',fontWeight:'bold'},
                  title: t,
                  zIndex: X
                  });*/
              X++;
              Ndt.push(marker2);
            });
        });
        //Dt.push(kmlLayer2);
        return Ndt;
      }
      //kml provincias
      function loadKmlProvincias(map) {
        var Dt=[];
        
        var src='http://'+document.domain+'/archivos/catastro/limite-provincial.kml';
        //var src='http://geopatrimoniocusco.pe/geodata/kml/limitedistrital.kml';
        var kmlLayer = new google.maps.KmlLayer(src, {
          map: map,
          suppressInfoWindows: true,
          preserveViewport: true,
          clickable: false
        });
        Dt.push(kmlLayer);
        
        return Dt;
      }
      //kml de Distritos
      function loadKmlDistritos(map) {
        var Dt=[];
        
        var src='http://'+document.domain+'/archivos/catastro/limitedistrital.kml';
        //var src='http://geopatrimoniocusco.pe/geodata/kml/limitedistrital.kml';
        var kmlLayer = new google.maps.KmlLayer(src, {
          map: map,
          suppressInfoWindows: true,
          preserveViewport: true,
          clickable: false
        });
        Dt.push(kmlLayer);
        
        return Dt;
      }
      function loadKmlZonas(map){
        var Zt=[];
        var src='http://'+document.domain+'/archivos/catastro/Z18.kml';
        var kmlLayer = new google.maps.KmlLayer(src, {
          map: map,
          suppressInfoWindows: true,
          preserveViewport: true
        });
        Zt.push(kmlLayer);
        var src2='http://'+document.domain+'/archivos/catastro/Z19.kml';
        var kmlLayer2 = new google.maps.KmlLayer(src2, {
          map: map,
          suppressInfoWindows: true,
          preserveViewport: true
        });
        Zt.push(kmlLayer2);
        return Zt;
      }
      function loadKmlCartas(map){
        var Zc=[];
        var src='http://'+document.domain+'/archivos/catastro/CartasNac_Cusco.kmz';
        var kmlLayer = new google.maps.KmlLayer(src, {
          map: map,
          suppressInfoWindows: true,
          preserveViewport: true
        });
        Zc.push(kmlLayer);
        return Zc;              
      }

      function initMap() {
        // Styles a map in night mode.
        //map.setCenter(new google.maps.LatLng(37.4419, -122.1419));-72.036861,-14.795388
        
        var Cl=document.getElementById('BuscarMapa');
        var tabCGM=document.getElementById('PanelCGM');
        var tabCIRA=document.getElementById('PanelCIRA');
        var tabCIA=document.getElementById('PanelCIA');
        var tabCATASTRO=document.getElementById('PanelCATASTRO');
        var checkDistritos=document.getElementById('cbDistritos');
        var checkProvincias=document.getElementById('cbProvincias');
        //var checkZonas=document.getElementById('cbZonas');
        var checkCarta=document.getElementById('cbCartas');
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -14.00088, lng: -72.096861},
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.HYBRID,
          styles: [
            {
                "featureType": "landscape.man_made",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
            },
            {
                "elementType": "labels",
                "stylers": [
                  {
                    "visibility": "off"
                  }
                ]
            },
            {
              "featureType": "poi.attraction",
              "stylers": [
                {
                  "visibility": "off"
                }
              ]
            },
            {
              "featureType": "poi",
              "stylers": [
                {
                  "visibility": "off"
                }
              ]
            },
            {
              "featureType": "road",
              "elementType": "labels.icon",
              "stylers": [
                {
                  "visibility": "off"
                }
              ]
            },
            {
              "featureType": "transit",
              "stylers": [
                {
                  "visibility": "off"
                }
              ]
            }
        ]
        });
        MakersCGM= setMarkersCGM(map);
        MakersCOORDINACIONES=setMarkersCOOR(map);
        
        //document.getElementById('parrafoError').innerHTML=MakersCGM[0];//JSON.stringify(MakersCGM);
        
        
        
        
        
        
        LayersCATASTRO=loadKmlLayer(map);
        //check de cartas
        var PrimeraCarta=true;
        google.maps.event.addDomListener(checkCarta, 'click', function() {
            
              if(checkCarta.checked==true) {
                if(PrimeraCarta)
                {LayersNombresCarta=loadNombreCartas(map);PrimeraCarta=false;LayersCarta=loadKmlCartas(map);}
                showMarkerCarta();
                showMarker(LayersNombresCarta);
              } else {
                clearMarkerCarta();
                clearMarker(LayersNombresCarta);                             
              }            
          }); 
        //checkd e catastro
        var PrimeraProvincias=true;
        google.maps.event.addDomListener(checkProvincias, 'click', function() {
              if(checkProvincias.checked==true) {

                if(PrimeraProvincias)
                  {LayersNombresProvincias=loadNombreProvincias(map);PrimeraProvincias=false;LayersCapaProvincias=loadKmlProvincias(map);}
                  showMarker(LayersCapaProvincias);
                  var X=map.getZoom();
                  if(X>10)
                  {
                  showMarker(LayersNombresProvincias);}
              } else {
                clearMarker(LayersCapaProvincias);
                clearMarker(LayersNombresProvincias);
              }            
          }); 
        var PrimeraDistritos=true;
        google.maps.event.addDomListener(checkDistritos, 'click', function() {
              if(checkDistritos.checked==true) {

                if(PrimeraDistritos)
                {LayersNombresDistritos=loadNombreDistritos(map);PrimeraDistritos=false;LayersCapaDistritos=loadKmlDistritos(map);}

                showMarkersDistritos();
                var X=map.getZoom();
                
                if(X>10)
                {
                showMarkersNombreDistritos();}
              } else {
                clearMarkersDistritos(); 
                clearMarkersNombreDistritos();
              }            
          }); 
        //check de zonas
        /*var PrimeraZonas=true;
        google.maps.event.addDomListener(checkZonas, 'click', function() {
            
              if(checkZonas.checked==true) {
                if (PrimeraZonas) {
                  LayersNombresZ18=loadNombreZ18(map);PrimeraZonas=false;LayersNombresZ19=loadNombreZ19(map);LayersZonas=loadKmlZonas(map);}
                showMarker(LayersNombresZ18);
                showMarker(LayersNombresZ19);
                showMarkerZonas();
              } else {
                clearMarkerZonas();
                clearMarker(LayersNombresZ18);
                clearMarker(LayersNombresZ19);
              }            
          });*/
        var checkCOOR=document.getElementById('cbCOORDINACIONES'); 
        var checkMONU=document.getElementById('cbMONUMENTOS');
        google.maps.event.addDomListener(checkCOOR, 'click', function() {
            
              if(checkCOOR.checked==true) {
                showMarkersCOOR();
              } else {
                clearMarkersCOOR();
              }            
          }); 
        google.maps.event.addDomListener(checkMONU, 'click', function() {
            
              if(checkMONU.checked==true) {
                showMarkersCGM();
              } else {
                clearMarkersCGM();                             
              }            
          });
        var checkCIRA=document.getElementById('cbCIRAS'); 
        var checkPMA=document.getElementById('cbPMAS');
        google.maps.event.addDomListener(checkCIRA, 'click', function() {
            
              if(checkCIRA.checked==true) {
                showMarker(MakersCIRA);
              } else {
                clearMarker(MakersCIRA);
              }            
          }); 
        google.maps.event.addDomListener(checkPMA, 'click', function() {
            
              if(checkPMA.checked==true) {
                showMarker(MakersPMA);
              } else {
                clearMarker(MakersPMA);                             
              }            
          });
        //checks CIA
        var checkCIA=document.getElementById('cbOTRO');
        google.maps.event.addDomListener(checkCIA, 'click', function() {
            
              if(checkCIA.checked==true) {
                showMarkersCIA();
              } else {
                clearMarkersCIA();
              }            
          }); 
        var checkPIA=document.getElementById('cbPIA');
        google.maps.event.addDomListener(checkPIA, 'click', function() {
            
              if(checkPIA.checked==true) {
                showMarker(MakersPIA);
              } else {
                clearMarker(MakersPIA);
              }            
          }); 
        var checkPEA=document.getElementById('cbPEA');
        google.maps.event.addDomListener(checkPEA, 'click', function() {
            
              if(checkPEA.checked==true) {
                showMarker(MakersPEA);
              } else {
                clearMarker(MakersPEA);
              }            
          }); 
        var checkPRIA=document.getElementById('cbPRIA');
        google.maps.event.addDomListener(checkPRIA, 'click', function() {
            
              if(checkPRIA.checked==true) {
                showMarker(MakersPRIA);
              } else {
                clearMarker(MakersPRIA);
              }            
          }); 
          //finchecksCIA  
               
        google.maps.event.addDomListener(tabCGM, 'click', function() {
          showMarkersCGM();
          showMarkersCOOR();
          clearMarker(MakersPMA);
          clearMarker(MakersCIRA);
          clearMarker(MakersPIA);
          clearMarker(MakersPRIA);
          clearMarker(MakersPEA);
          clearMarkersCIA();
          clearMarkersCATASTRO();
          
        });
        google.maps.event.addDomListener(Cl, 'click', function() {
          var Nombre=$('#selectNombre').val();
          
          $.get('/showmon?nombremonumento='+Nombre,function (data){
            if(data.MONU_varNombre!=null){
            map.setCenter(new google.maps.LatLng(data.MONU_douCoordenadaLatitud, data.MONU_douCoordenadaLongitud));
            findMarkerCGM(new google.maps.LatLng(data.MONU_douCoordenadaLatitud, data.MONU_douCoordenadaLongitud),map);
            map.setZoom(14);                        
              }
            })             
        });
        
        
        var PrimeraCIA=true;
        google.maps.event.addDomListener(tabCIA, 'click', function() {
          if (PrimeraCIA) {
            MakersCIA=setMarkersCIA(map);
            MakersPIA=setMarkersPIA(map);
            MakersPEA=setMarkersPEA(map);
            MakersPRIA=setMarkersPRIA(map);
          }
          clearMarkersCGM();
          clearMarkersCATASTRO();
          clearMarkersCOOR();
          clearMarker(MakersPMA);
          clearMarker(MakersCIRA);
          showMarker(MakersPIA);
          showMarker(MakersPRIA);
          showMarker(MakersPEA);
          showMarkersCIA();
        });
        var PrimeraCIRA=true;
        google.maps.event.addDomListener(tabCIRA, 'click', function() {
          if (PrimeraCIRA) {
              MakersPMA=setMarkersPMA(map);
              MakersCIRA=setMarkersCIRA(map);            
          }
          clearMarkersCGM();
          showMarker(MakersPMA);
          showMarker(MakersCIRA);
          clearMarker(MakersPIA);
          clearMarker(MakersPRIA);
          clearMarker(MakersPEA);
          clearMarkersCATASTRO();
          clearMarkersCIA();
          clearMarkersCOOR();
        });
        map.addListener('zoom_changed', function() {
          var X=map.getZoom();
          if (X<11) {
            clearMarkersNombreDistritos();
            clearMarker(LayersNombresProvincias);
          }
          else
          {
            if(checkDistritos.checked==true){
            showMarkersNombreDistritos();}
            if (checkProvincias.checked==true) {
            showMarker(LayersNombresProvincias);}
          }

        });
        var Cargarkml=document.getElementById('CargarKml');
        google.maps.event.addDomListener(Cargarkml, 'click', function() {
          LoadKmlTemp(map);
        }); //PintarPunto

        var CargarPunto=document.getElementById('PintarPunto');        
        google.maps.event.addDomListener(CargarPunto, 'click', function() {
          PuntoTemporal(map);          
        });
      }
      //carta
      function setMapa(map,Arr)
      {
        for (var i = Arr.length - 1; i >= 0; i--) {
          Arr[i].setMap(map);
        }
      }
      function clearMarker(Arr)
      {
        setMapa(null,Arr);
      }
      function showMarker(Arr)
      {
        setMapa(map,Arr);
      }
      function setMapCapaCarta(map)
      {
        for (var i = LayersCarta.length - 1; i >= 0; i--) {
          LayersCarta[i].setMap(map);
        }
      }
      function clearMarkerCarta() {
        setMapCapaCarta(null);
      }
      function showMarkerCarta() {
        setMapCapaCarta(map);
      }
      //funcion zonas
      function setMapCapaZonas(map)
      {
        for (var i = LayersZonas.length - 1; i >= 0; i--) {
          LayersZonas[i].setMap(map);
        }
      }
      function clearMarkerZonas() {
        setMapCapaZonas(null);
      }
      function showMarkerZonas() {
        setMapCapaZonas(map);
      }
      //funcion para mostrar capa de distritos LayersZonas
      function setMapCapaDistritos(map)
      {
        for (var i = LayersCapaDistritos.length - 1; i >= 0; i--) {
          LayersCapaDistritos[i].setMap(map);
        }
      }
      function clearMarkersDistritos() {
        setMapCapaDistritos(null);
      }
      function showMarkersDistritos() {
        setMapCapaDistritos(map);
      }
      //funcion nombres
      function setMapNombreDistritos(map)
      {
        for (var i = LayersNombresDistritos.length - 1; i >= 0; i--) {
          LayersNombresDistritos[i].setMap(map);
        }
      }
      function clearMarkersNombreDistritos() {
        setMapNombreDistritos(null);
      }
      function showMarkersNombreDistritos() {
        setMapNombreDistritos(map);
      }
      //Ocultar Coordinaciones CGM
      function setMapOnAllCOOR(map) {
        
        for (var i = MakersCOORDINACIONES.length - 1; i >= 0; i--) {
          MakersCOORDINACIONES[i].setMap(map);
        }
      }
      function clearMarkersCOOR() {
        setMapOnAllCOOR(null);
      }
      // Shows any markers currently in the array.
      function showMarkersCOOR() {
        setMapOnAllCOOR(map);
      }
      ///Ocultar Monumentos CGM
      function setMapOnAllCGM(map) {
        for (var i = 0; i < MakersCGM.length; i++) {
          MakersCGM[i].setMap(map);
          //alert(MakersCGM[i].getTitle());
        }
      }
      function setMapOnAllCIA(map) {
        for (var i = 0; i < MakersCIA.length; i++) {
          MakersCIA[i].setMap(map);
        }
      }
      //catastro
      function setMapOnAllCATASTRO(map) {
        for (var i = 0; i < LayersCATASTRO.length; i++) {
          LayersCATASTRO[i].setMap(map);
        }
      }
      function clearMarkersCATASTRO() {
        setMapOnAllCATASTRO(null);
      }
      function showMarkersCATASTRO() {
        setMapOnAllCATASTRO(map);
      }
      // Removes the markers from the map, but keeps them in the array.
      function clearMarkersCIA() {
        setMapOnAllCIA(null);
      }
      function clearMarkersCGM() {
        setMapOnAllCGM(null);
      }
      // Shows any markers currently in the array.
      function showMarkersCIA() {
        setMapOnAllCIA(map);
      }
      function showMarkersCGM() {
        setMapOnAllCGM(map);
      }
      ///
      function findMarkerCGM(latlon,map) {
        for (var i = MakersCGM.length - 1; i >= 0; i--) {
          if (MakersCGM[i].getPosition().equals(latlon)) {
            new google.maps.event.trigger( MakersCGM[i], 'click' );
          }
        }
          /*pt = MakersCGM[Nombre].getPosition();
          
          map.panTo(newpt);
          infoWindow.setContent(MakersCGM[Nombre].get('iwcontent'));
          infoWindow.setPosition(MakersCGM[Nombre].getPosition());
          infoWindow.open(map, MakersCGM[Nombre]);*/
      }
      function LoadKmlTemp(map)
      {
        //
        
        var src=document.getElementById('KmlTemp').innerHTML;
        var dominio=document.domain;
        var elto=$('#DirKMLtemp').val();
        var conj='http://'+dominio+'/'+elto;
        //document.getElementById("div1").innerHTML="<a target='_blank' id='mmm2' href='"+src+"'>Redireccion</a>";
        if (src!="uploads/" && src!='') {
          var kmlLayer = new google.maps.KmlLayer(conj, {
            map: map
          });
        }
        //
      }
      function PuntoTemporal(map)
      {
        //
        latlon = new Array(2);
        var x, y, zone, southhemi;
        x=$('#xx').val();
        y=$('#yy').val();
        zone=$('#zz').val();
        southhemi=true;

        UTMXYToLatLon (x, y, zone, southhemi, latlon);
        var Lt=RadToDeg(latlon[0]); 
        var Ld=RadToDeg(latlon[1]);
        if (Ld>-180 && Ld<180 && Lt>-90 && Lt<90) {
          
          var pos=new google.maps.LatLng(RadToDeg(latlon[0]), RadToDeg(latlon[1]));
          var marker = new google.maps.Marker({
            position: pos,
            label:{text:'T',color:'white',fontFamily:"Comic Sans MS"},
            title:'Punto Temporal',
            map: map
          });
        }
        else{
          alert('Punto incorrecto');
        }
        
        map.setCenter(pos);
        x=document.getElementById("xx").value='';
        x=document.getElementById("yy").value='';
        x=document.getElementById("zz").value='';
      }
      $("#PanelCGM").on("click",function(){
            document.getElementById("cbMONUMENTOS").checked = true;
            document.getElementById("cbCOORDINACIONES").checked = true;
        });
      $("#PanelCIRA").on("click",function(){
            document.getElementById("cbCIRAS").checked = true;
            document.getElementById("cbPMAS").checked = true;
        });
      $("#PanelCIA").on("click",function(){
            document.getElementById("cbPIA").checked = true;
            document.getElementById("cbPEA").checked = true;
            document.getElementById("cbPRIA").checked = true;
            document.getElementById("cbOTRO").checked = true;
        });
    </script>
    
    
