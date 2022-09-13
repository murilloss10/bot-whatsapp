<div class="modal fade" id="modalCreateToken{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalCreateTokenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTokenLabel">Novo Token</h5>
                <a href="" class="d-flex justify-content-end" data-bs-dismiss="modal" aria-label="Close">x</a>
            </div>
            <div class="modal-body">
                <form action="{{ route('gerenciar.tokens.criar') }}" id="form-create-token" method="post">
                    @csrf
                    <p>O token a ser criado aparece uma única vez, guarde e copie o seu token completo.</p><br>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" hidden>
                    <p>Digite sua senha para gerar novo token.</p>
                    <input class="form-control" type="password" id="password" name="password">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="form-create-token" class="btn btn-outline-secondary" value="Submit">Criar</button>
            </div>
        </div>
    </div>
</div>
