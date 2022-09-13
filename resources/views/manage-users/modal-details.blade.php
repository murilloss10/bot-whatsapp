<div class="modal fade" id="modalView{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewLabel">Informações do Usuário</h5>
                <a href="" class="d-flex justify-content-end" data-bs-dismiss="modal" aria-label="Close">x</a>
            </div>
            <div class="modal-body">
                <p><strong>Id:</strong> {{ $user->id }}</p>
                <p><strong>Nome:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Time:</strong> {{ $user->current_team_id }}</p>
                <p><strong>Credencial:</strong> {{ $user->credentials_file }}</p>
                <p><strong>Tipo:</strong> {{ $user->type }}</p>
                <p><strong>Criado:</strong> {{ $user->created_at }}</p>
                <p><strong>Atualizado:</strong> {{ $user->updated_at }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
