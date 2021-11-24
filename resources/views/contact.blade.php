@extends('template')

@section('title')
Contato - {{config('app.name')}}
@endsection

@section('description')
<meta name="description" content="Tem alguma sugestão?
Ficou com dúvida em algum imóvel?
Entre em contato conosco, será um prazer em atênde-lo.">
@endsection

@section('header')
@include('parts.header')
@endsection
@section('context')
@include('contexts.contact')
@endsection
