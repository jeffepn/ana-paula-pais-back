<div class="section-clients">
    <div class="content-clients">
        <h1>
            O que estão falando de nós
        </h1>
        <div id="carrousel-clients" class="owl-carousel owl-theme owl-loaded carrousel-owl">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    <div class="owl-item px-2">
                        <div class="item-depoiment">
                            <div class="container">
                                <h3>Alice Monteiro</h3>
                                <p>
                                    Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de
                                    impressos, e vem
                                    sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma
                                    bandeja de tipos e os
                                    embaralhou para fazer um livro de modelos de tipos.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item px-2">
                        <div class="item-depoiment">
                            <h3>Roberto Fagundes</h3>
                            <p>
                                Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de
                                impressos, e vem
                                sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja
                                de tipos e os
                                embaralhou para fazer um livro de modelos de tipos.
                            </p>
                        </div>
                    </div>
                    <div class="owl-item px-2">
                        <div class="item-depoiment">
                            <h3>Fernanda Terra</h3>
                            <p>
                                Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de
                                impressos, e vem
                                sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja
                                de tipos e os
                                embaralhou para fazer um livro de modelos de tipos.
                            </p>
                        </div>
                    </div>
                    <div class="owl-item px-2">
                        <div class="item-depoiment">
                            <h3>Higor Silva</h3>
                            <p>
                                Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de
                                impressos, e vem
                                sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja
                                de tipos e os
                                embaralhou para fazer um livro de modelos de tipos.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js-util')
@parent
$('#carrousel-clients').owlCarousel({
loop: true,
autoplay: true,
autoplayHoverPause:true,
dots: false,
responsiveClass: true,
responsive:{
0:{
items:1,
nav: true
},
768:{
items:2,
nav: true
},
1200:{
items:3,
nav: true
}
}
});
@endsection
