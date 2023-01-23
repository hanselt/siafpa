<!-- JWCC SE MODIFICA EL LAYOUT-->
@extends('templates.borrar.layout')
@section('nav')
    @include('layouts/nav')
@endsection
@section('content')

<div class="clients-box medium-padding">
    <div class="container">
        <h3 class="clients-title font-red">{{$lcMonumento->MONU_varCategoria}} {{$lcMonumento->MONU_varNombre}}</h3>
    </div>
    <div class="row col-md-10 center-margin">
        <div class="col-md-6">
            <div class="icon-box icon-box-left mrg20B">
                <i class="icon-alt font-red glyph-icon icon-align-left wow bounceIn" data-wow-duration="0.8s"></i>
                <div class="icon-wrapper">
                    <h5 class="icon-title wow bounceIn" data-wow-duration="0.6s" data-wow-delay="0.1s">DESCRIPCIÓN</h5>
                    <p class="icon-content wow bounceIn" data-wow-duration="0.6s" data-wow-delay="0.2s">{{$lcMonumento->MONU_varDescripcion}}</p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-6">
            <div class="icon-box icon-box-left mrg20B">
                <i class="icon-alt font-red glyph-icon icon-bank wow bounceIn" data-wow-duration="0.8s" data-wow-delay="0.6s"></i>
                <div class="icon-wrapper">
                    <h5 class="icon-title wow bounceIn" data-wow-duration="0.6s" data-wow-delay="0.7s">ARQUITECTURA</h5>
                    <p class="icon-content wow bounceIn" data-wow-duration="0.6s" data-wow-delay="0.8s">{{$lcMonumento->MONU_varDescripcionArquitectura}}</p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="hero-box hero-box-smaller overflow-hidden font-inverse" style="padding-top:0px; padding-bottom:0px">
        <div class="col-md-12">
            <div class="owl-carousel-5 slider-wrapper carousel-wrapper">

            @foreach($lcImagenes as $imagen)                  
                <div class="pad15A">
                    <div class="thumbnail-box">
                        <a class="thumb-link" href="#" title=""></a>
                        <div class="thumb-content">
                            <div class="center-vertical">
                                <div class="center-content">
                                    <h3 class="thumb-heading wow fadeInDown">
                                        {{$lcMonumento->MONU_varNombre}}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="thumb-overlay bg-primary"></div>
                        <img src="{{$imagen->IMAG_varDirImagen}}" alt="" style="height:250px" />
                    </div>
                </div>
              @endforeach
            </div>

        </div>
        <div class="hero-overlay bg-black opacity-60"></div>
    </div><br/><br/>
    <div class="row col-md-10 center-margin">
        <div class="col-md-6">
            <div class="icon-box icon-box-left mrg20B">
                <i class="icon-alt font-red glyph-icon icon-calendar wow bounceIn" data-wow-duration="0.8s"></i>
                <div class="icon-wrapper">
                    <h5 class="icon-title wow bounceIn" data-wow-duration="0.6s" data-wow-delay="0.1s">ETIMOLOGÍA</h5>
                    <p class="icon-content wow bounceIn" data-wow-duration="0.6s" data-wow-delay="0.2s">{{$lcMonumento->MONU_varEtimologia}}</p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-6">
            <div class="icon-box icon-box-left mrg20B">
                <i class="icon-alt font-red glyph-icon icon-tag wow bounceIn" data-wow-duration="0.8s" data-wow-delay="0.6s"></i>
                <div class="icon-wrapper">
                    <h5 class="icon-title wow bounceIn" data-wow-duration="0.6s" data-wow-delay="0.7s">CATEGORIA</h5>
                    <p class="icon-content wow bounceIn" data-wow-duration="0.6s" data-wow-delay="0.8s">{{$lcMonumento->MONU_varCategoria}}</p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="icon-box icon-box-left mrg20B">
                <i class="icon-alt font-red glyph-icon icon-dashboard wow bounceIn" data-wow-duration="0.8s" data-wow-delay="0.6s"></i>
                <div class="icon-wrapper">
                    <h5 class="icon-title wow bounceIn" data-wow-duration="0.6s" data-wow-delay="0.7s">HORARIO DE ATENCIÓN</h5>
                    <p class="icon-content wow bounceIn" data-wow-duration="0.6s" data-wow-delay="0.8s">{{$lcMonumento->MONU_varHorarioAtencion}}</p>
                </div>
            </div>
        </div>
    </div><br/><br/>

    <div class="cta-box-btn bg-black">
      <div class="container">
          <a href="#" class="btn btn-danger" title="">
              Actividades Trimestrales
          </a>
      </div>
    </div><br/><br/>
    @foreach($lcActividades as $actividad)
      <div class="row col-md-10 center-margin">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h4 style="color: white"><i class="fa fa-fw fa-check"></i>{{$actividad->ACCI_varDescripcion}}</h4>
              </div>
              <div class="panel-body" style="padding-bottom:30px">
                  <div class="col-md-6">
                      <p>{{$actividad->ATRI_intTrimestre}}º Trimestre<br>Planes:{{$actividad->ATRI_varPlanes}}</p>
                      <p style="text-align: right;"><a href="{{$actividad->ATRI_varDirDocumento}}" target="_blank" ><button class="btn btn-black" ><i class="glyphicon glyphicon-download-alt"></i> Descargar Documento</button></a></p>
                  </div>
                  <div class="col-md-6">
                      <div class="owl-slider-1 slider-wrapper">
                          <div>
                              <img src="{{$actividad->ATRI_varImagenAntes}}" class="img-full" alt="Antes">
                              <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Antes</h1>
                          </div>
                          <div>
                              <img src="{{$actividad->ATRI_varImagenDurante}}" class="img-full" alt="Durante">
                              <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Durante</h1>
                          </div>
                          <div>
                              <img src="{{$actividad->ATRI_varImagenDespues}}" class="img-full" alt="Despues">
                              <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s">Despues</h1>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div><br/><br/>
    @endforeach
    @if(strlen($lcMonumento->MONU_varDirVideo)>2)
      <div class="cta-box-btn bg-black">
        <div class="container">
            <a href="#" class="btn btn-danger" title="">
                Video
            </a>
        </div>
      </div><br/><br/>
      <div class="row col-md-10 center-margin">
            <div align="center">
                <p>{{$lcMonumento->MONU_varDirVideo}}</p>
                <center><iframe class="embed-responsive-item" src="{{$lcMonumento->MONU_varDirVideo}}" style="width: 600px;height: 400px;max-width: 90%;max-height: 90%" align="center"></iframe></center>
            </div>
      </div><br/><br/>
    @endif
</div>

@endsection
@section('scripts')
<script>
  let app = new Vue({
    el: '#app',
  });
</script>
@endsection