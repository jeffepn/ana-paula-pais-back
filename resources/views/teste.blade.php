@extends('template')
@section('header')
@include('parts.header')
@endsection
@section('context')
<div class="px-3 px-md-5 my-5">
    <h2 class=" ft-secoundary">
        CARACTERÍSTICA(S)
    </h2>
    <p class="my-3">Traga seu negócio para salas comerciais no centro da cidade</p>
    <div class="row ">
        <div class="col-sm-6 col-md-4">
            <li>
                Áreas comuns entregue mobiliadas
            </li>
        </div>
        <div class="col-sm-6 col-md-4">
            <li>
                Comercial
            </li>
        </div>
        <div class="col-sm-6 col-md-4">
            <li>
                Garagem
            </li>
        </div>
    </div>

    <h2 class="my-3 ft-secoundary">Plantas salas comercais</h2>
    <h4>Saúde</h4>
    <img class="m-w-100" src="images/utilsimmobiles/saudesaodomenico.png" alt="">
    <h4>Humanas</h4>
    <img class="m-w-100" src="images/utilsimmobiles/humanassaodomenico.png" alt="">
    <h4>Exatas</h4>
    <img class="m-w-100" src="images/utilsimmobiles/exatassaodomenico.png" alt="">
</div>
@endsection
