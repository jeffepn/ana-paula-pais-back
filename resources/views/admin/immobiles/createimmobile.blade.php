@extends('laraveladmin::template')

@section('context')
<div class="row">
    <div class="col-md-8 my-2 px-2">
        <div class="cd--one">
            <div class="cd-header">
                <h1> Cadastrar Imóvel </h1>
            </div>
            <div class="m-1">
                <p class=" font-primary--medium c-danger">
                    (*) - Campos obrigatórios
                </p>
                <hr>
                <p class="text-success">{!!session('success')!!}</p>
                <p class="text-danger">{{session('error')}}</p>
                @include('laraveladmin::parts.generateform',['form'=>view('admin.immobiles.parts.formcreate',['neighborhoods'=>$neighborhoods,'types'=>$types])->render()])
            </div>
        </div>
    </div>
    <div class="col-md-4 my-2 px-2">
        <div class="cd--one">
            <div class=" cd-image">
                <img src="{{url('images/site/ana.jpg')}}">
            </div>
            <h6 class="mt-2"> ADMINISTRADOR </h6>
            <h5> {{config('app.name')}} </h5>
            <p>
                Eu, Ana Paula Pais, estou no mercado desde 2017, na carreira solo, trabalhando com seriedade, respeito e
                muito comprometimento.
            </p>
        </div>
    </div>
</div>
@endsection
