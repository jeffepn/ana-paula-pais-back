<div class="py-2">
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
                                    {{$immobileshighlight->min_description}}
                                </h3>
                                <span class="data-immobile-price">
                                    @if($immobileshighlight->rent)
                                    {{\JpUtilities\Utilities\Util::formatDecimalPtBr($immobileshighlight->value_rent)}}
                                    <span class="data-immobile-type-bussiness">( Aluguel ) </span><br>
                                    @endif
                                    @if($immobileshighlight->sale)
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
