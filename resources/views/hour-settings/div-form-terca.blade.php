<div class="mb-3 col-md-3">
    <center><label class="form-label">Terça</label></center>
    @if( isset($day3) )
        <div class="d-flex justify-content-end mr-4">
            <a href="" data-bs-toggle="modal" data-bs-target="#modalDeleteSettingDay{{ $day3->id }}" title="Deletar Dia">
                <span class="material-icons">delete</span>
            </a>
            @include('hour-settings.modal-delete-setting-day3')
        </div>
    @endif

    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day3_start" class="col-form-label">Início</label>
        </div>
        <div class="col-md-9">
            @if( isset($day3) )
                <input type="time" id="day3_start" class="form-control" name="day3_start" value="{{ $day3->start_hour }}">
            @else
                <input type="time" id="day3_start" class="form-control" name="day3_start">
            @endif
        </div>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day3_end" class="col-form-label">Fim</label>
        </div>
        <div class="col-md-9">
            @if( isset($day3) )
                <input type="time" id="day3_end" class="form-control" name="day3_end" value="{{ $day3->end_hour }}">
            @else
                <input type="time" id="day3_end" class="form-control" name="day3_end">
            @endif
        </div>
    </div>
</div>
