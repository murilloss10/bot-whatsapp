@include('layouts.cabecalho')

@section('title', 'Bot Whatsapp | Agentes')

    <div class="container">
        <div class="row">
            <h1> Novo agente </h1>
            <form action="{{ route('agente.novo.salvar', $project_name) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="parent" class="form-label">Id Projeto</label>
                    <input type="text" class="form-control" id="parent" name="parent" value="{{ isset($agente_parent) ? $agente_parent : '' }}">
                    <div id="parent" class="form-text">O projeto deste agente. Format: projects/Project_ID</div>
                </div>
                <div class="mb-3">
                    <label for="display_name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="display_name" name="display_name" value="{{ isset($agente_name) ? $agente_name : '' }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ isset($agente_description) ? $agente_description : '' }}">
                </div>
                <div class="mb-3">
                    <label for="avatar_uri" class="form-label">Avatar</label>
                    <input type="text" class="form-control" id="avatar_uri" name="avatar_uri" value="{{ isset($agente_avatar_uri) ? $agente_avatar_uri : '' }}">
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>

@include('layouts.rodape')
