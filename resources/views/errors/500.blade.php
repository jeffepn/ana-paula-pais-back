@extends('template')
@section('title')
Página não encotrada - {{config('app.name')}}
@endsection
@section('header')
@include('parts.header',['fixed'=>'fixed'])
@endsection
@section('context')

<section class="section-not-found">
    <div class="text-center w-100">
        <h1 class="mt-5  ft-third">500 - Estamos tendo problemas em nosso servidor.</h1>
        <a href="{{url('/')}}" class="bt--se ft-secoundary-big px-5 py-1 col-auto">Voltar</a>
    </div>
</section>
@endsection
