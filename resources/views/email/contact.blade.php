@php
$url = url('/');
@endphp
@component('mail::message')
@component('mail::panel')
@if(isset($content['slug']))
Contato do Site - Informação Imóvel {{$content['slug']}}
@else
Contato do Site
@endif
@endcomponent
# Os dados seguem abaixo

@if(isset($content['slug']))
<br>
# Código do Imóvel : {{$content['slug']}}
@endif
Nome: {{$content['name']}}<br>
Telefone: {{$content['phone']}}<br>
E-mail: {{$content['email']}}<br>
Mensagem: {{$content['message']}}

Mensagem automática ({{ config('app.name') }}) não responder.
@endcomponent
