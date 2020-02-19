@extends('layout.app', ["current" => "polices"])

@section('body')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Apólices</h5>

        <table class="table table-ordered table-hover" id="tabelaPolices">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Inicio Vigencia</th>
                    <th>Fim Vigencia</th>
                    <th>Placa</th>
                    <th>Valor</th>
                    <th>Cliente</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novaPolice()">Nova Apólice</button>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgPolices">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formPolice">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Apólice</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="inicio_vigencia" class="control-label">Inicio da Vigencia</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="inicio_vigencia" placeholder="Inicio da Vigencia">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fim_vigencia" class="control-label">Fim da Vigencia</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="fim_vigencia" placeholder="Fim da Vigencia">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="placa" class="control-label">Placa</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="placa" placeholder="Placa">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="valor" class="control-label">Valor da Apólice</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="valor" placeholder="Valor">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="client_id" class="control-label">Cliente</label>
                        <div class="input-group">
                            <select class="form-control" id="client_id">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
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

    function novaPolice() {
        $('#inicio_vigencia').val('');
        $('#fim_vigencia').val('');
        $('#placa').val('');
        $('#valor').val('');
        $('#dlgPolices').modal('show');
    }

    function carregarClients() {
        $.getJSON('/api/clients', function(data) {
            for(i=0; i < data.length; i++) {
                opcao = '<option value="' + data[i].id + '">' +
                data[i].nome + '</option>';
                $('#client_id').append(opcao);
            }
        });
    }

    function montarLinha(p) {
        var status = this.getStatus(p.inicio_vigencia, p.fim_vigencia);
        var linha = "<tr>" +
            "<td>" + p.id + "</td>" +
            "<td>" + p.inicio_vigencia + "</td>" +
            "<td>" + p.fim_vigencia + "</td>" +
            "<td>" + p.placa + "</td>" +
            "<td>" + p.valor + "</td>" +
            "<td>" + p.client_id + "</td>" +
            "<td>" + status + "</td>" +
            "<td>" +
                '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id +')"> Editar </button>' +
                '<button class="btn btn-sm btn-danger" onclick="remover(' + p.id +')"> Apagar </button>' +
            "</td>" +
            "</tr>";
        return linha;
        //console.log(linha);
    }

    function getStatus(dateStart, dateEnd){
        const date1 = new Date(dateStart);
        const date2 = new Date(dateEnd);
        const diffTime = Math.abs(date2 - date1);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        //console.log(diffDays);
        switch (diffDays) {
            case 0:
                return 'Vencida';
                break;
            default:
               return 'Restam '+ diffDays+ ' dias para o vencimento';
                break;
        }
    }

    function editar(id) {
        $.getJSON('/api/polices/'+id, function(data) {
            console.log(data);
            $('#id').val(data.id);
            $('#inicio_vigencia').val(data.inicio_vigencia);
            $('#fim_vigencia').val(data.fim_vigencia);
            $('#placa').val(data.placa);
            $('#valor').val(data.valor);
            $('#client_id').val(data.client_id);
            $('#dlgPolices').modal('show');
        });
    }

    function remover(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/polices/" + id,
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaPolices>tbody>tr");
                e = linhas.filter( function(i, elemento) {
                    return elemento.cells[0].textContent == id;
                });
                if (e)
                    e.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function carregarPolices() {
        $.getJSON('/api/polices', function(polices) {
            for(i=0; i < polices.length; i++) {
                linha = montarLinha(polices[i]);
                $('#tabelaPolices>tbody').append(linha);
            }
        });
    }

    function criarPolice() {
        pol = {
            inicio_vigencia: $("#inicio_vigencia").val(),
            fim_vigencia: $("#fim_vigencia").val(),
            placa: $("#placa").val(),
            valor: $("#valor").val(),
            client_id: $("#client_id").val()
        };
        //console.log($pol);
        $.post("/api/polices", pol, function(data) {
            police = JSON.parse(data);
            linha = montarLinha(police);
            $('#tabelaPolices>tbody').append(linha);
        });
    }

    function salvarPolice() {
        pol = {
            id: $("#id").val(),
            inicio_vigencia: $("#inicio_vigencia").val(),
            fim_vigencia: $("#fim_vigencia").val(),
            placa: $("#placa").val(),
            valor: $("#valor").val(),
            client_id: $("#client_id").val()
        };
        $.ajax({
            type: "PUT",
            url: "/api/polices/" + pol.id,
            context: this,
            data: pol,
            success: function(data) {
                pol = JSON.parse(data);
                linhas = $("#tabelaPolices>tbody>tr");
                e = linhas.filter( function(i, e) {
                    return ( e.cells[0].textContent == pol.id );
                });
                if (e) {
                    e[0].cells[0].textContent = pol.id;
                    e[0].cells[1].textContent = pol.inicio_vigencia;
                    e[0].cells[2].textContent = pol.fim_vigencia;
                    e[0].cells[3].textContent = pol.placa;
                    e[0].cells[4].textContent = pol.valor;
                    e[0].cells[5].textContent = pol.client_id;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    $("#formPolice").submit( function(event){
        event.preventDefault();
        if ($("#id").val() != '')
            salvarPolice();
        else
            criarPolice();

        $("#dlgPolices").modal('hide');
    });

    $(function() {
        carregarClients();
        carregarPolices();
    })
</script>
@endsection
