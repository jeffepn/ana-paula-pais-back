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
                    <input class="form-control" name="garage" placeholder="Vagas na garagem"
                        value="{{session('search_immobile.garage')}}">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="price_min" placeholder="Preço min."
                        value="{{session('search_immobile.price_min')}}">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="price_max" placeholder="Preços máx."
                        value="{{session('search_immobile.price_max')}}">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="area_min" placeholder="Área (m²) min."
                        value="{{session('search_immobile.area_min')}}">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <input class="form-control" name="area_max" placeholder="Área (m²) máx."
                        value="{{session('search_immobile.area_max')}}">
                </div>
                <div class="mb-2 col-sm-4 col-md-3 col-lg-2">
                    <button type="submit" class="btn bt--pr w-100"> Filtrar </button>
                </div>
            </div>
        </form>
    </div>
</section>
