<div class="modal fade" id="modalDeleteSettingDay{{ $day6->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteSettingDayLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteSettingDayLabel">Excluir Registro do Dia</h5>
                <a href="" class="d-flex justify-content-end" data-bs-dismiss="modal" aria-label="Close">x</a>
            </div>
            <div class="modal-body">
                <p>Excluir as definições de horários de <strong>{{ $day6->day_name }}</strong> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-outline-secondary" style="background-color: #5C636A;">
                    <a class="button-delete-custom" style="color: #fff;" title="Deletar" href="{{ route('conta.horario-de-atendimento.remover', $day6->id) }}">Sim</a>
                </button>
            </div>
        </div>
    </div>
</div>
