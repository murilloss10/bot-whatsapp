<div class="mb-3 col-md-3">
    <center><label class="form-label">Sábado</label></center>
    @if( isset($day7) )
        <div class="d-flex justify-content-end mr-4">
            <a href="" data-bs-toggle="modal" data-bs-target="#modalDeleteSettingDay{{ $day7->id }}" title="Deletar Dia">
                <span class="material-icons">delete</span>
            </a>
            @include('hour-settings.modal-delete-setting-day7')
        </div>
    @endif

    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day7_start" class="col-form-label">Início</label>
        </div>
        <div class="col-md-9">
            @if( isset($day7) )
                <input type="time" id="day7_start" class="form-control" name="day7_start" value="{{ $day7->start_hour }}">
            @else
                <input type="time" id="day7_start" class="form-control" name="day7_start">
            @endif
        </div>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day7_end" class="col-form-label">Fim</label>
        </div>
        <div class="col-md-9">
            @if( isset($day7) )
                <input type="time" id="day7_end" class="form-control" name="day7_end" value="{{ $day7->end_hour }}">
            @else
                <input type="time" id="day7_end" class="form-control" name="day7_end">
            @endif
        </div>
    </div>
</div>
