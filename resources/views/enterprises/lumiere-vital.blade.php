@extends('template')
@section('title')
Lumiere (Vital) - {{config('app.name')}}
@endsection
@php
$version = '1.0.0';
@endphp
@section('context')
<section class="section-enterprises pt-5 container">
    <img src="{{url('images/site/enterprises/lumiere1.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere2.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere3.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere4.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere5.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere6.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere7.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere8.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere9.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere10.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere11.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere12.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere13.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere14.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere15.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere16.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere17.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere18.jpg?v='.$version)}}">
    <img src="{{url('images/site/enterprises/lumiere19.jpg?v='.$version)}}">
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
                <input name="slug" value="Lumiere" readonly>
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
                    placeholder="Mensagem *">Eu gostaria de ter mais informações sobre o Lumiere.</textarea>
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
maskedPhone
('#phone-contact');
@endsection
