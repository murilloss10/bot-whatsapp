<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th class="col-sm-1">Id</th>
            <th class="col-sm-3">Nome</th>
            <th class="col-sm-2">Email</th>
            <th class="col-sm-1">Time</th>
            <th class="col-sm-1">Tipo</th>
            <th class="col-sm-1">Status</th>
            <th class="col-sm-3">Opções</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->current_team_id }}</td>
                <td>{{ $user->type }}</td>
                <td>{{ $user->deleted_at == null ? 'Ativo' : 'Inativo' }}</td>
                <td>
                    <a href="" data-bs-toggle="modal" data-bs-target="#modalView{{ $user->id }}">
                        <span class="material-icons" style="font-size: 1.2rem" title="Ver detalhes">visibility</span>
                    </a>
                    <!-- Modal Detalhes -->
                    @include('manage-users.modal-details')

                    @if($user->deleted_at != null)
                        <span class="material-icons" style="font-size: 1.3rem; padding-left: .1rem; color: #d0d6d1;" title="Redefinir senha">password</span>

                        <a href="{{ route('gerenciar.usuarios.ativar', $user->id) }}">
                            <span class="material-icons" style="font-size: 1.5rem; padding-left: .1rem;" title="Ativar">toggle_on</span>
                        </a>

                        <span class="material-icons" style="font-size: 1.4rem; padding-left: .1rem; color: #d0d6d1;" title="Editar">edit_note</span>
                    @else
                        <a href="" data-bs-toggle="modal" data-bs-target="#modalResetPassword{{ $user->id }}">
                            <span class="material-icons" style="font-size: 1.3rem; padding-left: .1rem;" title="Redefinir senha">password</span>
                        </a>
                        <!-- Modal Resetar Senha -->
                        @include('manage-users.modal-reset-password')

                        <a href="{{ route('gerenciar.usuarios.desativar', $user->id) }}">
                            <span class="material-icons" style="font-size: 1.5rem; padding-left: .1rem;" title="Desativar">toggle_off</span>
                        </a>

                        <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $user->id }}">
                            <span class="material-icons" style="font-size: 1.4rem; padding-left: .1rem;" title="Editar">edit_note</span>
                        </a>
                        <!-- Modal Editar -->
                        @include('manage-users.modal-edit-info')
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
