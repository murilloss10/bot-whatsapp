<div class="mb-3 col-md-3">
    <center><label class="form-label">Quarta</label></center>
    @if( isset($day4) )
        <div class="d-flex justify-content-end mr-4">
            <a href="" data-bs-toggle="modal" data-bs-target="#modalDeleteSettingDay{{ $day4->id }}" title="Deletar Dia">
                <span class="material-icons">delete</span>
            </a>
            @include('hour-settings.modal-delete-setting-day4')
        </div>
    @endif

    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day4_start" class="col-form-label">Início</label>
        </div>
        <div class="col-md-9">
            @if( isset($day4) )
                <input type="time" id="day4_start" class="form-control" name="day4_start" value="{{ $day4->start_hour }}">
            @else
                <input type="time" id="day4_start" class="form-control" name="day4_start">
            @endif
        </div>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day4_end" class="col-form-label">Fim</label>
        </div>
        <div class="col-md-9">
            @if( isset($day4) )
                <input type="time" id="day4_end" class="form-control" name="day4_end" value="{{ $day4->end_hour }}">
            @else
                <input type="time" id="day4_end" class="form-control" name="day4_end">
            @endif
        </div>
    </div>
</div>
