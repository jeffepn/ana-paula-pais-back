@include('parts.search')
<section class="section-view-all-immobiles">
    <div class="row">
        <div class="col-12">
            @if($immobiles->isEmpty())
            <h3>Nenhum imóvel encontrado</h3>
            @else
            <h3>{{count($immobiles)}} imóveis encontrado(s)</h3>
            @endif
        </div>
        @foreach($immobiles as $immobile)
        <div class="immobile-list">
            <div class="immobile-list-card">
                <div class="immobile-list-context">
                    <a href="{{url('imovel/'.$immobile->slug)}}">
                        <p>
                            {{$immobile->neighborhood->name}}, {{$immobile->neighborhood->city->name}}<br>
                            <span>({{$immobile->slug}}) {{$immobile->textType()}}</span>
                        </p>
                        <hr>
                        <div class="row">
                            <h4>
                                {{$immobile->min_description}}
                            </h4>
                            <div class="col-12 px-0 my-3">
                                <div class="item-data-immobile">
                                    <i class="fas fa-car-alt"></i>{{$immobile->garage}} vagas
                                </div>
                                <div class="item-data-immobile">
                                    <i class="fas fa-bed"></i>{{$immobile->dormitory}} quartos
                                </div>
                                <div class="item-data-immobile">
                                    <span title="Área construída">
                                        <i class="far fa-building"></i>{{$immobile->area_building}} m2
                                    </span>
                                </div>
                                <div class="item-data-immobile">
                                    <span title="Área total">
                                        <i class="far fa-map"></i>{{$immobile->area_total}} m2
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="immobile-list-context-price mt-3">
                            <div class="row">
                                @if($immobile->rent)
                                <div class="col-6 px-0">
                                    Aluguel:<br>
                                    {{\JpUtilities\Utilities\Util::formatDecimalPtBr($immobile->value_rent)}}</div>
                                @endif
                                @if($immobile->sale)
                                <div class="col-6 px-0">Venda:<br>
                                    {{\JpUtilities\Utilities\Util::formatDecimalPtBr($immobile->value_sale)}}</div>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                <div class="immobile-list-image">
                    <div class="owl-carousel owl-theme owl-loaded carrousel-owl">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                @foreach ($immobile->images as $image)
                                <div class="owl-item">
                                    <img src="{{url($image->way)}}" alt="{{$image->alt}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-12">
            {{$immobiles->links()}}
        </div>
    </div>
</section>
@section('js-util')
@parent
$('.selectpicker').selectpicker();

$('.carrousel-owl').owlCarousel({
loop: true,
autoplay: true,
autoplayHoverPause:true,
dots: false,
responsiveClass: true,
responsive:{
0:{
items:1,
nav: true
}
}
});
@endsection
