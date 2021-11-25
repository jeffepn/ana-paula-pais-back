<div class="immobile-list">
    <div class="immobile-list-card">
        <div class="immobile-list-context">
            <a href="{{url('imovel/'.$propertyView->slug)}}">
                <p class="font-weight-bold">
                    {{$propertyView->address->neighborhood->name}},
                    {{$propertyView->address->neighborhood->city->name}}<br>
                    <span>({{Str::upper($propertyView->slug)}}) {{Str::title($propertyView->sub_type->name)}}</span>
                </p>
                <hr>
                <div class="row">
                    <h4>
                        {!!$propertyView->min_description!!}
                    </h4>
                    <div class="col-12 px-0 my-3">
                        @if($propertyView->max_garage)
                        <div class="item-data-immobile">
                            <i class="fas fa-car-alt"></i>{{$propertyView->max_garage}} vaga(s)
                        </div>
                        @endif
                        @if($propertyView->max_dormitory)
                        <div class="item-data-immobile">
                            <i class="fas fa-bed"></i>{{$propertyView->max_dormitory}} quarto(s)
                        </div>
                        @endif
                        @if($propertyView->building_area > 0)
                        <div class="item-data-immobile">
                            <span title="Área construída">
                                <i class="far fa-building"></i>{{$propertyView->building_area}} m²
                            </span>
                        </div>
                        @endif
                        @if($propertyView->total_area > 0)
                        <div class="item-data-immobile">
                            <span title="Área total">
                                <i class="far fa-map"></i>{{$propertyView->total_area}} m²
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="immobile-list-context-price mt-3">
                    <div class="row">
                        @foreach ($propertyView->businesses as $business)
                        @if ($business->pivot->value > 0)
                        <div class="col-6 px-0">
                            {{Str::title($business->name)}}:<br>
                            {{number_format($business->pivot->value, 2, ',','.')}}
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </a>
        </div>
        <a href="{{url('imovel/'.$propertyView->slug)}}">
            <div class="immobile-list-image">
                @php
                $images = $propertyView->images;
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
                        @foreach ($propertyView->images as $image)
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
