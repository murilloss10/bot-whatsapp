@extends('layouts.app-new')

@section('title', 'Página Inicial')

@section('content')

    <div class="container-lg pt-3">
        <div class="row align-items-center bg-white rounded-3 p-4">
            <center><h1>Olá, {{ auth()->user()->name }}</h1></center>
        </div>
    </div>

@endsection
