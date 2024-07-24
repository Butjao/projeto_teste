<table class="table table-striped" id="table_content">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Situacao</th>
            <th scope="col">Admissao</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $objUser)
            @if($objUser->id_situacao == 1)
                @php
                    $idSituacao = 'Ativo';
                @endphp
            @else
                @php
                    $idSituacao = 'Inativo';
                @endphp
            @endif
            <tr>
                <th scope="row">{{$objUser->id}}</th>
                <td>{{$objUser->nome}}</td>
                <td>{{$objUser->email}}</td>
                <td>{{$idSituacao}}</td>
                <td>{{$objUser->dt_admissao}}</td>
                <td>
                    <i style="cursor:pointer" class = "bold-on-hover" onclick="ExcluirDados({{$objUser->id}})">Excluir</i>
                </td>
            </tr>
        @empty 
            <tr>
                <th scope="row"></th>
                <td colspan="5" style="text-align: center">Nenhum dado econtrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>