@extends('layout.app', ["current" => "search"])

@section('body')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Consulta de Apólices</h5>

        <form class="form-horizontal" id="formSearchPolice">
        <div class="form-group">
            <label for="client_id" class="control-label">Cliente</label>
            <div class="input-group">
                <select class="form-control" id="client_id">
                </select>
            </div>
        </div>
        </form>
    </div>

    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="consultar(client_id)">Buscar Apólice</button>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    function carregarClients() {
        $.getJSON('/api/clients', function(data) {
            for(i=0; i < data.length; i++) {
                opcao = '<option value="' + data[i].id + '">' +
                data[i].nome + '</option>';
                $('#client_id').append(opcao);
            }
        });
    }

    function consultar(client_id) {
        $.ajax({
            type: "GET",
            url: "/api/search/" + client_id,
            context: this,
            success: function() {
                console.log('ok');
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function carregarPolices() {
        var cliente = $("#client_id").val();

        $.getJSON('/api/polices', function(polices) {
            for(i=0; i < polices.length; i++) {
                //linha = montarLinha(polices[i]);
                //$('#tabelaPolices>tbody').append(linha);
                console.log(polices[i]);
            }
        });
    }

    $(function() {
        carregarClients();
        carregarPolices();
    })
</script>
@endsection
