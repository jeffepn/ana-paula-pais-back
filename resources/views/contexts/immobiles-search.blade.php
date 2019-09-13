<section class="section-immobiles-search row">
    <div class="sidebar-search pt-3">
        <form class="form-search-immobile" action="{{url('registra-busca-de-imoveis')}}">
        @csrf
            <div class="row">
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    {{Form::select('bussiness', $bussiness, session('search_immobile.bussiness'), ['class'=>'form-control'])}}
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Por código">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <button>
                                    <i class="mdil mdil-magnify"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-3">
                    {{Form::select('neighborhood', [''=>'Bairro']+$neighborhoods, session('search_immobile.neighborhood'), ['class'=>'form-control'])}}
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    {{Form::select('type', [''=>'Tipo do imóvel']+$types, session('search_immobile.type'), ['class'=>'form-control'])}}
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    {{Form::select('dormitory', [''=>'Dormitórios',0,1,2,3,4,5,6,7,8,9,10], session('search_immobile.dormitory'), ['class'=>'form-control'])}}
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="garage" placeholder="Vagas na garagem" value="{{session('search_immobile.garage')}}">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="price_min" placeholder="Preço min." value="{{session('search_immobile.price_min')}}">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="price_max" placeholder="Preços máx." value="{{session('search_immobile.price_max')}}">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="area_min" placeholder="Área (m²) min." value="{{session('search_immobile.area_min')}}">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="area_max" placeholder="Área (m²) máx." value="{{session('search_immobile.area_max')}}">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <button type="submit" class="btn bt--pr w-100"> Filtrar </button>
                </div>
            </div>
        </form>
    </div>
</section>
<section class="section-view-all-immobiles">
{{count($immobiles)}}
    <div class="row">
    @foreach($immobiles as $immobile)
<div class="immobile-list">
            <div class="immobile-list-card">
                <div class="immobile-list-context">
                    <a href="{{url('imovel/'.$immobile->slug)}}">
                        <p>
                        {{$immobile->neighborhood->name}}, {{$immobile->neighborhood->city->name}}<br>
                            <span>({{$immobile->slug}})</span>
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
                                    <i class="fas fa-shower"></i>{{$immobile->bathroom}} banheiros
                                </div>
                            </div>
                        </div>
                        <div class="immobile-list-context-price mt-3">
                            <div class="row">
                                @if($immobile->rent)
                                <div class="col-6 px-0"> Aluguel: R$ {{\JpUtilities\Utilities\Util::formatDecimalPtBr($immobile->value_rent)}}</div>
                                @endif
                                @if($immobile->sale)
                                    <div class="col-6 px-0">Venda: R$ {{\JpUtilities\Utilities\Util::formatDecimalPtBr($immobile->value_sale)}}</div>
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