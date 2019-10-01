@extends('template')
@section('title')
Blue Park (Vital) - {{config('app.name')}}
@endsection
@section('context')
<section class="section-enterprises">
    <img src="{{url('images/site/enterprises/blue-park1.png')}}">
    <img src="{{url('images/site/enterprises/blue-park2.png')}}">
    <img src="{{url('images/site/enterprises/blue-park3.png')}}">
    <img src="{{url('images/site/enterprises/blue-park4.png')}}">
    <img src="{{url('images/site/enterprises/blue-park5.png')}}">
    <img src="{{url('images/site/enterprises/blue-park6.png')}}">
    <img src="{{url('images/site/enterprises/blue-park7.png')}}">
    <img src="{{url('images/site/enterprises/blue-park8.png')}}">
    <img src="{{url('images/site/enterprises/blue-park9.png')}}">
    <img src="{{url('images/site/enterprises/blue-park10.png')}}">
    <img src="{{url('images/site/enterprises/blue-park11.png')}}">
    <img src="{{url('images/site/enterprises/blue-park12.png')}}">
    <img src="{{url('images/site/enterprises/blue-park13.png')}}">
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
                <input name="slug" value="Blue Park" readonly>
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
                    placeholder="Mensagem *">Eu gostaria de ter mais informações sobre o Blue Park.</textarea>
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
