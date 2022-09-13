<div class="modal fade" id="modalDeleteToken{{ $token['id'] }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTokenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteTokenLabel">Excluir Token</h5>
                <a href="" class="d-flex justify-content-end" data-bs-dismiss="modal" aria-label="Close">x</a>
            </div>
            <div class="modal-body">
                <p>Excluir token <strong>{{ $token['name'] }}</strong> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-outline-secondary" style="background-color: #5C636A;">
                    <a class="button-delete-custom" style="color: #fff;" title="Deletar" href="{{ route('gerenciar.tokens.remover', [$token['id'], $token['tokenable_id']]) }}">Sim</a>
                </button>
            </div>
        </div>
    </div>
</div>
