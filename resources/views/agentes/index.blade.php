@include('layouts.cabecalho')

@section('title', 'Bot Whatsapp | Agentes')

    <div class="container">
        <div class="row">
            <h1 class="col-4"> Agente: {{ $agente_nome }}</h1><a class="col-2" href="{{ route('agente.novo', $projeto) }}">Atualizar</a>
        </div>

    </div>

@include('layouts.rodape')
