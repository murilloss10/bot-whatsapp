<div class="modal fade" id="modalResetPassword{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalResetPasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalResetPasswordLabel">Resetar Senha</h5>
                <a href="" class="d-flex justify-content-end" data-bs-dismiss="modal" aria-label="Close">x</a>
            </div>
            <div class="modal-body">
                <p>Resetar senha do usuário {{ $user->name }} ?</p>
                <p>Nova senha será "12345678".</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-outline-secondary">
                    <a class="button-delete-custom" title="Resetar" href="{{ route('gerenciar.usuarios.resetar-senha', $user->id) }}">Sim</a>
                </button>
            </div>
        </div>
    </div>
</div>
