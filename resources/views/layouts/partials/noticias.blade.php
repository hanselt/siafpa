<ul class="noticias_portada">
    <?php for ($i=1; $i < 9 ; $i++) {  ?>
    <li class="single_noticia_portada">
        <div class="imagen_noticia_portada">
            <a href="#"><img class="float_right" src="{{ URL::asset('img/llama.jpg') }}"></a>
        </div>
        <div class="body_noticia_portada">
            <div class="title_noticia_portada">
                <a href="#">Lorem ipsum dolor </a>
            </div>
            <div class="desc_noticia_portada">sit amet, consectetur adipiscing elit. Ut malesuada eget nunc ut ultrices. Nam mi nisi, volutpat vitae malesuada ut, pharetra at elit. In finibus condimentum scelerisque.</div>
        </div></li>
    <?php } ?>
</ul>