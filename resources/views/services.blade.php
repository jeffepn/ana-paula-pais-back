@extends('template')

@section('title')
Nossos Serviços - {{config('app.name')}}
@endsection
@section('header')
@include('parts.header')
@endsection
@section('context')
@include('contexts.services')
@endsection
