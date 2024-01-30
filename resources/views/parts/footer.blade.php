@php
$key = array_key_first($errors->newsletter->messages());
@endphp
@if($key)
@section('js-util')
@parent
$("#form-newsletter [name={{$key}}]").focus();
//scrollInApp(null,'#form-newsletter',1);
@endsection
@endif

@if(session('successnewsletter'))
@section('js-util')
@parent
scrollInApp(null,'#form-newsletter',1);
@endsection
@endif

<footer class="footer mt-auto py-5">
    <div class="background-footer"></div>
    <div class="ps-md-2 px-lg-5 py-5 content-footer">
        <div class="row">
            <div class="col-md-3 mb-3 col-lg-4 px-xl-4 mb-4">
                <img width="250" class="mx-auto d-block" src="{{url('images/site/logowhite.png')}}"
                    alt="{{config('app.name')}}">
                <br>
                <div class="ft-primary d-flex flex-column align-items-center">
                    <h5 class="d-flex justify-content-between" style="width: 210px;">
                        <span>CRECI-MG</span>
                        <span>J</span>
                        <span>8585</span>
                    </h5>
                    <h5 class="d-flex justify-content-between" style="width: 210px;">
                        <span>CRECI-MG</span>
                        <span>F</span>
                        <span>32225</span>
                    </h5>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 mb-3">
                <h4>Contatos</h4>
                <div class="social-network">
                    <a target="_blank" class=" mr-3" href="{{url(config('app.url_facebook'))}}"><i
                            class="fab fa-facebook-square i-face"></i></a>
                    <a target="_blank" class=" mr-3" href="{{url(config('app.url_instagram'))}}"><i
                            class="fab fa-instagram i-inst"></i></a>
                    <a target="_blank" class=" mr-3" href="{{url(config('app.url_whatsapp'))}}"><i
                            class="fab fa-whatsapp i-wath"></i></a>
                </div>
                <a href="mailto:contato@anapaulapais.com.br" class="d-flex align-items-center text-white ft-primary">
                    <i class="mdil mdil-email mdil-24px mr-2"></i>
                    contato@anapaulapais.com.br
                </a>
                <a href="tel:+553599733-3777" class="d-flex align-items-center text-white ft-primary">
                    <i class="mdil mdil-phone mdil-24px mr-2"></i>
                    (35) 99733-3777
                </a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 mb-3">
                <h4>Newsletter</h4>
                <p>
                    Quer ficar por dentro de nossas novidades?<br>
                    Assine agora nossa Newsletter.
                </p>
                <form id="form-newsletter" action="{{url('newsletter')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input name="name" class="form-control" placeholder="Nome">
                        <p class="mt-3">{{$errors->newsletter->first('name')}}</p>
                    </div>
                    <div class="form-group">
                        <input name="email" class="form-control" placeholder="Endereço de E-mail">
                        <p class="mt-3">{{$errors->newsletter->first('email')}}</p>
                    </div>
                    <p class="my-3"> {{session('successnewsletter')}} </p>
                    <button class="btn bt--se w-100"> Enviar </button>
                </form>
            </div>
        </div>
        <div class="p-5">
            <p class="ft-secoundary-medium font-weight-light text-justify">
                Informamos que as mobílias e artigos de decoração são meramente ilustrativos. Nós resguardamos o direito
                de corrigir eventuais erros ortográficos e preços (os valores de condomínio e iptu podem variar do
                anunciado).
            </p>
        </div>
        <p class="text-center mb-0 px-2">
            © 2019 Imóveis Ana Paula Pais | Todos os direitos reservados<br>
            Desenvolvido por
            <a href="https://jpdesenvolvimentoweb.com.br/">
                <img width="40" class="logo-content mb-2"
                    src="https://jpdesenvolvimentoweb.com.br/images/site/logonewnotext.svg">
                Jp Desenvolvimento Web
            </a>
        </p>
    </div>
</footer>
