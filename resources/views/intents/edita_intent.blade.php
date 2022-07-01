@include('layouts.cabecalho')

@section('title', 'Bot Whatsapp | Intent')

<div class="container">
    <div class="row">
        <h1>Nova Intent</h1>
        <a id="lista_intents" class="mb-2" href="{{ route('intent.lista', $projeto) }}" title="Ver lista de Intents"><ion-icon name="list-outline"></ion-icon> Intents</a>
        <form action="" method="POST">
            @csrf

            <div class="mb-3">
                <label for="display_name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="display_name" name="display_name" value="{{ $intent->display_name }}" required>
            </div>
            <div class="mb-3">
                <div class="row">
                    <label class="form-label">Contexto de Saída</label>
                    <div class="col-2">
                        <input type="number" class="form-control" id="output_context_lifespan_count" name="output_context_lifespan_count" placeholder="Lifespan">
                    </div>
                    <div class="col-10">
                        <input type="text" class="form-control" id="output_context_name" name="output_context_name" placeholder="Nome">
                    </div>
                </div>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="webhook_state" name="webhook_state" checked>
                <label class="form-check-label" for="webhook_state">Ativar chamada de webhook para esta intent</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_fallback" name="is_fallback">
                <label class="form-check-label" for="is_fallback">Is Fallback</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="end_interaction" name="end_interaction">
                <label class="form-check-label" for="end_interaction">Definir Intent como fim de conversa</label>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>

<style>
    #lista_intents {
        font-size: 22px;
        text-decoration: none;
    }
</style>

@include('layouts.rodape')
