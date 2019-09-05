<?php
$flagMenu = '';
if(isset($transparent)){
    $flagMenu =' transparent navbar-transparent ';
}
?>
<nav id="nav-master" class="navbar navbar-expand-md fixed-top navbar-light bg-light {{$flagMenu}}">
    <a class="navbar-brand" href="#">
        <img src="{{url('images/site/logo.png')}}" alt="Ana Paula Pais Imóveis">
    </a>
    <button class="open-menu navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="">Venda</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Aluguel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Serviços</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Sobre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Contato</a>
            </li>
            <!--
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>-->
        </ul>
        <div class="social-network">
            <a class="mr-2" href="#"><i class="fab fa-facebook-square"></i></a>
            <a class="" href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</nav>