@extends('layout.app', ["current" => "clients"])

@section('body')
<div class="card border">
    <div class="card-body">
        <form action="/clients/{{$cli->id}}" method="POST">
        @csrf
        <div class="form-group">
                <label for="nome">Nome do Cliente</label>
                <input type="text" class="form-control" name="nome"
                        value="{{$cli->nome}}" id="nome" placeholder="Nome do Cliente">
            </div>

            <div class="form-group">
                <label for="cpf">Cpf</label>
                <input type="text" class="form-control" name="cpf"
                        value="{{$cli->cpf}}" id="cpf" placeholder="Cpf do Cliente">
            </div>

            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" name="cidade"
                        value="{{$cli->cidade}}" id="cidade" placeholder="Cidade">
            </div>

            <div class="form-group">
                <label for="uf">Uf</label>
                <input type="text" class="form-control" name="uf"
                        value="{{$cli->uf}}" id="uf" placeholder="Uf">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
        </form>
    </div>
</div>
@endsection
