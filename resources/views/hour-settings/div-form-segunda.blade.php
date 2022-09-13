<div class="mb-3 col-md-3">
    <center><label class="form-label">Segunda</label></center>
    @if( isset($day2) )
        <div class="d-flex justify-content-end mr-4">
            <a href="" data-bs-toggle="modal" data-bs-target="#modalDeleteSettingDay{{ $day2->id }}" title="Deletar Dia">
                <span class="material-icons">delete</span>
            </a>
            @include('hour-settings.modal-delete-setting-day2')
        </div>
    @endif

    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day2_start" class="col-form-label">Início</label>
        </div>
        <div class="col-md-9">
            @if( isset($day2) )
                <input type="time" id="day2_start" class="form-control" name="day2_start"  value="{{ $day2->start_hour }}">
            @else
                <input type="time" id="day2_start" class="form-control" name="day2_start">
            @endif
        </div>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day2_end" class="col-form-label">Fim</label>
        </div>
        <div class="col-md-9">
            @if( isset($day2) )
                <input type="time" id="day2_end" class="form-control" name="day2_end" value="{{ $day2->end_hour }}">
            @else
                <input type="time" id="day2_end" class="form-control" name="day2_end">
            @endif
        </div>
    </div>
</div>
