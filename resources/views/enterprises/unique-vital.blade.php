@extends('template')
@section('title')
Unique (Vital) - {{config('app.name')}}
@endsection
@section('context')
<section class="section-enterprises pt-5">
    <img src="{{url('images/site/enterprises/unique1.png')}}">
    <img src="{{url('images/site/enterprises/unique2.png')}}">
    <img src="{{url('images/site/enterprises/unique3.png')}}">
    <img src="{{url('images/site/enterprises/unique4.png')}}">
    <img src="{{url('images/site/enterprises/unique5.png')}}">
    <img src="{{url('images/site/enterprises/unique6.png')}}">
    <img src="{{url('images/site/enterprises/unique7.png')}}">
    <img src="{{url('images/site/enterprises/unique8.png')}}">
    <img src="{{url('images/site/enterprises/unique9.png')}}">
    <img src="{{url('images/site/enterprises/unique10.png')}}">
    <img src="{{url('images/site/enterprises/unique11.png')}}">
    <img src="{{url('images/site/enterprises/unique12.png')}}">
    <img src="{{url('images/site/enterprises/unique13.png')}}">
    <img src="{{url('images/site/enterprises/unique14.png')}}">
    <img src="{{url('images/site/enterprises/unique15.png')}}">
    <img src="{{url('images/site/enterprises/unique16.png')}}">
    <img src="{{url('images/site/enterprises/unique17.png')}}">
    <img src="{{url('images/site/enterprises/unique18.png')}}">
    <img src="{{url('images/site/enterprises/unique19.png')}}">
    <img src="{{url('images/site/enterprises/unique20.png')}}">
    <img src="{{url('images/site/enterprises/unique21.png')}}">
    <img src="{{url('images/site/enterprises/unique22.png')}}">
    <img src="{{url('images/site/enterprises/unique23.png')}}">
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
                <input name="slug" value="Unique" readonly>
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
                    placeholder="Mensagem *">Eu gostaria de ter mais informações sobre o Unique.</textarea>
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
