<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Google\Cloud\Storage\StorageClient;

use Google\Auth\ApplicationDefaultCredentials;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;


use Google\Cloud\Dialogflow\V2\IntentsClient;
use Google\Cloud\Dialogflow\V2\Intent;
use Google\Cloud\Dialogflow\V2\Intent\TrainingPhrase\Part;
use Google\Cloud\Dialogflow\V2\Intent\TrainingPhrase;
use Google\Cloud\Dialogflow\V2\Intent\Message;
use Google\Cloud\Dialogflow\V2\Intent\Message\Text;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {

    //teste
    # Explicitly use service account credentials by specifying the private key
    # file.
//    $config = [
//        'keyFilePath' => '../testeprojetobot-8ff17931e823.json',
//        'projectId' => 'testeprojetobot',
//    ];
//    $storage = new StorageClient($config);
//
//    # Make an authenticated API request (listing storage buckets)
////    foreach ($storage->buckets() as $bucket => $key) {
////        printf('Bucket: %s' . PHP_EOL, $bucket->name());
//////        $array[$key] = printf('Bucket: %s' . PHP_EOL, $bucket->name());
////    }
//    return $storage;

    //teste 2
//    $filePath = public_path('../'.getenv('testeprojetobot-8ff17931e823').'.json');
//    putenv('GOOGLE_APPLICATION_CREDENTIALS='.$filePath);
//
//    $intentsClient = new IntentsClient();
//
//    $trainingPhrasesInput = [];
//    $answers = [];
//
//    $formattedParent = $intentsClient->projectAgentName ('testeprojetobot');
//
//    return $formattedParent;


    //teste3
    // specify the path to your application credentials
    putenv('GOOGLE_APPLICATION_CREDENTIALS=../testeprojetobot-8ff17931e823.json');

    // Provide the ID token audience. This can be a Client ID associated with an IAP application,
    // Or the URL associated with a CloudRun App
    //    $targetAudience = 'IAP_CLIENT_ID.apps.googleusercontent.com';
    //    $targetAudience = 'https://service-1234-uc.a.run.app';
        $targetAudience = '115044583717706705914';

    // create middleware
        $middleware = ApplicationDefaultCredentials::getIdTokenMiddleware($targetAudience);
        $stack = HandlerStack::create();
        $stack->push($middleware);

    // create the HTTP client
        $client = new Client([
            'handler' => $stack,
            'auth' => 'google_auth',
            // Cloud Run, IAP, or custom resource URL
            'base_uri' => 'https://bot.dialogflow.com/f046efb3-aae1-43c6-ae43-5f67a428b0ff',
        ]);

    // make the request
        $response = $client->get('/');

    // show the result!

});

Route::get('/teste', function () {

});
