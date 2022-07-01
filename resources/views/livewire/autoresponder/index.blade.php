@extends('layouts.app-new')

@section('title', 'Autoresponder')

@section('content')

    <div class="container-lg pt-3">
        <div class="row align-items-center bg-white rounded-3 p-4">
            <p>Parágrafo Teste </p>
            <form method="POST" action="">
                @csrf
                <input type="text" value="Murillo">
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>

@endsection
