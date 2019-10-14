@extends('template')
@section('header')
@include('parts.header')
@endsection
@section('context')
<div class="px-3 px-md-5 my-5">
    <h2 class=" ft-secoundary">
        CARACTERÍSTICA(S)
    </h2>
    <p class="my-3">80 % das unidades vendidas, localizado no centro da cidade, tenha conforto e sofisticação em um só
        lugar.</p>
    <div class="row ">
        <div class="col-sm-6 col-md-4">
            <li>
                Área de lazer
            </li>
            <li>
                Área Gourmet
            </li>
            <li>
                Brinquedoteca
            </li>
        </div>
        <div class="col-sm-6 col-md-4">
            <li>
                Churrasqueira
            </li>
            <li>
                Deck Seco e Molhado
            </li>
            <li>
                Espaço Fitness
            </li>
        </div>
        <div class="col-sm-6 col-md-4">
            <li>
                Piscina com borda infinita
            </li>
            <li>
                Playground
            </li>
            <li>
                Varanda Gourmet
            </li>
        </div>
    </div>
</div>
@endsection
