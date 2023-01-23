@extends('layouts.default')

@section('content')




    <div class="row">
        <!-- Jumbotron -->
        <div class="col-xs-12 col-md-9">
            <section class="regular slider">
                <div>
                    <img src="{{ URL::asset('img/slide.jpg') }}">
                </div>
                <div>
                    <img src="{{ URL::asset('img/slide.jpg') }}">
                </div>
                <div>
                    <img src="{{ URL::asset('img/slide.jpg') }}">
                </div>
                <div>
                    <img src="{{ URL::asset('img/slide.jpg') }}">
                </div>
                <div>
                    <img src="{{ URL::asset('img/slide.jpg') }}">
                </div>
                <div>
                    <img src="{{ URL::asset('img/slide.jpg') }}">
                </div>
            </section>
        </div>
        <div class="col-xs-12 col-md-3">
            @include('layouts.partials.buscador')

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-9">


            <div class="tabs_portada">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><img src="img/icon.png"></a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><img src="img/icon.png"></a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><img src="img/icon.png"></a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><img src="img/icon.png"></a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        @include('layouts.partials.mapa')
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        @include('layouts.partials.mapa')
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        @include('layouts.partials.mapa')
                    </div>
                    <div role="tabpanel" class="tab-pane" id="settings">
                        <iframe src="http://www.geopatrimoniocusco.pe/index.php" frameborder="0"></iframe>
                    </div>
                </div>
            </div>





        </div>
        <div class="col-xs-12 col-md-3">
            <div class="box_noticias_portada">
                <h4>Ultimas Noticias</h4>
                @include('layouts.partials.noticias')
            </div>
        </div>

    </div>

    @include('layouts.partials.adicionales')

    @endsection