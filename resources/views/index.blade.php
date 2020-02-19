@extends('layout.app', ["current" => "home"])

@section('body')

<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de Apólices</h5>
                    <p class="card-text">
                        Aqui voce cadastra uma apólice
                    </p>
                    <a href="/polices" class="btn btn-primary">Cadastre uma apólice</a>
                </div>
            </div>

            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de Clientes</h5>
                    <p class="card-text">
                    Aqui voce cadastra os clientes
                    </p>
                    <a href="/clients" class="btn btn-primary">Cadastre os clientes</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
