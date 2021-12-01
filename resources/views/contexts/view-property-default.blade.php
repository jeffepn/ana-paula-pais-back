<div class="property-list">
    <div class="property-list-card">
        <div class="property-list-context">
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
                        <div class="item-data-property">
                            <i class="fas fa-car-alt"></i>{{$propertyView->max_garage}} vaga(s)
                        </div>
                        @endif
                        @if($propertyView->max_dormitory)
                        <div class="item-data-property">
                            <i class="fas fa-bed"></i>{{$propertyView->max_dormitory}} quarto(s)
                        </div>
                        @endif
                        @if($propertyView->building_area > 0)
                        <div class="item-data-property">
                            <span title="Área construída">
                                <i class="far fa-building"></i>{{$propertyView->building_area}} m²
                            </span>
                        </div>
                        @endif
                        @if($propertyView->total_area > 0)
                        <div class="item-data-property">
                            <span title="Área total">
                                <i class="far fa-map"></i>{{$propertyView->total_area}} m²
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="property-list-context-price mt-3">
                    <div class="row">
                        @foreach ($propertyView->businesses as $business)
                        <div class="col-6 px-0">
                            {{Str::title($business->name)}}:<br>
                            @if($business->pivot->value)
                            {{number_format($business->pivot->value, 2, ',','.')}}
                            @else
                            Sob Consulta
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </a>
        </div>
        <a href="{{url('imovel/'.$propertyView->slug)}}">
            <div class="property-list-image">
                @php
                $images = $propertyView->images;
                $way = '';
                $alt = '';
                if($images->isNotEmpty()){
                $way = $images->first()->wayUrl;
                $alt = $images->first()->alt;
                }
                @endphp
                <img src="{{url($way)}}" alt="{{$alt}}">
            </div>
        </a>
    </div>
</div>
