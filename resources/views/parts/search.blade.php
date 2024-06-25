<section class="section-properties-search row">
    <div class="container">
        <div class="sidebar-search pt-3 w-100">
            <div class="row">
                <div class="mb-2 col-sm-6  col-lg-4 col-xl-3">
                    <form action="{{route('property.search_per_code')}}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input name="code" type="text" class="form-control" id="inlineFormInputGroup"
                                placeholder="Por código">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <button type="submit">
                                        <i class="mdil mdil-magnify"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <form class="form-search-property row" action="{{route('property.set_filter')}}">
                    @csrf
                    <div class="mb-2 col-sm-6 col-md-4 col-lg-3">

                        <select name="business" class="form-control">
                            <option value="">Negócio</option>
                            @foreach ($businesses as $business)
                            <option value="{{$business->id}}" @if(session('search_property.business')==$business->id)
                                selected @endif>
                                {{Str::title($business->name)}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2 col-sm-6 col-md-4 col-lg-3">
                        <select name="neighborhood" class="form-control">
                            <option value="">Bairro</option>
                            @foreach ($citiesNeighborhoods as $neighborhoods)
                            <optgroup label="{{$neighborhoods->first()->city->name}}">
                                @foreach ($neighborhoods as $neighborhood)
                                <option value="{{$neighborhood->id}}"
                                    @if(session('search_property.neighborhood')==$neighborhood->id) selected @endif>
                                    {{Str::title($neighborhood->name)}}
                                </option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2 col-sm-6 col-md-4 col-lg-3">

                        <select name="type" class="form-control">
                            <option value="">Tipo do imóvel</option>
                            @foreach ($types as $type)
                            <option value="{{$type->id}}" @if(session('search_property.type')==$type->id)
                                selected @endif>
                                {{Str::title($type->name)}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2 col-sm-6 col-md-4 col-lg-3">
                        {{Form::select('dormitory', [''=>'Dormitórios',0,1,2,3,4,5,6,7,8,9,10],
                        session('search_property.dormitory'), ['class'=>'form-control'])}}
                    </div>
                    <div class="mb-2 col-sm-6 col-md-4 col-lg-3">
                        <input class="form-control" type="number" name="garage" placeholder="Vagas na garagem"
                            value="{{session('search_property.garage')}}">
                    </div>
                    <div class="mb-2 col-sm-6 col-md-4 col-lg-3">
                        <input class="form-control" name="price_max" placeholder="Preço"
                            value="{{session('search_property.price_max')}}">
                    </div>
                    <div class="mb-2 col-sm-6 col-md-4 col-lg-3">
                        <input class="form-control" name="area_max" placeholder="Área (m²)"
                            value="{{session('search_property.area_max')}}">
                    </div>
                    <div class="row w-100 mb-2 justify-content-end">
                        <div class="mb-2 col-12 col-md-4 col-lg-3 col-xl-2">
                            <button type="submit" class="btn bt--pr w-100 w-md-auto"> Filtrar </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@section('js-util')
@parent
maskedNumeralDecimalNotPoint('.form-search-property [name=price_max]');
maskedNumeralDecimalNotPoint('.form-search-property [name=area_max]');
@endsection