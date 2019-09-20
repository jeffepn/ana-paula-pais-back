@extends('template')

@section('title')
Contato - {{config('app.name')}}
@endsection
@section('header')
@include('parts.header')
@endsection
@section('context')
@include('contexts.contact')
@endsection
