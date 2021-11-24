@extends('template')
@section('title')
Meditterraneum (Elos) - {{config('app.name')}}
@endsection
@section('context')
<section class="section-enterprises pt-5 container text-justify">
    <div class="row">
        <div class="col-xl-6">
            <img src="{{url('images/site/enterprises/meditterraneum11.jpg')}}">
        </div>
        <div class="col-xl-6 order-first ft-secoundary-big font-weight-light my-5">
            <h1 class="ft-third text-center mb-5">Um Clássico fiel ao seu estilo.</h1>
            <p class="font-weight-bold">
                150 e 154 m², 3 suítes, até 3 vagas por apto, varanda gourmet, piscina, solário na piscina, academia,
                lounge Gourmet
            </p>
            <p>Design exclusivo. Localização privilegiada.</p>
            <p> Morar no centro, na parte plana da cidade em um apartamento espaçoso, super elegante e confortável.</p>
            <p>Dos mesmos criadores do Residencial Marseille e Chateau Monte Carlo, apresentamos Mediterranuem
                Residence.</p>
            <p>Rua Santos Dumont, esquina com Rua Dr. Vicente Risola.</p>
        </div>
    </div>
    <div class="py-5 ft-primary-medium">
        <h1 class="ft-third">Apartamento 154m²</h1>
        1 suíte master com closet<br>
        2 suítes<br>
        3 banheiros<br>
        Lavabo<br>
        Sala de Estar<br>
        Sala de Jantar<br>
        Varanda Gourmet com 13,8 m²<br>
        Cozinha<br>
        Área de Serviço<br>
        WC área de serviço
    </div>
    <img src="{{url('images/site/enterprises/meditterraneum8.jpg')}}">
    <img src="{{url('images/site/enterprises/meditterraneum9.jpg')}}">
    <div class="py-5 ft-primary-medium">
        <h1 class="ft-third"> Apartamento 150m²</h1>
        1 suíte master com closet<br>
        2 suítes<br>
        3 banheiros<br>
        Lavabo<br>
        Sala de Estar<br>
        Sala de Jantar<br>
        Varanda Gourmet com 13,8 m²<br>
        Cozinha<br>
        Área de Serviço<br>
        WC área de serviço<br>
    </div>
    <img src="{{url('images/site/enterprises/meditterraneum6.jpg')}}">
    <img src="{{url('images/site/enterprises/meditterraneum7.jpg')}}">
    <h1 class="ft-third text-center my-5"> Academia </h1>
    <img src="{{url('images/site/enterprises/meditterraneum3.jpg')}}">
    <h1 class="ft-third text-center my-5"> Piscina </h1>
    <img src="{{url('images/site/enterprises/meditterraneum4.jpg')}}">
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
                <input name="slug" value="Meditterraneum" readonly>
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
                    placeholder="Mensagem *">Eu gostaria de ter mais informações sobre o Meditterraneum.</textarea>
                <p class="my-3"> {{$errors->contact->first('message')}} </p>
            </div>
            <p class="ft-secoundary-big font-weight-light"> {{session('successcontact')}} </p>
            <div class="my-2 px-1 col-12 text-right">
                <button class="btn bt--se ft-md px-5"> Enviar </button>
            </div>
        </div>
    </form>
</section>
@endsection

@section('js-util')
@parent
maskedPhone('#phone-contact');
@endsection
