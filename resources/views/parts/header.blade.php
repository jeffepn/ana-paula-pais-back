@php
$classHeader = '';
if(isset($fixed)){
$classHeader = ' header-fixed ';
}
@endphp
<header class=" px-0 {{$classHeader}}">
    <nav id="nav-master" class="navbar navbar-expand-lg navbar-light container px-0">
        <a class="navbar-brand py-0" href="{{url('/')}}">
            <img class="img-header-floating" src="{{url('images/site/logo.png')}}" alt="Ana Paula Pais Imóveis">
        </a>
        <button class="open-menu navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        </button>

        <div class="collapse navbar-collapse  px-3" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('busca-de-imoveis')}}">Busca</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('nossos-servicos')}}">Serviços</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('sobre')}}">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('contato')}}">Contato</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">(35) 99733-3777</a>
                </li>
            </ul>
            <div class="social-network">
                <a target="_blank" class="px-3" href="{{url(config('app.url_facebook'))}}"><i
                        class="fab fa-facebook-square i-face"></i></a>
                <a target="_blank" class=" px-3" href="{{url(config('app.url_instagram'))}}"><i
                        class="fab fa-instagram i-inst"></i></a>
                <a target="_blank" class=" px-3" href="{{url(config('app.url_whatsapp'))}}"><i
                        class="fab fa-whatsapp i-wath"></i></a>
            </div>
        </div>
    </nav>
</header>
