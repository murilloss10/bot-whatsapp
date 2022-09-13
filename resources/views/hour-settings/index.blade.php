@extends('layouts.app-new')

@section('title', 'Configuração de Horários')

@section('content')

    <div class="container-lg pt-3">
        <div class="row align-items-center bg-white rounded-3 p-4">
            <h2 class="pb-3"><strong>Configuração de Horários</strong></h2>

            @if( isset($success) )
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $success }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if( isset($error) )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('conta.horario-de-atendimento.salvar') }}" method="post">
                @csrf

                <div class="row">
                    @include('hour-settings.div-form-domingo')
                    @include('hour-settings.div-form-segunda')
                    @include('hour-settings.div-form-terca')
                    @include('hour-settings.div-form-quarta')
                    @include('hour-settings.div-form-quinta')
                    @include('hour-settings.div-form-sexta')
                    @include('hour-settings.div-form-sabado')
                </div>

                <button type="submit" class="btn btn-outline-secondary mt-5">Salvar</button>
            </form>

        </div>
    </div>

@endsection
