<div class="property-list col-md-6 col-xl-4">
    <div class="property-list-card">
        <div class="property-list-context">
            <a href="{{route('property.show','AN-'.$propertyView->code)}}">
                <p class="font-weight-bold">
                    {{$propertyView->address->neighborhood->name}},
                    {{$propertyView->address->neighborhood->city->name}}<br>
                    <span>({{"AN-".$propertyView->code}}) {{Str::title($propertyView->sub_type->name)}}</span>
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
        <a href="{{route('property.show','AN-'.$propertyView->code)}}">
            <div class="property-list-image">
                @php
                $image = $propertyView->images->first();
                $way = $image ? $image->thumbnail ? $image->thumbnail_url : $image->way_url : '';
                $alt = $image ? $image->alt : '';
                @endphp
                <img src="{{url($way)}}" alt="{{$alt}}">
            </div>
        </a>
    </div>
</div>
