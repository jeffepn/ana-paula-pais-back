@extends('template')
@section('title')
Reserva 111 (Vital) - {{config('app.name')}}
@endsection
@section('context')
<section class="section-enterprises pt-5 container text-justify">
    <div class="col-12 ft-secoundary-big font-weight-light my-5">
        <h1 class="ft-third text-center mb-5">
            Estilo, inovação, beleza arquitetônica
        </h1>
        <p class="font-weight-bold">
            45 m², 2 dormitórios, varanda gourmet, cozinha, área de serviço,
            sala de estar e jantar e banheiro social
        </p>
        <p>
            Não existe nada parecido na região. Tudo para colocar
            você em evidência. O empreendimento possui um
            estilo arquitetônico extremamente moderno. Um projeto
            que se propõe a ser um diferencial para a cidade.
            Bonito, arrojado, amigável. Um lugar onde tudo que
            você precisa está ao seu redor.
        </p>
    </div>
    <div class="row">
        <div class="col-sm-6 py-2 ft-third text-center align-items-center d-flex">
            <h6 class="bg-secoundary text-white p-3 m-auto  w-100">
                Entrada
                facilitada,
                projeto
                financiado
                pelo:
            </h6>
        </div>
        <div class="col-sm-6 py-2">
            <img class="m-w-100" src="{{url('images/site/enterprises/reserva111/casaverdeamarela.png')}}">
        </div>
    </div>
    <div class="col-12 align-items-center mb-3">
        <img src="{{url('images/site/enterprises/reserva111/reserva111-2.png')}}">
    </div>
    <div class="row">
        <div class="col-sm-6 ft-third text-center align-items-center d-flex">
            <h5 class="bg-secoundary text-white p-3 m-auto  w-100">
                Varanda Gourmet com churrasqueira
            </h5>
        </div>
        <div class="col-sm-6">
            <img src="{{url('images/site/enterprises/reserva111/reserva111-4.png')}}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6  ft-third text-center align-items-center d-flex">
            <h5 class="bg-secoundary text-white p-3 m-auto  w-100">
                Hall de entrada
            </h5>
        </div>
        <div class="col-sm-6 order-sm-first">
            <img src="{{url('images/site/enterprises/reserva111/reserva111-5.png')}}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 ft-third text-center align-items-center d-flex">
            <h5 class="bg-secoundary text-white p-3 m-auto  w-100">
                Brinquedoteca
            </h5>
        </div>
        <div class="col-sm-6">
            <img src="{{url('images/site/enterprises/reserva111/reserva111-6.png')}}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6  ft-third text-center align-items-center d-flex">
            <h5 class="bg-secoundary text-white p-3 m-auto  w-100">
                Salão de Jogos
            </h5>
        </div>
        <div class="col-sm-6 order-sm-first">
            <img src="{{url('images/site/enterprises/reserva111/reserva111-8.png')}}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 ft-third text-center align-items-center d-flex">
            <h5 class="bg-secoundary text-white p-3 m-auto w-100">
                Academia
            </h5>
        </div>
        <div class="col-sm-6">
            <img src="{{url('images/site/enterprises/reserva111/reserva111-9.png')}}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6  ft-third text-center align-items-center d-flex">
            <h5 class="bg-secoundary text-white p-3 m-auto w-100">
                ROOFTOP
                02 Espaços
                Gourmet
            </h5>
        </div>
        <div class="col-sm-6 order-sm-first">
            <img src="{{url('images/site/enterprises/reserva111/reserva111-7.png')}}">
        </div>
    </div>
    <div class="ft-third text-center col-auto m-auto py-3" style="max-width: 700px">
        <h5 class="bg-secoundary text-white p-3 m-auto w-100">
            ROOFTOP
        </h5>
        <img src="{{url('images/site/enterprises/reserva111/reserva111-10.png')}}">
        <h6 class="bg-secoundary text-white p-3 m-auto w-100">
            Piscina com borda infinita <br>
            na cobertura do prédio
        </h6>
    </div>
    <div class="row ft-third text-center mb-3 ">
        <div class="col-12 py-3">
            <h4 class="bg-secoundary text-white p-3 m-auto d-inline-block px-5">
                Aprox. 45 M²
            </h4>
        </div>
        <div class="col-sm-6">
            <img src="{{url('images/site/enterprises/reserva111/reserva111-11.png')}}">
        </div>
        <div class="col-sm-6">
            <img src="{{url('images/site/enterprises/reserva111/reserva111-12.png')}}">
        </div>
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
                <input name="slug" value="Reserva 111" readonly>
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
