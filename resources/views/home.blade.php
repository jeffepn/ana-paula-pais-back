@extends('template')
@section('header')
@include('parts.header',['fixed'=>'fixed'])
@include('sections.section-home')
@include('properties.property-carrousel')
@endsection
@section('context')
@include('sections.section-ana')
@endsection

@section('footer')
@include('sections.section-clients')
@parent
@endsection
