<?php

use App\Http\Controllers\Admin\ConnectionAutoresponderController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\MessageHistoriesController;
use App\Http\Controllers\PaginaInicialController;
use App\Http\Controllers\TokensController;
use App\Http\Controllers\Usuario\TimeSettingsController;
use App\Http\Controllers\Usuario\UploadCredentialFileController;
use App\Repositories\MessageHistoryRepository;
use Google\Cloud\Dialogflow\V2\IntentsClient;
use Illuminate\Support\Facades\Route;


//Route::get('/', function () {
//    //posso adicionar uma página para fazer upload do arquivo .json, ler ele e salvar as informações no banco de dados
////    $test = [
////        'credentials' => json_decode(file_get_contents('../teste-jwyo-aed37d258822.json'), true)
////    ];
////    return $test['credentials'];
//    //teste
//    $config = [
//        'keyFilePath' => '../teste-jwyo-aed37d258822.json',
//        'projectId' => 'teste-jwyo',
//    ];
//    //teste 2
//    $test = array('credentials' => '../teste-jwyo-aed37d258822.json');
//    //nova sessão
//    $sessionsClient = new \Google\Cloud\Dialogflow\V2\SessionsClient($test);
//    $session = $sessionsClient->sessionName($config['projectId'], '12345678');
//    //criando texto input
//    $textInput = new \Google\Cloud\Dialogflow\V2\TextInput();
//    $textInput->setText('oi');
//    $textInput->setLanguageCode('pt-BR');
//    //criando query input
//    $queryInput = new \Google\Cloud\Dialogflow\V2\QueryInput();
//    $queryInput->setText($textInput);
//    // get response and relevant info
//    $response = $sessionsClient->detectIntent($session, $queryInput);
//    $queryResult = $response->getQueryResult();
//    $queryText = $queryResult->getQueryText();
//    $intent = $queryResult->getIntent();
//    $displayName = $intent->getDisplayName();
//    $confidence = $queryResult->getIntentDetectionConfidence();
//    $fulfilmentText = $queryResult->getFulfillmentText();
//     // output relevant info
//    print(str_repeat("=", 20) . PHP_EOL);
//    printf('Query text: %s' . PHP_EOL, $queryText);
//    printf('Detected intent: %s (confidence: %f)' . PHP_EOL, $displayName, $confidence);
//    print(PHP_EOL);
//    printf('Fulfilment text: %s' . PHP_EOL, $fulfilmentText);
//    $sessionsClient->close();
////    dd($queryInput);
//});

Route::get('/teste1', [\App\Http\Controllers\Admin\ConexaoApiGoogleController::class, 'screenMessage'])->name('mensagem.tela');
Route::post('/teste1/enviar', [\App\Http\Controllers\Admin\ConexaoApiGoogleController::class, 'sendMessage'])->name('mensagem.enviar');

//criar uma página para cada cliente do tipo json, igual ao json criado, com a diferença de que vai estar conectado diretamente no app com um link da página
Route::prefix('projeto/{projeto}/agente/')->controller(\App\Http\Controllers\Admin\AgenteController::class)->name('agente.')->group(function () {
    Route::get('/', 'viewAgente')->name('index');
    Route::get('novo', 'viewNovoAgente')->name('novo');
    Route::post('novo/salvar', 'criaNovoAgente')->name('novo.salvar');
    Route::get('deletar', 'deletaAgente')->name('deletar');
});

Route::prefix('projeto/{projeto}/intent/')->controller(\App\Http\Controllers\Admin\IntentController::class)->name('intent.')->group(function () {
//    Route::get('/', '')->name('index');
    Route::get('detalhes', function () {//provisório
        $intentsClient = new \App\Services\IntentService('../teste-jwyo-aed37d258822.json');
        $formattedName = $intentsClient->getIntent('teste-jwyo');
        $response = $intentsClient->getIntent($formattedName);
        dd($formattedName);
    })->name('detalhes');
    Route::get('listar', 'listaTodasIntents')->name('lista');
    Route::get('nova', 'viewNovaIntent')->name('nova');
    Route::post('nova/salvar', 'criaNovaIntent')->name('nova.salvar');
    Route::get('{id_intent}/editar', 'viewEditaIntent')->name('editar');
});


/**
 * Rotas autenticadas
 */
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    /** Página Inicial */
    Route::get('/', [PaginaInicialController::class, 'home'])->name('dashboard');

    /** Configurações de usuário */
    Route::prefix('/conta')->name('conta.')->group(function () {
        Route::get('/credencial', [UploadCredentialFileController::class, 'index'])->name('credencial');
        Route::post('/credencial/salvar', [UploadCredentialFileController::class, 'store'])->name('credencial.salvar');
        Route::get('/horario-de-atendimento', [TimeSettingsController::class, 'index'])->name('horario-de-atendimento');
        Route::post('/horario-de-atendimento/salvar', [TimeSettingsController::class, 'store'])->name('horario-de-atendimento.salvar');
        Route::get('/horario-de-atendimento/deletar/{id}', [TimeSettingsController::class, 'delete_day'])->name('horario-de-atendimento.remover');
    });

    /** Gerenciar usuários */
    Route::prefix('/gerenciar/usuarios')->name('gerenciar.usuarios.')->group(function (){
        Route::get('/', [ManageUsersController::class, 'index'])->name('listar');
        Route::get('/{id}/resetar-senha', [ManageUsersController::class, 'reset_pass'])->name('resetar-senha');
        Route::post('/{id}/editar', [ManageUsersController::class, 'edit_user'])->name('editar');
        Route::get('/{id}/ativar', [ManageUsersController::class, 'activate_user'])->name('ativar');
        Route::get('/{id}/desativar', [ManageUsersController::class, 'disable_user'])->name('desativar');
    });

    /** Gerenciar tokens */
    Route::prefix('/gerenciar/tokens')->name('gerenciar.tokens.')->group(function (){
        Route::get('/', [TokensController::class, 'list_tokens'])->name('listar');
        Route::get('/todos', [TokensController::class, 'list_tokens_for_user'])->name('listar.id');
        Route::get('/remover/{id}/{user_id}', [TokensController::class, 'remove_token'])->name('remover');
        Route::post('/criar', [TokensController::class, 'new_token'])->name('criar');
    });

});

/** Mensagens do usuário */
Route::prefix('/mensagens')->name('mensagens.')->group(function () {
    Route::post('salvar', [MessageHistoriesController::class, 'store'])->name('salvar');
});

Route::post('configuracoes/horario-funcionamento/salvar', [\App\Services\TimeSettingsService::class, 'save']);
