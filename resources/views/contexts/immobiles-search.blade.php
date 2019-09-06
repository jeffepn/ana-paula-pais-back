<section class="section-immobiles-search row">
    <div class="sidebar-search pt-3">
        <form class="form-search-immobile">
            <div class="row">
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    {{Form::select('bussiness', [1=>'Alugar',2=>'Comprar'], null, ['class'=>'form-control'])}}
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
                    {{Form::select('neighborhood', [''=>'Bairro',1=>'Centro',2=>'Jd. Vitória',3=>'Santa Ângela'], null, ['class'=>'form-control'])}}
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    {{Form::select('dormitory', [''=>'Tipo do imóvel',1=>'Casa',2=>'Apartamento',3=>'Cobertura'], null, ['class'=>'form-control'])}}
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    {{Form::select('dormitory', [''=>'Dormitórios',0,1,2,3,4,5,6,7,8,9,10], null, ['class'=>'form-control'])}}
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" placeholder="Vagas na garagem">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="" placeholder="Preço min.">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="" placeholder="Preços máx.">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="" placeholder="Área (m²) min.">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="" placeholder="Área (m²) máx.">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <button class="btn bt--pr w-100"> Filtrar </button>
                </div>
            </div>
        </form>
    </div>
</section>
<section class="section-view-all-immobiles">
    <div class="row">
        <div class="immobile-list">
            <div class="immobile-list-card">
                <div class="immobile-list-image">
                    <div class="owl-carousel owl-theme owl-loaded carrousel-owl">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/interior-sala3.jpg')}}" alt="">
                                </div>
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/interior-sala3.jpg')}}" alt="">
                                </div>
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/interior-sala3.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="immobile-list-context">
                    <p>
                        Jardim Vitória, Poços de Caldas<br>
                        <span>(AN-43543)</span>
                    </p>
                    <hr>
                    <h4>
                        Lorem Ipsum is simply dummy text of the printing
                    </h4>
                    <div class="item-data-immobile">
                        2<br>
                        <i class="fas fa-car-alt"></i>
                    </div>
                    <div class="item-data-immobile">
                        5<br>
                        <i class="fas fa-bed"></i>
                    </div>
                    <div class="item-data-immobile">
                        3<br>
                        <i class="fas fa-shower"></i>
                    </div>
                    <div class="immobile-list-context-price">
                        R$ 1.030.000
                    </div>
                </div>
            </div>
        </div>
        <div class="immobile-list">
            <div class="immobile-list-card">
                <div class="immobile-list-image">
                    <div class="owl-carousel owl-theme owl-loaded carrousel-owl">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/sala-estar.jpg')}}" alt="">
                                </div>
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/sala-estar.jpg')}}" alt="">
                                </div>
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/sala-estar.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="immobile-list-context">
                    <p>
                        Santa Ângela, Poços de Caldas<br>
                        <span>(AN-43544)</span>
                    </p>
                    <hr>
                    <h4>
                        Lorem Ipsum is simply dummy text of the printing
                    </h4>
                    <div class="item-data-immobile">
                        2<br>
                        <i class="fas fa-car-alt"></i>
                    </div>
                    <div class="item-data-immobile">
                        5<br>
                        <i class="fas fa-bed"></i>
                    </div>
                    <div class="item-data-immobile">
                        3<br>
                        <i class="fas fa-shower"></i>
                    </div>
                    <div class="immobile-list-context-price">
                        R$ 2.000.000
                    </div>
                </div>
            </div>
        </div>
        <div class="immobile-list">
            <div class="immobile-list-card">
                <div class="immobile-list-image">
                    <div class="owl-carousel owl-theme owl-loaded carrousel-owl">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/studio.jpg')}}" alt="">
                                </div>
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/studio.jpg')}}" alt="">
                                </div>
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/studio.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="immobile-list-context">
                    <p>
                        Contry Club, Poços de Caldas<br>
                        <span>(AN-43545)</span>
                    </p>
                    <hr>
                    <h4>
                        Lorem Ipsum is simply dummy text of the printing
                    </h4>
                    <div class="item-data-immobile">
                        2<br>
                        <i class="fas fa-car-alt"></i>
                    </div>
                    <div class="item-data-immobile">
                        5<br>
                        <i class="fas fa-bed"></i>
                    </div>
                    <div class="item-data-immobile">
                        3<br>
                        <i class="fas fa-shower"></i>
                    </div>
                    <div class="immobile-list-context-price">
                        R$ 500.000
                    </div>
                </div>
            </div>
        </div>
        <div class="immobile-list">
            <div class="immobile-list-card">
                <div class="immobile-list-image">
                    <div class="owl-carousel owl-theme owl-loaded carrousel-owl">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/cozinha.jpg')}}" alt="">
                                </div>
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/cozinha.jpg')}}" alt="">
                                </div>
                                <div class="owl-item">
                                    <img src="{{url('images/site/backs/cozinha.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="immobile-list-context">
                    <p>
                        Centro, Poços de Caldas<br>
                        <span>(AN-43546)</span>
                    </p>
                    <hr>
                    <h4>
                        Lorem Ipsum is simply dummy text of the printing
                    </h4>
                    <div class="item-data-immobile">
                        2<br>
                        <i class="fas fa-car-alt"></i>
                    </div>
                    <div class="item-data-immobile">
                        5<br>
                        <i class="fas fa-bed"></i>
                    </div>
                    <div class="item-data-immobile">
                        3<br>
                        <i class="fas fa-shower"></i>
                    </div>
                    <div class="immobile-list-context-price">
                        R$ 2.000.000
                    </div>
                </div>
            </div>
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