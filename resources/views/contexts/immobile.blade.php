@if(!$immobilechain)
<section class="section-immobile-not-found">
    <div class="text-center">
        <h1 class="mt-5 ft-third">Imóvel não encontrado, ou não se encontra mais disponível.</h1>
        <a href="{{url()->previous()}}" class="bt--se ft-secoundary-big px-5 py-1 col-auto">Voltar</a>
    </div>
</section>
@else
<section class="section-immobile">
    @php
    $imagehighlight = $immobilechain->images->first();
    @endphp
    <div class="image-highlights" style="background-image: url('{{url($imagehighlight->way)}}');">
    </div>
    <div class="content-default my-5">
        <p>
            {{$immobilechain->neighborhood->name}}, {{$immobilechain->neighborhood->city->name}}<br>
            <span>({{$immobilechain->slug}}) {{$immobilechain->textType()}}</span>
        </p>
        <div class="row">
            <h4>
                {!!$immobilechain->min_description!!}
            </h4>
        </div>
        <div class="immobile-list-context-price mt-3">
            <div class="row">
                @if($immobilechain->rent && $immobilechain->value_rent > 0)
                <div class="col-6 px-0">
                    Aluguel:<br>
                    {{\JpUtilities\Utilities\Util::formatDecimalPtBr($immobilechain->value_rent)}}</div>
                @endif
                @if($immobilechain->sale && $immobilechain->value_sale > 0)
                <div class="col-6 px-0">Venda:<br>
                    {{\JpUtilities\Utilities\Util::formatDecimalPtBr($immobilechain->value_sale)}}</div>
                @endif
            </div>
        </div>
        <div class="mt-4">
            <a class="btn bt--pr--out ft-md ft-secoundary d-inline-block px-5 scrool-smoth my-2 mx-2" href="#more">Ver
                mais</a>
            <a class="btn bt--pr--out ft-md ft-secoundary d-inline-block px-5 scrool-smoth my-2 mx-2"
                href="#more-info">Pedir
                informações</a>
        </div>
    </div>
</section>
<section class="my-2">
    <div id="carrousel-pre-view" class="px-2 owl-carousel owl-theme owl-loaded carrousel-owl carrousel-immobile-view ">
        <div class="owl-stage-outer">
            <div class="owl-stage">
                @foreach ($immobilechain->images as $image)
                <div class="owl-item" data-toggle="modal" data-target="#modal-view-image-immobile">
                    <img src="{{url($image->way)}}" alt="{{$image->alt}}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section id="more" class="description-immobile">
    <div class="divider-section-services-description my-3">
        <h3>Detalhes do imóvel</h3>
        <p>
            @if($immobilechain->garage)
            <span class="p-2">
                <i class="fas fa-car-alt mr-2"></i>{{$immobilechain->garage}} vaga(s)
            </span>
            @endif
            @if($immobilechain->dormitory)
            <span class="p-2">
                <i class="fas fa-bed mr-2"></i>{{$immobilechain->dormitory}} quarto(s)
                @if($immobilechain->suite)
                sendo {{$immobilechain->suite}} suíte(s)
                @endif
            </span>
            @endif
            @if($immobilechain->area_building >0)
            <span class="p-2">
                <i class="far fa-building mr-2"></i>{{$immobilechain->area_building}} m2
            </span>
            @endif
            @if($immobilechain->area_total > 0)
            <span class="p-2">
                <i class="far fa-map mr-2"></i>{{$immobilechain->area_total}} m2
            </span>
            @endif
            @if($immobilechain->value_condominium > 0)
            <span class="p-2">
                <i class="fas fa-dollar-sign mr-2"></i>{{$immobilechain->value_condominium}} (Condomínio)
            </span>
            @endif
            @if($immobilechain->value_iptu >0)
            <span class="p-2">
                <i class="fas fa-dollar-sign mr-2"></i>{{$immobilechain->value_iptu}} (IPTU)
            </span>
            @endif
        </p>
    </div>
    <div class="big-description-immobile">
        <p class="p-4">
            {!!$immobilechain->description!!}
        </p>
    </div>
</section>
<section id="more-info" class="contact-immobile">
    <h2>Gostou do imóvel ou possui alguma dúvida, entre em contato com a gente...</h2>
    @php
    $key = array_key_first($errors->contact->messages());
    @endphp
    @if($key)
    @section('js-util')
    @parent
    $("#form-immobile-contact [name={{$key}}]").focus();
    @endsection
    @endif

    @if(session('successcontact'))
    @section('js-util')
    @parent
    scrollInApp(null,'.form-contact',1);
    @endsection
    @endif

    <form id="form-immobile-contact" class="form-contact" method="POST" action="{{url('contato')}}" novalidate>
        @csrf
        <div class="row px-sm-3">
            <div class="my-2 px-1 col-6">
                <input name="slug" value="{{$immobilechain->slug}}" readonly>
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
                    placeholder="Mensagem *">Eu gostaria de ter mais informações sobre o imóvel {{$immobilechain->slug}}.</textarea>
                <p class="my-3"> {{$errors->contact->first('message')}} </p>
            </div>
            <p class="ft-secoundary-big font-weight-light"> {{session('successcontact')}} </p>
            <div class="my-2 px-1 col-12 text-right">
                <button class="btn bt--se ft-md px-5"> Enviar </button>
            </div>
        </div>
    </form>
</section>

<section class="more-options-immobile my-5">
    <h1 class="my-3"> Mais algumas opções </h1>
    <div class="row justify-content-center">
        @foreach($immobiles as $immobile)
        @if($immobilechain->id != $immobile->id)
        @include('contexts.view-immobile-default',['immobileview'=>$immobile])
        @endif
        @endforeach
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="modal-view-image-immobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <button type="button" class="close-modal-view-image-immobile remove_style_button ml-auto" data-dismiss="modal"
        aria-label="Close">
        <i class="far fa-times-circle fa-3x text-white"></i>
    </button>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body px-0">
                <div id="carrousel-immobile-view" class="owl-carousel owl-theme owl-loaded carrousel-owl">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                            @foreach ($immobilechain->images as $image)
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
@endif

@section('js-util')
@parent

maskedPhone('#phone-contact');

$('#carrousel-pre-view').owlCarousel({
loop: false,
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
