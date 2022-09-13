<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Id Usuário</th>
            <th>Nome</th>
            <th>Permissões</th>
            <th>Criado</th>
            <th>Último acesso</th>
            <th>Opções</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tokens as $token)
            <tr>
                <td>{{ $token['tokenable_id'] }}</td>
                <td>{{ $token['name'] }}</td>
                <td>{{ $token['abilities'] == '["*"]' ? 'Total' : $token['abilities'] }}</td>
                <td>{{ $token['created_at'] }}</td>
                <td>{{ $token['last_used_at'] }}</td>
                <td>
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalDeleteToken{{ $token['id'] }}">
                        <span class="material-icons">delete</span>
                    </a>
                    @include('tokens.modal-delete-token')
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
