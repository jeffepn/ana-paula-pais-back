@extends('template')
@section('title')
Empreendimentos - {{config('app.name')}}
@endsection
@section('context')
<section class="section-enterprises ">
    <div class="row my-5 px-md-5  align-items-center ">
        <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
            <a href="{{url('empreendimento/blue-park')}}">
                <img src="{{url('images/site/enterprises/blue-park.png')}}">
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
            <a href="{{url('empreendimento/unique')}}">
                <img src="{{url('images/site/enterprises/unique.png')}}">
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
            <a href="{{url('empreendimento/chateau-de-versailles')}}">
                <img src="{{url('images/site/enterprises/chateau.png')}}">
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
            <a href="{{url('empreendimento/easy')}}">
                <img src="{{url('images/site/enterprises/easy.png')}}">
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
            <a href="{{url('empreendimento/green-park')}}">
                <img src="{{url('images/site/enterprises/greenpark.png')}}">
            </a>
        </div>
        <!--<div class="col-sm-6 col-md-4 col-lg-3 mb-5">
            <a href="{{url('empreendimento/lumiere')}}">
                <img src="{{url('images/site/enterprises/lumiere.png')}}">
            </a>
        </div>-->
        <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
            <a href="{{url('empreendimento/zeuz')}}">
                <img src="{{url('images/site/enterprises/zeuz.svg')}}">
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
            <a href="{{url('empreendimento/meditterraneum')}}">
                <img src="{{url('images/site/enterprises/meditterraneum.png')}}">
            </a>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
            <a href="{{url('empreendimento/sorano')}}">
                <img src="{{url('images/site/enterprises/sorano.png')}}">
            </a>
        </div>
    </div>
</section>
@endsection
