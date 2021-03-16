@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-6">
            <div class="d-flex">
                <h3>Registrar novo imóvel</h3>
            </div>

            <form id="formimmobile" action="{{route('immobiles.store')}}" method="POST" enctype="multipart/form-data">
                <p class="text-danger">
                    @if (session("url"))
                    <a href="{{session("url")}}">Url do novo imóvel</a>
                    @endif

                </p>
                @csrf
                <div class="row">
                    <div class="col-12 px-2">
                        <div class="form-group">
                            <label for="textareaDescription">Descrição *:</label>
                            <textarea id="text-area-description-immobile" rows="20" name="description"
                                class="form-control" id="textareaDescription"
                                placeholder="Pequena descrição de chamada do imóvel...">{{old("description",
                                "
<div class='px-2 px-md-5 my-5'>
    <p>
        Apartamento no Bela Vista - Poços de Caldas
    </p>
    <p>
        Apartamento em alto padrão, com ótima localização e andares exclusivos
        por apartamento.
    </p>
    <strong>Apartamento</strong>
    <div>
        <i class='far fa-check-square mr-2'></i>
        3 quartos sendo 1 suíte com closet e varanda com vista para a serra do Cristo
    </div>
    <strong>Condomínio</strong>
    <div>
        <i class='far fa-check-square mr-2'></i>
        Elevador
    </div>
</div>
                                ")}}</textarea>
                            @error("description")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 px-2">
                        <div class="form-group">
                            <label for="selectNeighborhood">Bairro *:</label>
                            <select name="neighborhood_id" class="form-control" id="selectNeighborhood">
                                @foreach ($neighborhoods as $neighborhood)
                                <option value="{{$neighborhood->id}}"
                                    {{old('neighborhood_id') == $neighborhood->id ? 'select': ''}}>
                                    {{$neighborhood->name}} -
                                    {{$neighborhood->city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error("neighborhood_id")
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-12 px-2">
                        <div class="form-group">
                            <label for="selectType">Tipo de imóvel *:</label>
                            <select name="type" class="form-control" id="selectType">
                                @foreach ($types as $key=>$type)
                                <option value="{{$key}}" {{old('type') == $key ? 'select': ''}}>
                                    {{$type}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @error("type")
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="selectSale">Está a venda *:</label>
                            <select name="sale" class="form-control" id="selectSale">
                                <option value="1" {{old('sale') == 1 ? 'select': ''}}>
                                    Sim
                                </option>
                                <option value="0" {{old('sale') == 0 ? 'select': ''}}>
                                    Não
                                </option>
                            </select>
                        </div>
                        @error("sale")
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="inputValueSale">Vl. de venda</label>
                            <input name="value_sale" type="number" class="form-control" id="inputValueSale" min="0"
                                value="{{old("value_sale",0)}}" step="0.01">
                            @error("value_sale")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="selectRent">Está para alugar *:</label>
                            <select name="rent" class="form-control" id="selectRent">
                                <option value="1" {{old('rent') == 1 ? 'select': ''}}>
                                    Sim
                                </option>
                                <option value="0" {{old('rent') == 0 ? 'select': ''}}>
                                    Não
                                </option>
                            </select>
                        </div>
                        @error("rent")
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="inputValueRent">Vl. do aluguel *:</label>
                            <input name="value_rent" type="number" class="form-control" id="inputValueRent" min="0"
                                value="{{old("value_rent",0)}}" step="0.01">
                            @error("value_rent")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="inputDormitory">Dormitórios *:</label>
                            <input name="dormitory" type="number" class="form-control" id="inputDormitory" min="0"
                                value="{{old("dormitory",0)}}">
                            @error("dormitory")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="inputSuite">Suítes *:</label>
                            <input name="suite" type="number" class="form-control" id="inputSuite" min="0"
                                value="{{old("suite",0)}}">
                            @error("suite")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="inputBathroom">Banheiros *:</label>
                            <input name="bathroom" type="number" class="form-control" id="inputBathroom" min="0"
                                value="{{old("bathroom",0)}}">
                            @error("bathroom")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="inputGarage">Vag. na garagem *:</label>
                            <input name="garage" type="number" class="form-control" id="inputGarage" min="0"
                                value="{{old("garage",0)}}">
                            @error("garage")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="inputValueCondominium">Vl. do condomínio:</label>
                            <input name="value_condominium" type="number" class="form-control"
                                id="inputValueCondominium" min="0" value="{{old("value_condominium",0)}}" step="0.01">
                            @error("value_condominium")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="inputValueIptu">Vl. do iptu:</label>
                            <input name="value_iptu" type="number" class="form-control" id="inputValueIptu" min="0"
                                value="{{old("value_iptu",0)}}" step="0.01">
                            @error("value_iptu")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="inputAreaTotal">Área total:</label>
                            <input name="area_total" type="number" class="form-control" id="inputAreaTotal" min="0"
                                value="{{old("area_total",0)}}" step="0.01">
                            @error("area_total")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 px-2">
                        <div class="form-group">
                            <label for="inputAreaBuilding">Área construída:</label>
                            <input name="area_building" type="number" class="form-control" id="inputAreaBuilding"
                                min="0" value="{{old("area_building",0)}}" step="0.01">
                            @error("area_building")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 px-2">
                        <div class="form-group">
                            <label for="textareaMinDescription">Pequena descrição *:</label>
                            <textarea name="min_description" class="form-control" id="textareaMinDescription"
                                placeholder="Pequena descrição de chamada do imóvel...">{{old("min_description")}}</textarea>
                            @error("min_description")
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 px-2">
                        <div class=" block-input">
                            <div class="custom-file">
                                <input type="file" name="image[]" class="custom-file-input" id="customFile"
                                    accept="image/jpeg,image/jpg,image/png,image/svg" multiple>
                                <label class="custom-file-label mb-0" for="customFile" data-browse="Procurar">
                                    Escolha as imagens
                                </label>
                            </div>
                        </div>
                        @error("image")
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-12 px-2">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="col-md-12 col-lg-6 px-3">
            <h3 class="mb-5">Preview</h3>

            <div id="preview-immobile"></div>
        </div>
    </div>
</div>
@endsection
