@extends('layouts.app-new')

@section('title', 'Gerenciar Usuários')

@section('content')

    <div class="container-lg pt-3">
        <div class="row align-items-center bg-white rounded-3 p-4">
            <h2 class="pb-3"><strong>Gerenciar Usuários</strong></h2>

            @if( isset($success))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $success }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if( isset($error))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @include('manage-users.table')
        </div>
    </div>

@endsection
