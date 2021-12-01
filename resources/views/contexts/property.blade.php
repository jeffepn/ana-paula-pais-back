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
    <div class="image-highlights" style="background-image: url('{{url($imagehighlight->way)}}');">
    </div>
    <div class="content-default my-5">
        <p>
            {{$propertyChain->address->neighborhood->name}}, {{$propertyChain->address->neighborhood->city->name}}<br>
            <span>({{Str::upper($propertyChain->slug)}}) {{Str::title($propertyChain->sub_type->name)}}</span>
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
<section class="my-2">
    <div id="carrousel-pre-view" class="px-2 owl-carousel owl-theme owl-loaded carrousel-owl carrousel-property-view ">
        <div class="owl-stage-outer">
            <div class="owl-stage">
                @foreach ($propertyChain->images as $image)
                <div class="owl-item" data-toggle="modal" data-target="#modal-view-image-property">
                    <img src="{{url($image->way)}}" alt="{{$image->alt}}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section id="more" class="description-property">
    <div class="divider-section-services-description my-3">
        <h3>Detalhes do imóvel</h3>
        <p>
            @if($propertyChain->max_garage)
            <span class="p-2">
                <i class="fas fa-car-alt mr-2"></i>{{$propertyChain->max_garage}} vaga(s)
            </span>
            @endif
            @if($propertyChain->max_dormitory)
            <span class="p-2">
                <i class="fas fa-bed mr-2"></i>{{$propertyChain->max_dormitory}} quarto(s)
                @if($propertyChain->suite)
                sendo {{$propertyChain->suite}} suíte(s)
                @endif
            </span>
            @endif
            @if($propertyChain->building_area >0)
            <span class="p-2">
                <i class="far fa-building mr-2"></i>{{$propertyChain->building_area}} m²
            </span>
            @endif
            @if($propertyChain->total_area > 0)
            <span class="p-2">
                <i class="far fa-map mr-2"></i>{{$propertyChain->total_area}} m²
            </span>
            @endif
            {{-- @if($propertyChain->value_condominium > 0)
            <span class="p-2">
                <i class="fas fa-dollar-sign mr-2"></i>{{$propertyChain->value_condominium}} (Condomínio)
            </span>
            @endif
            @if($propertyChain->value_iptu >0)
            <span class="p-2">
                <i class="fas fa-dollar-sign mr-2"></i>{{$propertyChain->value_iptu}} (IPTU)
            </span>
            @endif --}}
        </p>
    </div>
    <div class="big-description-property p-4">
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
                <input name="slug" value="{{Str::upper($propertyChain->slug)}}" readonly>
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
                    placeholder="Mensagem *">Eu gostaria de ter mais informações sobre o imóvel {{$propertyChain->slug}}.</textarea>
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
<!-- Modal -->
<div class="modal fade" id="modal-view-image-property" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <button type="button" class="close-modal-view-image-property remove_style_button ml-auto" data-dismiss="modal"
        aria-label="Close">
        <i class="far fa-times-circle fa-3x text-white"></i>
    </button>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body px-0">
                <div id="carrousel-property-view" class="owl-carousel owl-theme owl-loaded carrousel-owl">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            @foreach ($propertyChain->images as $image)
                            <div class="owl-item px-1">
                                <img src="{{url($image->way)}}" alt="{{$image->alt}}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js-util')
@parent

maskedPhone('#phone-contact');

$('#carrousel-pre-view').owlCarousel({
loop: false,
center: true,
autoplay: true,
autoplayHoverPause:true,
nav: true,
dots: false,
responsiveClass: true,
margin: 10,
responsive:{
0:{
items:2
},
500:{
items:3
},
650:{
items:4
},
768:{
items:5
},
1080:{
items:6
}
}
});
$('.carrousel-owl').owlCarousel({
loop: false,
autoplayHoverPause:true,
nav: true,
dots: false,
responsiveClass: true,
responsive:{
0:{
items:1
}
}
});
@endsection

@endif
