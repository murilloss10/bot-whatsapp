@include('layouts.cabecalho')

@section('title', 'Bot Whatsapp | Intent')

<div class="container">
    <div class="row">
        <h1>Lista de Intents</h1>
        <a id="add_nova_intent" class="mb-2" href="{{ route('intent.nova', $projeto) }}" title="Criar nova intent"><ion-icon name="person-add-outline"></ion-icon> Criar</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach($intents as $intent)
                    <tr>
                        <td>{{ $intent->id_intent }}</td>
                        <td>{{ $intent->displayName }}</td>
                        <td>
                            <a href="" title="Deletar"><ion-icon name="trash-outline"></ion-icon></a>
                            <a href="{{ route('intent.editar', [$projeto, $intent->id_intent]) }}" title="Abrir"><ion-icon name="open-outline"></ion-icon></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    ion-icon {
        font-size: 22px;
    }
    #add_nova_intent {
        font-size: 22px;
        text-decoration: none;
    }
</style>

@include('layouts.rodape')
