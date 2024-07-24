@extends('baseLayout')

@section('conteudo-pagina')
<div style="width: 100%">
    <div class="form-row" style="margin-top: 30px; margin-left: 2%; margin-right:2%">
        <div class="col-12" style=" margin-bottom:5px">
            <p style="font-size:25px">Cadastro de Usuário</p>
        </div>

        <div class="col-12 card shadow" style="margin-bottom:50px; padding: 10px">
            <form class="needs-validation" novalidate>
                @csrf 
                <div class="form-row">
                    <div class="col-6">
                        <label for="nomeUsuario">Nome</label>
                        <input type="text" id="nm_usuario" class="form-control" id="nomeUsuario" aria-describedby="nameHelp" placeholder="Digite seu nome" required>
                        <div class="invalid-feedback"> Este campo é obrigatorio.</div>
                    </div>

                    <div class="col-6">
                        <label for="emailUsuario">Email</label>
                        <input type="email" id="email_usuario" class="form-control" id="emailUsuario" aria-describedby="emailHelp" placeholder="Digite seu email" required>
                        <div class="invalid-feedback"> Este campo é obrigatorio. </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="id_situacao">Situação</label>
                            <select class="form-control" id="id_situacao"  id="id_situacao">
                            <option value="1">Ativo</option>
                            <option value="2">Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="data_admicao">Data Admissão</label>
                        <input id="data_admicao" class="form-control" type="date" required/>
                        <div class="invalid-feedback">
                            Este campo é obrigatório.
                        </div>
                    </div>

                    <div class="col-12" style="margin-top:20px; display: flex; justify-content: center">
                        <button type="button" class="btn btn-primary" onclick="adicionarDados()" style="width: 20%">Adicionar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12" style=" margin-bottom:10px">
            <div class="form-row">
                <div class="col-3">
                    <input type="text" id="filtro_texto" class="form-control" id="nomeUsuario" aria-describedby="filtroHelp" placeholder="Filtro">
                </div>
                <div class="col-2">
                    <input id="filtro_data" class="form-control" type="date"/>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <select class="form-control" id="filtro_situacao"  id="filtro_situacao">
                        <option value="">Todos</option>
                        <option value="1">Ativo</option>
                        <option value="2">Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-primary" style="width: 100%" onclick="buscarDados()">Filtrar</button>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-primary" style="width: 100%" onclick="limparFiltros()">Limpar</button>
                </div>
            </div>
        </div>

        <div class="col-12" style="margin-bottom:50px" id="container">
        </div>
    </div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        buscarDados();
    });

function limparCampos() {
    $("#nm_usuario").val("");
    $("#email_usuario").val("");
    $("#data_admicao").val("");
}

function limparFiltros() {
    $("#filtro_texto").val("");
    $("#filtro_data").val("");
    $("#filtro_situacao").val("");
    buscarDados();
}

function buscarDados() {
    var csrf_token     = $('meta[name="csrf-token"]').attr("content");
    var filtroTexto    = $('#filtro_texto').val();
    var filtroData     = $('#filtro_data').val();
    var filtroSituacao = $('#filtro_situacao').val();

    $.ajax({
        url: "/usuario/buscar-dados",
        method: "GET",
        data: {
            _token: csrf_token,
            filtroTexto: filtroTexto,
            filtroData: filtroData,
            filtroSituacao: filtroSituacao
        },
        success: function (response) {
            $("#container").html(response);
            if(filtroTexto == null && filtroData == null && filtroSituacao == null) {
                limparCampos();
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function adicionarDados() {
    var csrf_token = $('meta[name="csrf-token"]').attr("content");

    var objNome =  document.getElementById('nm_usuario');
    var objEmail = document.getElementById('email_usuario');
    var objSituacao = document.getElementById('id_situacao');
    var objData = document.getElementById('data_admicao');

    const arrCampos = [objNome, objEmail, objSituacao, objData];

    var teste = 0;

    arrCampos.forEach((obj, index) => {
        if (obj.value.trim() === '') {
            obj.classList.add('is-invalid');
            event.preventDefault();
            teste = 1;
        } else {
            obj.classList.remove('is-invalid');
        }
    });
    
    if(teste != 1) {
        $.ajax({
            url: "/usuario/adicionar-dados",
            method: "POST",
            data: {
                _token: csrf_token,
                nm_usuario: objNome.value,
                email_usuario: objEmail.value,
                id_situacao: objSituacao.value,
                dt_admicao: objData.value,
            },
            success: function (response) {
                buscarDados();
                limparCampos();
                Swal.fire({
                    title: 'Usuário inserido com sucesso!',
                    icon: "success"
                })
            },
            error: function (error) {
                console.log(error);
                Swal.fire({
                    title: 'Erro ao inserir Usuário.',
                    icon: "error"
                })
            },
        });
    }
}

function ExcluirDados(id) {
    Swal.fire({
        title: 'Deseja excluir este Usuário?',
        showDenyButton: true,
        confirmButtonText: 'Sim',
        denyButtonText: 'Não',
        customClass: {
            actions: 'my-actions',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        },
    }).then((result) => {
        if (result.isConfirmed) {
            var csrf_token = $('meta[name="csrf-token"]').attr("content");
            
            $.ajax({
                url: "/usuario/excluir-dados",
                method: "GET",
                data: {
                    _token: csrf_token,
                    id: id
                },
                success: function (response) {
                    buscarDados();
                    Swal.fire({
                        title: 'Usuário excluído com sucesso!',
                        icon: "success"
                    })
                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        title: 'Erro ao excluir Usuário.',
                        icon: "error"
                    })
                },
            });
        }
    })
}
</script>