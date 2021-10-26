<section class="section-immobiles-search row">
    <div class="sidebar-search pt-3 w-100">
        <div class="row">
            <div class="mb-2 col-sm-6  col-lg-4 col-xl-3">
                <form action="{{url('busca-imovel-por-codigo')}}" method="POST">
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
            <form class="form-search-immobile row" action="{{url('registra-busca-de-imoveis')}}">
                @csrf
                <div class="mb-2 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    {{Form::select('bussiness', array_merge([''=>'Você quer?'], $bussiness),
                    session('search_immobile.bussiness'),
                    ['class'=>'form-control'])}}
                </div>

                <div class="mb-2 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    {{Form::select('neighborhood', array_merge([''=>'Bairro'], $neighborhoods->toArray()),
                    session('search_immobile.neighborhood'), ['class'=>'form-control'])}}
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    {{Form::select('type', array_merge([''=>'Tipo do imóvel'], $types), session('search_immobile.type'),
                    ['class'=>'form-control'])}}
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    {{Form::select('dormitory', [''=>'Dormitórios',0,1,2,3,4,5,6,7,8,9,10],
                    session('search_immobile.dormitory'), ['class'=>'form-control'])}}
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <input class="form-control" type="number" name="garage" placeholder="Vagas na garagem"
                        value="{{session('search_immobile.garage')}}">
                </div>
                <!--<div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="price_min" placeholder="Preço min."
                        value="{{session('search_immobile.price_min')}}">
                </div> -->
                <div class="mb-2 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <input class="form-control" name="price_max" placeholder="Preço"
                        value="{{session('search_immobile.price_max')}}">
                </div>
                <!--<div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="area_min" placeholder="Área (m²) min."
                        value="{{session('search_immobile.area_min')}}">
                </div>-->
                <div class="mb-2 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <input class="form-control" name="area_max" placeholder="Área (m²)"
                        value="{{session('search_immobile.area_max')}}">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <button type="submit" class="btn bt--pr w-100"> Filtrar </button>
                </div>
            </form>
        </div>
    </div>
</section>
@section('js-util')
@parent
maskedNumeralDecimalNotPoint('.form-search-immobile [name=price_max]');
maskedNumeralDecimalNotPoint('.form-search-immobile [name=area_max]');
@endsection
