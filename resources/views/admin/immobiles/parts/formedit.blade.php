<form id="formimmobile" action="{{route('immobiles.update',$immobile->id)}}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method("PATCH")
    <div class="row">
        <!--
        <div class="col-6 px-2">
            <div class="block-input">
                {{Form::select('neighborhood_id',[''=>'Escolha um bairro *']+$neighborhoods,old('neighborhood_id'),[])}}

            </div>
            <p class="text-danger">{{$errors->first('neighborhood_id')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                {{Form::select('type',[''=>'Escolha um tipo de imóvel *']+$types,old('type'),[])}}

            </div>
            <p class="text-danger">{{$errors->first('type')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                {{Form::select('sale',[''=>'Está a venda',1=>'Sim',0=>'Não'],old('sale'),[])}}

            </div>
            <p class="text-danger">{{$errors->first('sale')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                <input name="value_sale" type="text" placeholder="Valor venda" value="{{old('value_sale')}}">

            </div>
            <p class="text-danger">{{$errors->first('value_sale')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                {{Form::select('rent',[''=>'Está para alugar',1=>'Sim',0=>'Não'],old('rent'),[])}}

            </div>
            <p class="text-danger">{{$errors->first('rent')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                <input name="value_rent" type="text" placeholder="Valor aluguel" value="{{old('value_rent')}}">

            </div>
            <p class="text-danger">{{$errors->first('value_rent')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                <input name="dormitory" type="number" placeholder="Dormitório(s)" value="{{old('dormitory')}}">

            </div>
            <p class="text-danger">{{$errors->first('dormitory')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                <input name="suite" type="number" placeholder="Suite(s)" value="{{old('suite')}}">

            </div>
            <p class="text-danger">{{$errors->first('suite')}}</p>
        </div>

        <div class="col-6 px-2">
            <div class="block-input">
                <input name="bathroom" type="number" placeholder="Banheiro(s)" value="{{old('bathroom')}}">

            </div>
            <p class="text-danger">{{$errors->first('bathroom')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                <input name="garage" type="number" placeholder="Vagas(s) de garagem" value="{{old('garage')}}">

            </div>
            <p class="text-danger">{{$errors->first('garage')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                <input name="value_condominium" type="text" placeholder="Valor condomínio"
                    value="{{old('value_condominium')}}">

            </div>
            <p class="text-danger"> {{$errors->first('value_condominium')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                <input name="value_iptu" type="text" placeholder="Valor IPTU" value="{{old('value_iptu')}}">

            </div>
            <p class="text-danger">{{$errors->first('value_iptu')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                <input name="area_total" type="text" placeholder="Área total" value="{{old('area_total')}}">

            </div>
            <p class="text-danger">{{$errors->first('area_total')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                <input name="area_building" type="text" placeholder="Área construída" value="{{old('area_building')}}">

            </div>
            <p class="text-danger">{{$errors->first('area_building')}}</p>
        </div>

        <div class="col-6 px-2">
            <div class="block-input">
                <input name="min_description" type="text" placeholder="Pequena descrição"
                    value="{{old('min_description')}}">

            </div>
            <p class="text-danger"> {{$errors->first('min_description')}}</p>
        </div>
        <div class="col-6 px-2">
            <div class="block-input">
                <textarea name="description" type="text"
                    placeholder="Descrição do imóvel">{{old('description')}}</textarea>

            </div>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>-->
        <div class="col-sm-6 px-2">
            <div class=" block-input">
                <div class="custom-file">
                    <input type="file" name="image[]" class="custom-file-input" id="customFile"
                        accept="image/jpeg,image/jpg,image/png,image/svg" multiple>
                    <label class="custom-file-label mb-0" for="customFile" data-browse="Procurar"> Escolha a(s)
                        imagem(ns) </label>
                </div>
            </div>
            <p class="text-danger">{{$errors->first('image')}}</p>
        </div>
        <div class="col-12 px-2">
            <button type="submit" class="bt--pr--md">Salvar</button>
        </div>
    </div>

</form>
@section('js-util')
@parent
/*maskedNumeralDecimalNotPoint('#formimmobile [name=value_sale]');
maskedNumeralDecimalNotPoint('#formimmobile [name=value_rent]');
maskedNumeralDecimalNotPoint('#formimmobile [name=value_condominium]');
maskedNumeralDecimalNotPoint('#formimmobile [name=value_iptu]');
maskedNumeralDecimalNotPoint('#formimmobile [name=area_total]');
maskedNumeralDecimalNotPoint('#formimmobile [name=area_building]');*/
@endsection
