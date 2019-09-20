@extends('template')

@section('title')
Sobre - {{config('app.name')}}
@endsection
@section('header')
@include('parts.header')
@endsection
@section('context')
@include('contexts.about')
@endsection
