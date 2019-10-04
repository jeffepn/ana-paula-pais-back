@extends('template')
@section('title')
Easy (Vital) - {{config('app.name')}}
@endsection
@php
$version = '1.0.0';
@endphp
@section('context')
<section class="section-enterprises pt-5">
    <img src="{{url('images/site/enterprises/easy1.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy2.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy3.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy4.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy5.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy6.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy7.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy8.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy9.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy10.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy11.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy12.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy13.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy14.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy15.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy16.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy17.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy18.png?v='.$version)}}"><br>
    <img src="{{url('images/site/enterprises/easy19.png?v='.$version)}}"><br>
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
                <input name="slug" value="Easy" readonly>
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
                    placeholder="Mensagem *">Eu gostaria de ter mais informações sobre o Easy.</textarea>
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
