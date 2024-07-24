<table class="table table-striped" id="table_content">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Situacao</th>
        <th scope="col">Admissao</th>
      </tr>
    </thead>
    <tbody>
        @forelse($dados as $objUser)
            @if($objUser->id_situacao == 0)
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
            </tr>
        @empty 
            <tr>
                <th scope="row"></th>
                <td colspan="5" style="text-align: center">Nenhum dado econtrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>