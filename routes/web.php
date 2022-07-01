<?php

use App\Http\Controllers\Admin\ConnectionAutoresponderController;
use App\Http\Controllers\MessageHistoriesController;
use App\Http\Controllers\PaginaInicialController;
use App\Http\Controllers\Usuario\UploadCredentialFileController;
use App\Repositories\MessageHistoryRepository;
use Google\Cloud\Dialogflow\V2\IntentsClient;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    //posso adicionar uma página para fazer upload do arquivo .json, ler ele e salvar as informações no banco de dados
//    $test = [
//        'credentials' => json_decode(file_get_contents('../teste-jwyo-aed37d258822.json'), true)
//    ];
//    return $test['credentials'];
    //teste
    $config = [
        'keyFilePath' => '../teste-jwyo-aed37d258822.json',
        'projectId' => 'teste-jwyo',
    ];
    //teste 2
    $test = array('credentials' => '../teste-jwyo-aed37d258822.json');
    //nova sessão
    $sessionsClient = new \Google\Cloud\Dialogflow\V2\SessionsClient($test);
    $session = $sessionsClient->sessionName($config['projectId'], '12345678');
    //criando texto input
    $textInput = new \Google\Cloud\Dialogflow\V2\TextInput();
    $textInput->setText('oi');
    $textInput->setLanguageCode('pt-BR');
    //criando query input
    $queryInput = new \Google\Cloud\Dialogflow\V2\QueryInput();
    $queryInput->setText($textInput);
    // get response and relevant info
    $response = $sessionsClient->detectIntent($session, $queryInput);
    $queryResult = $response->getQueryResult();
    $queryText = $queryResult->getQueryText();
    $intent = $queryResult->getIntent();
    $displayName = $intent->getDisplayName();
    $confidence = $queryResult->getIntentDetectionConfidence();
    $fulfilmentText = $queryResult->getFulfillmentText();
     // output relevant info
    print(str_repeat("=", 20) . PHP_EOL);
    printf('Query text: %s' . PHP_EOL, $queryText);
    printf('Detected intent: %s (confidence: %f)' . PHP_EOL, $displayName, $confidence);
    print(PHP_EOL);
    printf('Fulfilment text: %s' . PHP_EOL, $fulfilmentText);
    $sessionsClient->close();
//    dd($queryInput);
});

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
    Route::get('/home', [PaginaInicialController::class, 'home'])->name('dashboard');

    /** Configurações de usuário */
    Route::prefix('/conta')->name('conta.')->group(function () {
        Route::get('credencial', [UploadCredentialFileController::class, 'index'])->name('credencial');
        Route::post('credencial/salvar', [UploadCredentialFileController::class, 'store'])->name('credencial.salvar');
    });

});

/** Teste */
Route::post('/request', [ConnectionAutoresponderController::class, 'connect'])->name('test.connect');

/** Mensagens do usuário */
Route::prefix('/mensagens')->name('mensagens.')->group(function () {
//    Route::get('todas', [MessageHistoryRepository::class, 'index'])->name('todas');
    Route::post('salvar', [MessageHistoriesController::class, 'store'])->name('salvar');
});
