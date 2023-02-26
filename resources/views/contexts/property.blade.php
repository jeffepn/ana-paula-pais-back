@if(!$propertyChain)
<section class="section-property-not-found">
    <div class="text-center mb-4">
        <h1 class="mt-5 ft-third">Imóvel não encontrado, ou não se encontra mais disponível.</h1>
        <a href="{{url()->previous()}}" class="bt--se ft-secoundary-big px-5 py-1 col-auto">Voltar</a>
    </div>
</section>
@else
<section class="section-property">
    @php
    $imagehighlight = $propertyChain->images->first();
    @endphp
    <div class="image-highlights" style="background-image: url('{{url($imagehighlight->wayUrl)}}');">
    </div>
    <div class="content-default my-5">
        <p>
            {{$propertyChain->address->neighborhood->name}}, {{$propertyChain->address->neighborhood->city->name}}<br>
            <span>({{"AN-".$propertyChain->code}}) {{Str::title($propertyChain->sub_type->name)}}</span>
        </p>
        <div class="row">
            <h4>
                {!!$propertyChain->min_description!!}
            </h4>
        </div>
        <div class="property-list-context-price mt-3">
            <div class="row">
                @foreach ($propertyChain->businesses as $business)
                @if ($business->pivot->value > 0)
                <div class="col-6 px-0">
                    {{Str::title($business->name)}}:<br>
                    {{number_format($business->pivot->value, 2, ',','.')}}
                </div>
                @endif
                @endforeach
            </div>
        </div>
        <div class="mt-4">
            <a class="btn bt--pr--out ft-md ft-secoundary d-inline-block px-5 scrool-smoth my-2 mx-2" href="#more">Ver
                mais</a>
            <a class="btn bt--pr--out ft-md ft-secoundary d-inline-block px-5 scrool-smoth my-2 mx-2"
                href="#more-info">Pedir
                informações</a>
            <a class="btn bt--pr--out ft-md ft-secoundary d-inline-block px-5 my-2 mx-2 copy-link-property" href="#"
                data-clipboard-text="{{request()->url()}}" data-toggle="tooltip" data-placement="top"
                title="Link copiado para área de transferência">Compartilhar link</a>
        </div>
    </div>
</section>
<section>
    <div class="swiper-coverflow container">
        <div id="swiperProperty" class="swiper">
            <div class="swiper-wrapper">
                @foreach ($propertyChain->images as $image)
                <div class="swiper-slide"
                    style="background-image: url({{$image->thumbnail_url ?? $image->way_url}}); background-size: cover; background-position: center; background-repeat: no-repeat">
                    <a data-fslightbox="gallery" href="{{$image->way_url}}" class="stretched-link"></a>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-prev" data-id-swiper="swiperProperty"></div>
            <div class="swiper-button-next" data-id-swiper="swiperProperty"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<section id="more">
    <div class="jumbotron jumbotron-fluid mb-0">
        <div class="container">
            <h1 class="display-4 ft-third">Detalhes do imóvel</h1>
            <p class="lead">
                {!!$propertyChain->min_description!!}
            </p>
            @php
            $detailsProperty = [
            (object) ['prop' => 'max_dormitory', 'icon' => 'cil-bed', 'title' => 'dormitório(s)', 'min' =>
            'min_dormitory'],
            (object) ['prop' => 'max_bathroom', 'icon' => 'cil-shower', 'title' => 'banheiro(s)', 'min' =>
            'min_bathroom'],
            (object) ['prop' => 'max_suite', 'icon' => 'cil-bathroom', 'title' => 'suite(s)', 'min' => 'min_suite'],
            (object) ['prop' => 'max_garage', 'icon' => 'cil-garage', 'title' => 'vaga(s)', 'min' => 'min_garage'],
            (object) ['prop' => 'building_area', 'icon' => 'cil-map', 'title' => 'área construída (m²)', 'min' => null],
            (object) ['prop' => 'total_area', 'icon' => 'cil-map', 'title' => 'área total (m²)', 'min' => null],
            (object) ['prop' => 'useful_area', 'icon' => 'cil-map', 'title' => 'área útil (m²)', 'min' => null],
            (object) ['prop' => 'ground_area', 'icon' => 'cil-map', 'title' => 'área do terreno (m²)', 'min' => null],
            ];
            @endphp

            <div class="row">
                @foreach ($detailsProperty as $item )
                @if ($propertyChain[$item->prop])
                <div class="col-md-6 col-lg-4 my-2">
                    <div
                        class="row d-flex w-100 justify-content-between border-bottom border-secondary text-uppercase py-2">
                        <div class="col-auto align-self-end px-1">
                            <i class="fas fa-caret-right"></i>
                            <div class="icon-rounded d-inline-flex">
                                <i class="{{$item->icon}}"></i>
                            </div>
                            {{$item->title}}
                        </div>
                        <div class="col-auto  align-self-end px-0 ft-md ft-bold">
                            @if($propertyChain[$item->min])
                            {{$propertyChain[$item->min]}} -
                            @endif
                            {{$propertyChain[$item->prop]}}
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
<section class="py-5">
    <div class="container content-property">
        {!!$propertyChain->content!!}
    </div>
</section>
<section id="more-info" class="contact-property">
    <h2>Gostou do imóvel ou possui alguma dúvida, entre em contato com a gente...</h2>
    @php
    $key = array_key_first($errors->contact->messages());
    @endphp
    @if($key)
    @section('js-util')
    @parent
    $("#form-property-contact [name={{$key}}]").focus();
    @endsection
    @endif

    @if(session('successcontact'))
    @section('js-util')
    @parent
    scrollInApp(null,'.form-contact',1);
    @endsection
    @endif

    <form id="form-property-contact" class="form-contact" method="POST" action="{{url('contato')}}" novalidate>
        @csrf
        <div class="row px-sm-3">
            <div class="my-2 px-1 col-6">
                <input name="slug" value="{{" AN-".$propertyChain->code}}" readonly>
            </div>
            <div class="my-2 px-1 col-6">
                <input name="name" placeholder="Nome *">
                <p class="my-3"> {{$errors->contact->first('name')}} </p>
            </div>
            <div class="my-2 px-1 col-6">
                <input id="phone-contact" name="phone" placeholder="Telefone">
                <p class="my-3"> {{$errors->contact->first('phone')}} </p>
            </div>
            <div class="my-2 px-1 col-6">
                <input name="email" type="email" placeholder="E-mail *">
                <p class="my-3"> {{$errors->contact->first('email')}} </p>
            </div>
            <div class="my-2 px-1 col-12">
                <textarea name="message" id="" cols="30" rows="3"
                    placeholder="Mensagem *">Eu gostaria de ter mais informações sobre o imóvel {{"AN-".$propertyChain->code}}.</textarea>
                <p class="my-3"> {{$errors->contact->first('message')}} </p>
            </div>
            <p class="ft-secoundary-big font-weight-light"> {{session('successcontact')}} </p>
            <div class="my-2 px-1 col-12 text-right">
                <button class="btn bt--se ft-md px-5"> Enviar </button>
            </div>
        </div>
    </form>
</section>

@if($properties->isNotEmpty())
<section class="more-options-property my-5">
    <h1 class="my-3"> Mais algumas opções </h1>
    <div class="row justify-content-center">
        @foreach($propertys as $property)
        @if($propertyChain->id != $property->id)
        @include('contexts.view-property-default',['propertyView'=>$property])
        @endif
        @endforeach
    </div>
</section>
@endif

@section('js-util')
@parent
maskedPhone('#phone-contact');
@endsection

@endif
