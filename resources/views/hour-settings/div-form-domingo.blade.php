<div class="mb-3 col-md-3">
    <center><label class="form-label">Domingo</label></center>
    @if( isset($day1) )
        <div class="d-flex justify-content-end mr-4">
            <a href="" data-bs-toggle="modal" data-bs-target="#modalDeleteSettingDay{{ $day1->id }}" title="Deletar Dia">
                <span class="material-icons">delete</span>
            </a>
            @include('hour-settings.modal-delete-setting-day1')
        </div>
    @endif

    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day1_start" class="col-form-label">Início</label>
        </div>
        <div class="col-md-9">
            @if( isset($day1) )
                <input type="time" id="day1_start" class="form-control" name="day1_start" value="{{ $day1->start_hour }}">
            @else
                <input type="time" id="day1_start" class="form-control" name="day1_start">
            @endif
        </div>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day1_end" class="col-form-label">Fim</label>
        </div>
        <div class="col-md-9">
            @if( isset($day1) )
                <input type="time" id="day1_end" class="form-control" name="day1_end" value="{{ $day1->end_hour }}">
            @else
                <input type="time" id="day1_end" class="form-control" name="day1_end">
            @endif
        </div>
    </div>
</div>
