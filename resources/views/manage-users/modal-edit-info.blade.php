<div class="modal fade" id="modalEditar{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarLabel">Editar Informações</h5>
                <a href="" class="d-flex justify-content-end" data-bs-dismiss="modal" aria-label="Close">x</a>
            </div>
            <div class="modal-body">
                <form action="{{ route('gerenciar.usuarios.editar', $user->id) }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="col-form-label">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-secondary" style="color: black;">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
