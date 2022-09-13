@extends('layouts.app-new')

@section('title', 'Meus Tokens')

@section('content')

    <div class="container-lg pt-3">
        <div class="row align-items-center bg-white rounded-3 p-4">
            <h2 class="pb-3"><strong>Meus Tokens</strong></h2>
            <div class="d-flex justify-content-end">
                <a href="" data-bs-toggle="modal" data-bs-target="#modalCreateToken{{ $user->id }}">
                    <span class="material-icons" style="font-size: 1.3rem; align-items: end">note_add</span> Novo Token
                </a>
                @include('tokens.modal-create-token')
            </div>

            @if( isset($token))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Seu novo token: <strong id="token" style="font-size: .9rem;">Bearer {{ $token }}</strong>
                    <span class="material-icons" style="font-size: 1.1rem; cursor: pointer;" onclick="copyToClickBoard()" title="Copiar token">file_copy</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if( isset($rm_token))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $rm_token }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if( isset($erro) )
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ $erro }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @include('tokens.table')
        </div>
    </div>

    <script>
        function copyToClickBoard(){
            var content = document.getElementById('token').innerHTML;

            navigator.clipboard.writeText(content)
                .then(() => {
                    console.log('Texto copiado para a área de trabalho.')
                })
                .catch(err => {
                    console.log('Erro à copiar texto.', err);
                })
        }
    </script>

@endsection
