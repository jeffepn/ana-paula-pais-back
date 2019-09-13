@extends('template')
@section('title')
@if($immobile)
{{$immobile->min_description}}
@else
Imóvel não encontrado
@endif
- {{config('app.name')}}
@endsection
@section('context')
@include('contexts.immobile')
@endsection

@section('css')
@parent
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<style>
    .bootstrap-select .dropdown-menu {
        max-width: 100% !important;
        overflow-x: hidden;
    }
</style>

@endsection
@section('js')
@parent
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-pt_BR.min.js"></script>
@endsection
