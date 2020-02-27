@extends('template')

@section('title')
Nossos Serviços - {{config('app.name')}}
@endsection

@section('description')
<meta name="description"
    content="Você já ouviu falar em curadoria de imóveis? Eu, Ana Paula Pais, faço esse trabalho personalizado para você.">
@endsection

@section('header')
@include('parts.header')
@endsection
@section('context')
@include('contexts.services')
@endsection
