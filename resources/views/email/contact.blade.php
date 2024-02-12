@php
$url = url('/');
@endphp
@component('mail::message')

<div class="panel-content">
    @if(isset($content['slug']))
    <h1> Contato do Site - Informação do Imóvel {{$content['slug']}} </h1>
    @else
    <h1> Contato do Site </h1>
    @endif
</div>
<br>

# Os dados seguem abaixo

@if(isset($content['slug']))
<br>

## Código do Imóvel : {{$content['slug']}}

@endif
Nome: {{$content['name']}}<br>
Telefone: {{$content['phone']}}<br>
E-mail: {{$content['email']}}<br>
Mensagem: {{$content['message']}}

Mensagem automática ({{ config('app.name') }}) não responder.
@endcomponent
