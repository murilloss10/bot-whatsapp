@extends('layouts.app-new')

@section('title', 'Carregar Credencial')

@section('content')

    <div class="container-lg pt-3">
        <div class="row bg-white rounded-3 p-4">
            <h2><strong>Carregar arquivo de configurações</strong></h2>

            @if (isset($file_uploaded))
                <p class="pt-4">Dados do arquivo submetido</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nome do Projeto</th>
                            <th scope="col">Email Cliente</th>
                            <th scope="col">Id Cliente</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $file_uploaded->project_id }}</td>
                            <td>{{ $file_uploaded->client_email }}</td>
                            <td>{{ $file_uploaded->client_id }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @else

            @endif

            <p class="pt-5"><strong>Submeter novo arquivo</strong></p>
            <form class="" method="POST" action="{{ route('conta.credencial.salvar') }}" enctype="multipart/form-data">
                @csrf

                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload"
                           name="file-credential" accept=".json">
                    <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Salvar</button>
                </div>

            </form>
        </div>
    </div>


@endsection
