@extends('layout.app', ["current" => "clients"])

@section('body')
<div class="card border">
    <div class="card-body">
        <form action="/clients" method="POST">
        @csrf
            <div class="form-group">
                <label for="nome">Nome do Cliente</label>
                <input type="text" class="form-control" name="nome"
                        id="nome" placeholder="Nome do Cliente">
            </div>

            <div class="form-group">
                <label for="cpf">Cpf</label>
                <input type="text" class="form-control" name="cpf"
                        id="cpf" placeholder="Cpf do Cliente">
            </div>

            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" name="cidade"
                        id="cidade" placeholder="Cidade">
            </div>

            <div class="form-group">
                <label for="uf">Uf</label>
                <input type="text" class="form-control" name="uf"
                        id="uf" placeholder="Uf">
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <button type="button" class="btn btn-danger btn-sm" onclick='history.go(-1)'>Cancelar</button>
        </form>
    </div>
</div>
@endsection
