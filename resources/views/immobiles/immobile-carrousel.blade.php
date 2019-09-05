<div class="px-2">
    <div id="carrousel-partial" class="owl-carousel owl-theme owl-loaded">
        <div class="owl-stage-outer">
            <div class="owl-stage">
                <div class="owl-item px-2">
                    <div class="block-immobile-carrousel"
                        style="background-image: url('{{url('images/site/backs/interior-sala3.jpg')}}');">
                        <div class="data-immobile">
                            <h5 class="data-immobile-neighborhood">
                                Jardim Vitória, Poços de Caldas
                            </h5>
                            <h3 class="data-immobile-description">
                                Lorem Ipsum is simply dummy text of the printing
                            </h3>
                            <span class="data-immobile-price">
                                R$ 1.030.000
                            </span>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-immobile-carrousel"
                        style="background-image: url('{{url('images/site/backs/sala-estar.jpg')}}');">
                        <div class="data-immobile">
                            <h5 class="data-immobile-neighborhood">
                                Santa Ângela, Poços de Caldas
                            </h5>
                            <h3 class="data-immobile-description">
                                Lorem Ipsum is simply dummy text of the printing
                            </h3>
                            <span class="data-immobile-price">
                                R$ 2.000.000
                            </span>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-immobile-carrousel"
                        style="background-image: url('{{url('images/site/backs/studio.jpg')}}');">
                        <div class="data-immobile">
                            <h5 class="data-immobile-neighborhood">
                                Contry Club, Poços de Caldas
                            </h5>
                            <h3 class="data-immobile-description">
                                Lorem Ipsum is simply dummy text of the printing
                            </h3>
                            <span class="data-immobile-price">
                                R$ 500.000
                            </span>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-immobile-carrousel"
                        style="background-image: url('{{url('images/site/backs/cozinha.jpg')}}');">
                        <div class="data-immobile">
                            <h5 class="data-immobile-neighborhood">
                                Centro, Poços de Caldas
                            </h5>
                            <h3 class="data-immobile-description">
                                Lorem Ipsum is simply dummy text of the printing
                            </h3>
                            <span class="data-immobile-price">
                                R$ 2.000.000
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-dots">
            <div class="owl-dot active"><span></span></div>
            <div class="owl-dot"><span></span></div>
            <div class="owl-dot"><span></span></div>
        </div>
        <div class="owl-nav">
            <button type="button" role="presentation" class="owl-prev">
                <span aria-label="Previous"><i class="mdil mdil-chevron-left"></i></span>
            </button>
            <button type="button" role="presentation" class="owl-next">
                <span aria-label="Next">›</span>
            </button>
        </div>
    </div>
</div>
@section('js-util')
@parent
$('#carrousel-partial').owlCarousel({
loop: true,
//autoplay: true,
responsiveClass: true,
responsive:{
0:{
items:1,
nav: true
},
768:{
items:2,
nav: true
}
}
});
@endsection