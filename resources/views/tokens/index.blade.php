@extends('layouts.app-new')

@section('title', 'Gerenciar Tokens')

@section('content')

    <div class="container-lg pt-3">
        <div class="row align-items-center bg-white rounded-3 p-4">
            <h2 class="pb-3"><strong>Todos os Tokens</strong></h2>

            @if( isset($rm_token))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $rm_token }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @include('tokens.table')
        </div>
    </div>

@endsection
