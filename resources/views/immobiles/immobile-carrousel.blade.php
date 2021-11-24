<div class="py-2">
    <div id="carrousel-partial-one" class="owl-carousel owl-theme owl-loaded carrousel-owl mb-2">
        <div class="owl-stage-outer">
            <div class="owl-stage">
                <div class="owl-item px-2">
                    <div class="block-enterprise-carrousel"
                        style="background-image: url('{{url('images/site/enterprises/reserva111.svg')}}');background-color: #FFFFFF;">
                        <div class="data-immobile mb-5 text-center">
                            <a class="bt--pr ft-third-big px-5" href="{{url('empreendimento/reserva111')}}">
                                Saber mais
                            </a>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-enterprise-carrousel"
                        style="background-image: url('{{url('images/site/enterprises/bluepark.svg')}}');background-color: #999999;">
                        <div class="data-immobile mb-5 text-center">
                            <a class="bt--pr ft-third-big px-5" href="{{url('empreendimento/blue-park')}}">
                                Saber mais
                            </a>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-enterprise-carrousel"
                        style="background-image: url('{{url('images/site/enterprises/unique.svg')}}');background-color: #1b75bc;">
                        <div class="data-immobile mb-5 text-center">
                            <a class="bt--pr ft-third-big px-5" href="{{url('empreendimento/unique')}}">
                                Saber mais
                            </a>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-enterprise-carrousel"
                        style="background-image: url('{{url('images/site/enterprises/chateau.svg')}}');">
                        <div class="data-immobile mb-5 text-center">
                            <a class="bt--pr ft-third-big px-5" href="{{url('empreendimento/chateau-de-versailles')}}">
                                Saber mais
                            </a>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-enterprise-carrousel"
                        style="background-image: url('{{url('images/site/enterprises/easy.svg')}}');background-color: #999999;">
                        <div class="data-immobile mb-5 text-center">
                            <a class="bt--pr ft-third-big px-5" href="{{url('empreendimento/easy')}}">
                                Saber mais
                            </a>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-enterprise-carrousel"
                        style="background-image: url('{{url('images/site/enterprises/greenpark.svg')}}');background-color: #4d4d4d;">
                        <div class="data-immobile mb-5 text-center">
                            <a class="bt--pr ft-third-big px-5" href="{{url('empreendimento/green-park')}}">
                                Saber mais
                            </a>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-enterprise-carrousel"
                        style="background-image: url('{{url('images/site/enterprises/lumiere.svg')}}');background-color: #4d4d4d;">
                        <div class="data-immobile mb-5 text-center">
                            <a class="bt--pr ft-third-big px-5" href="{{url('empreendimento/lumiere')}}">
                                Saber mais
                            </a>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-enterprise-carrousel"
                        style="background-image: url('{{url('images/site/enterprises/zeuz.svg')}}');">
                        <div class="data-immobile mb-5 text-center">
                            <a class="bt--pr ft-third-big px-5" href="{{url('empreendimento/zeuz')}}">
                                Saber mais
                            </a>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-enterprise-carrousel"
                        style="background-image: url('{{url('images/site/enterprises/meditterraneum.svg')}}');background-color: #000000;">
                        <div class="data-immobile mb-5 text-center">
                            <a class="bt--pr ft-third-big px-5" href="{{url('empreendimento/meditterraneum')}}">
                                Saber mais
                            </a>
                        </div>
                    </div>
                </div>
                <div class="owl-item px-2">
                    <div class="block-enterprise-carrousel"
                        style="background-image: url('{{url('images/site/enterprises/sorano.svg')}}');background-color: #153d49;">
                        <div class="data-immobile mb-5 text-center">
                            <a class="bt--pr ft-third-big px-5" href="{{url('empreendimento/sorano')}}">
                                Saber mais
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="carrousel-partial" class="owl-carousel owl-theme owl-loaded">
        <div class="owl-stage-outer">
            <div class="owl-stage">
                @foreach($immobileshighlights as $immobileshighlight)
                @php
                $image = $immobileshighlight->images->first();
                @endphp
                <div class="owl-item px-2">
                    <a href="{{url('imovel/'.$immobileshighlight->slug)}}">
                        <div class="block-immobile-carrousel" style="background-image: url('{{url( $image->way)}}');">
                            <div class="data-immobile">
                                <h5 class="data-immobile-neighborhood">
                                    {{$immobileshighlight->neighborhood->name.', '.$immobileshighlight->neighborhood->city->name}}
                                </h5>
                                <h3 class="data-immobile-description">
                                    {!!$immobileshighlight->min_description!!}
                                </h3>
                                <span class="data-immobile-price">
                                    @if($immobileshighlight->rent && $immobileshighlight->value_rent > 0)
                                    {{\JpUtilities\Utilities\Util::formatDecimalPtBr($immobileshighlight->value_rent)}}
                                    <span class="data-immobile-type-bussiness">( Aluguel ) </span><br>
                                    @endif
                                    @if($immobileshighlight->sale && $immobileshighlight->value_sale > 0)
                                    {{\JpUtilities\Utilities\Util::formatDecimalPtBr($immobileshighlight->value_sale)}}
                                    <span class="data-immobile-type-bussiness"> ( Venda )</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@section('js-util')
@parent
$('#carrousel-partial-one').owlCarousel({
loop: true,
autoplay: true,
autoplayHoverPause:true,
dots: false,
responsiveClass: true,
nav: true,
responsive:{
0:{
items:1
}
}
});
$('#carrousel-partial').owlCarousel({
loop: true,
autoplay: false,
autoplayHoverPause:true,
dots: false,
responsiveClass: true,
responsive:{
0:{
items:1,
nav: true
},
992:{
items:2,
nav: true
}
}
});
@endsection
