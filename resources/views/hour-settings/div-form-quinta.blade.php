<div class="mb-3 col-md-3">
    <center><label class="form-label">Quinta</label></center>
    @if( isset($day5) )
        <div class="d-flex justify-content-end mr-4">
            <a href="" data-bs-toggle="modal" data-bs-target="#modalDeleteSettingDay{{ $day5->id }}" title="Deletar Dia">
                <span class="material-icons">delete</span>
            </a>
            @include('hour-settings.modal-delete-setting-day5')
        </div>
    @endif

    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day5_start" class="col-form-label">Início</label>
        </div>
        <div class="col-md-9">
            @if( isset($day5) )
                <input type="time" id="day5_start" class="form-control" name="day5_start" value="{{ $day5->start_hour }}">
            @else
                <input type="time" id="day5_start" class="form-control" name="day5_start">
            @endif
        </div>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day5_end" class="col-form-label">Fim</label>
        </div>
        <div class="col-md-9">
            @if( isset($day5) )
                <input type="time" id="day5_end" class="form-control" name="day5_end" value="{{ $day5->end_hour }}">
            @else
                <input type="time" id="day5_end" class="form-control" name="day5_end">
            @endif
        </div>
    </div>
</div>
