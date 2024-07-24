@extends('baseLayout')

@section('conteudo-pagina')
<div style="width: 100%">
    <div class="form-row" style="margin-top: 30px; margin-left: 2%; margin-right:2%">
        <div class="col-12" style="border: solid; margin-bottom:50px">
            <p style="font-size:30px">Cadastro de Usuario</p>
        </div>

        <div class="col-12" style="border: solid; margin-bottom:50px">
            <form class="needs-validation" novalidate>
                @csrf 
                <div class="form-row">
                    <div class="col-6">
                        <label for="nomeUsuario">Nome</label>
                        <input type="text" id="nm_usuario" class="form-control" id="nomeUsuario" aria-describedby="nameHelp" placeholder="Digite seu nome" required>
                        <div class="invalid-feedback">
                            Este campo e obrigatorio.
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="emailUsuario">Email</label>
                        <input type="email" id="email_usuario" class="form-control" id="emailUsuario" aria-describedby="emailHelp" placeholder="Digite seu email" required>
                        <div class="invalid-feedback">
                            Este campo e obrigatorio.
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="id_situacao">Situacao</label>
                            <select class="form-control" id="id_situacao"  id="id_situacao">
                            <option value="0">Ativo</option>
                            <option value="1">Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="data_admicao">Data Admissao</label>
                        <input id="data_admicao" class="form-control" type="date" required/>
                        <div class="invalid-feedback">
                            Este campo e obrigatorio.
                        </div>
                    </div>

                    <div class="col-12" style="margin-top:20px; display: flex; justify-content: center">
                        <button type="button" class="btn btn-primary" onclick="adicionarDados()" style="width: 20%">Adicionar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12" style="border: solid; margin-bottom:50px" id="container">
        </div>
    </div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        buscarDados();
        new DataTable('#example');
    });

function limparCampos() {
    $("#nm_usuario").val("");
    $("#email_usuario").val("");
    $("#data_admicao").val("");
}

function buscarDados() {
    console.log('entrou na funcao buscar');

    var csrf_token = $('meta[name="csrf-token"]').attr("content");
    console.log(csrf_token);

    $.ajax({
        url: "/usuario/buscar-dados",
        method: "GET",
        data: {
            _token: csrf_token,
        },
        success: function (response) {
            console.log(response);
            $("#container").html(response);
            limparCampos();
        },
        error: function (error) {
            console.log(response);
        },
    });
}

function adicionarDados() {
    console.log('entrou na funcao adicionar');
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
        console.log('entrou no ajax');
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
                console.log(response);
                buscarDados();
                limparCampos();
                Swal.fire({
                    title: 'Usuario inserido com sucesso!',
                    icon: "success"
                })
            },
            error: function (error) {
                console.log(error);
                Swal.fire({
                    title: 'Erro ao inserir Usuario.',
                    icon: "error"
                })
            },
        });
    }
}

</script>