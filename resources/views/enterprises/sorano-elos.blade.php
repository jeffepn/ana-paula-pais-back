@extends('template')
@section('title')
Sorano (Elos) - {{config('app.name')}}
@endsection
@section('context')
<section class="section-enterprises pt-5 container text-justify">
    <div class="row">
        <div class="col-xl-6">
            <img src="{{url('images/site/enterprises/sorano1.jpg')}}">
        </div>
        <div class="col-xl-6 order-first ft-secoundary-big font-weight-light my-5">
            <h1 class="ft-third text-center mb-5">Um Condomínio Completo</h1>
            <p class="font-weight-bold">
                90 m², 3 dormitórios, 2 vagas por apto, varanda gourmet, portaria com segurança
            </p>
            <p>Perto de tudo que VOCÊ precisa!</p>
            <p> Se você procura praticidade, modernidade e conforto, o Residencial Sorano se localiza numa região calma
                no centro da cidade, perto de tudo que você precisa, com apartamentos de 3 dormitórios.</p>
            <p>E você pode dar um toque personalizado em seu apartamento com as diferentes opções de acabamento
                disponíveis.</p>
            <p>Rua Castro Alves no centro de Poços de Caldas</p>
        </div>
    </div>
    <h1 class="ft-third text-center my-5">Projetado para quem busca praticidade.</h1>
    <img src="{{url('images/site/enterprises/sorano11.jpg')}}">
    <img src="{{url('images/site/enterprises/sorano12.jpg')}}">
    <h1 class="ft-third text-center my-5">Varanda Gourmet</h1>
    <img src="{{url('images/site/enterprises/sorano2.jpg')}}">
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
                <input name="slug" value="Sorano" readonly>
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
                    placeholder="Mensagem *">Eu gostaria de ter mais informações sobre o Sorano.</textarea>
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
