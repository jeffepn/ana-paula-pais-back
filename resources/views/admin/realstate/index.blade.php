@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-5 d-flex align-items-center w-100 justify-content-between">
                <h3>Imóveis</h3>

                <a href="{{route("immobiles.create")}}" class="btn btn-primary">Novo</a>

            </div>
            <table class="table" style="min-width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Criação</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($immobiles as $immobile)
                    <tr>
                        <th scope="row">{{$immobile->slug}}</th>
                        <td>{{$immobile->min_description}}</td>
                        <td>{{$immobile->neighborhood->name}}</td>
                        <td>{{$immobile->created_at->format("Y-m-d")}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success">Ver</button>
                                <button type="button" class="btn btn-primary">Editar</button>
                                <button type="button" class="btn btn-danger">Excluir</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{$immobiles->links()}}
            </div>
        </div>

    </div>
</div>
@endsection
