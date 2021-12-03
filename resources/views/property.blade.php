@extends('template')
@section('title')
@if($propertyChain)
{!!strip_tags($propertyChain->min_description)!!}
@else
Imóvel não encontrado
@endif
- {{config('app.name')}}
@endsection
@php
$url = request()->url();
@endphp
@if($propertyChain)
@section('description')
<meta property="og:locale" content="pt-br">
<meta property="og:url" content="{{$url}}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{!!strip_tags($propertyChain->min_description)!!}" />
<meta property="og:site_name" content="{{config(" app.name")}}">
<meta property="og:description" content="{!!strip_tags($propertyChain->min_description)!!}" />
<meta property="og:image" content="{{url($propertyChain->images->first()->wayUrl)}}" />
<meta property="og:image:width" content="1200">
<meta name="description" content="{!!strip_tags($propertyChain->min_description)!!}">
@endsection
@endif

@section('header')
@include('parts.header',['fixed'=>'fixed'])
@endsection
@section('context')
@include('contexts.property')
@endsection
