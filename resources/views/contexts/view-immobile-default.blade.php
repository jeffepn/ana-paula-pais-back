<div class="immobile-list">
    <div class="immobile-list-card">
        <div class="immobile-list-context">
            <a href="{{url('imovel/'.$immobileview->slug)}}">
                <p>
                    {{$immobileview->neighborhood->name}}, {{$immobileview->neighborhood->city->name}}<br>
                    <span>({{$immobileview->slug}}) {{$immobileview->textType()}}</span>
                </p>
                <hr>
                <div class="row">
                    <h4>
                        {!!$immobileview->min_description!!}
                    </h4>
                    <div class="col-12 px-0 my-3">
                        @if($immobileview->garage)
                        <div class="item-data-immobile">
                            <i class="fas fa-car-alt"></i>{{$immobileview->garage}} vaga(s)
                        </div>
                        @endif
                        @if($immobileview->dormitory)
                        <div class="item-data-immobile">
                            <i class="fas fa-bed"></i>{{$immobileview->dormitory}} quarto(s)
                        </div>
                        @endif
                        @if($immobileview->area_building > 0)
                        <div class="item-data-immobile">
                            <span title="Área construída">
                                <i class="far fa-building"></i>{{$immobileview->area_building}} m²
                            </span>
                        </div>
                        @endif
                        @if($immobileview->area_total > 0)
                        <div class="item-data-immobile">
                            <span title="Área total">
                                <i class="far fa-map"></i>{{$immobileview->area_total}} m²
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="immobile-list-context-price mt-3">
                    <div class="row">
                        @if($immobileview->rent && $immobileview->value_rent > 0)
                        <div class="col-6 px-0">
                            Aluguel:<br>
                            {{\JpUtilities\Utilities\Util::formatDecimalPtBr($immobileview->value_rent)}}</div>
                        @endif
                        @if($immobileview->sale && $immobileview->value_sale > 0)
                        <div class="col-6 px-0">Venda:<br>
                            {{\JpUtilities\Utilities\Util::formatDecimalPtBr($immobileview->value_sale)}}</div>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        <a href="{{url('imovel/'.$immobileview->slug)}}">
            <div
                class="immobile-list-image @if($immobileview->sold) immobile-list-image-sold @elseif($immobileview->rented) immobile-list-image-rented @endif">
                @php
                $images = $immobileview->images;
                $way = '';
                $alt = '';
                if($images->isNotEmpty()){
                $way = $images->first()->way;
                $alt = $images->first()->alt;
                }
                @endphp
                <img src="{{url($way)}}" alt="{{$alt}}">
                <!-- <div class="owl-carousel owl-theme owl-loaded carrousel-owl">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        @foreach ($immobileview->images as $image)
                        <div class="owl-item">
                            <img src="{{url($image->way)}}" alt="{{$image->alt}}">
                        </div>
                        @endforeach
                    </div>
                </div>
        </div>-->
            </div>
        </a>
    </div>
</div>
