@extends('template')

@section('title')
Sobre - {{config('app.name')}}
@endsection

@section('description')
<meta name="description" content="Eu, Ana Paula Pais, estou no mercado desde 2017, na carreira solo, trabalhando com seriedade, respeito e muito comprometimento.
Minha cultura de serviço é sempre focada no meu cliente, um dos segredos do meu sucesso é a dedicação.">
@endsection

@section('header')
@include('parts.header')
@endsection
@section('context')
@include('contexts.about')
@endsection
