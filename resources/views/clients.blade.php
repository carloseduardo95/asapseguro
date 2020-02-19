@extends('layout.app', ["current" => "clients"])

@section('body')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Clientes</h5>

        @if(Session::has("msg"))
            <div class="alert alert-danger">
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <p>{{ Session::get('msg') }}</p>
            </div>
        @endif


@if(count($clientes) > 0)
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cpf</th>
                    <th>Cidade</th>
                    <th>Uf</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
    @foreach($clientes as $cli)
                <tr>
                    <td>{{$cli->id}}</td>
                    <td>{{$cli->nome}}</td>
                    <td>{{$cli->cpf}}</td>
                    <td>{{$cli->cidade}}</td>
                    <td>{{$cli->uf}}</td>
                    <td>
                        <a href="/clients/editar/{{$cli->id}}" class="btn btn-sm btn-primary">Editar</a>
                        <a href="/clients/apagar/{{$cli->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    </td>
                </tr>
    @endforeach
            </tbody>
        </table>
@endif
    </div>

    <div class="card-footer">
        <a href="/clients/novo" class="btn btn-sm btn-primary" role="button">Novo Cliente</a>
    </div>
</div>
@endsection
