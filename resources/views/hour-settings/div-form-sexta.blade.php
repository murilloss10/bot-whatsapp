<div class="mb-3 col-md-3">
    <center><label class="form-label">Sexta</label></center>
    @if( isset($day6) )
        <div class="d-flex justify-content-end mr-4">
            <a href="" data-bs-toggle="modal" data-bs-target="#modalDeleteSettingDay{{ $day6->id }}" title="Deletar Dia">
                <span class="material-icons">delete</span>
            </a>
            @include('hour-settings.modal-delete-setting-day6')
        </div>
    @endif

    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day6_start" class="col-form-label">Início</label>
        </div>
        <div class="col-md-9">
            @if( isset($day6) )
                <input type="time" id="day6_start" class="form-control" name="day6_start" value="{{ $day6->start_hour }}">
            @else
                <input type="time" id="day6_start" class="form-control" name="day6_start">
            @endif
        </div>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <label for="day6_end" class="col-form-label">Fim</label>
        </div>
        <div class="col-md-9">
            @if( isset($day6) )
                <input type="time" id="day6_end" class="form-control" name="day6_end" value="{{ $day6->end_hour }}">
            @else
                <input type="time" id="day6_end" class="form-control" name="day6_end">
            @endif
        </div>
    </div>
</div>
