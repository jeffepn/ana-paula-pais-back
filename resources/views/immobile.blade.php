@extends('template')
@section('title')
@if($immobilechain)
{!!strip_tags($immobilechain->min_description)!!}
@else
Imóvel não encontrado
@endif
- {{config('app.name')}}
@endsection

@section('description')
<meta name="description" content="{!!strip_tags($immobilechain->min_description)!!}">
@endsection
@section('header')
@include('parts.header',['fixed'=>'fixed'])
@endsection
@section('context')
@include('contexts.immobile')
@endsection
