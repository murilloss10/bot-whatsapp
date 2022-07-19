<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AutoresponderService;
use App\Services\ConexaoApiGoogleService;
use App\Services\MensagemService;
use App\Services\UploadCredentialFile;
use Illuminate\Support\Facades\Auth;

class ConnectionAutoresponderController extends Controller
{
    /**
     * @var AutoresponderService
     */
    protected $autoresponderService;

    /**
     * @var MensagemService
     */
    protected $messageService;

    /**
     * @var ConexaoApiGoogleService
     */
    protected $conexaoApiGoogleService;

    /**
     * @var UploadCredentialFile
     */
    protected $credentialFile;

    /**
     * Construtor.
     *
     * @param AutoresponderService $autoresponderService
     * @param MensagemService $messageService
     * @param UploadCredentialFile $credentialFile
     */
    public function __construct(AutoresponderService $autoresponderService, MensagemService $messageService, UploadCredentialFile $credentialFile)
    {
        try {
            $this->autoresponderService = $autoresponderService;
            $this->messageService       = $messageService;
            $this->credentialFile       = $credentialFile;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function connect()
    {
//        // armazenando dados postados
//        $data = json_decode(file_get_contents("php://input"));
//
//        // make sure json data is not incomplete
//        if( !empty($data->query) && !empty($data->appPackageName) && !empty($data->messengerPackageName) &&
//            !empty($data->query->sender) && !empty($data->query->message) ){
//
//            // package name of AutoResponder to detect which AutoResponder the message comes from
//            $appPackageName = $data->appPackageName;
//            // package name of messenger to detect which messenger the message comes from
//            $messengerPackageName = $data->messengerPackageName;
//            // name/number of the message sender (like shown in the Android notification)
//            $sender = $data->query->sender;
//            // text of the incoming message
//            $message = $data->query->message;
//            // is the sender a group? true or false
//            $isGroup = $data->query->isGroup;
//            // name/number of the group participant who sent the message if it was sent in a group, otherwise empty
//            $groupParticipant = $data->query->groupParticipant;
//            // id of the AutoResponder rule which has sent the web server request
//            $ruleId = $data->query->ruleId;
//            // is this a test message from AutoResponder? true or false
//            $isTestMessage = $data->query->isTestMessage;
//
//
//            // salva mensagens no banco de dados
//            $this->messageService->saveMessages(array(
//                'appPackageName'        => $appPackageName,
//                'messengerPackageName'  => $messengerPackageName,
//                'sender'                => $sender,
//                'message'               => $message,
//                'ruleId'                => $ruleId,
//            ));
//
//
//            // set response code - 200 success
//            http_response_code(200);
//
//            // send one or multiple replies to AutoResponder
//            echo json_encode(
//                array("replies" => array(
//                    array("message" => "Hey " . $sender . "!\nThanks for sending: " . $message),
//                    array("message" => "Success ✅")
//            )));
//
//        }
//
//        // tell the user json data is incomplete
//        else{
//
//            // set response code - 400 bad request
//            http_response_code(400);
//
//            // send error
//            echo json_encode(
//                array("replies" => array(
//                    array("message" => "Error ❌"),
//                    array("message" => "JSON data is incomplete. Was the request sent by AutoResponder?")
//            )));
//        }

        $data = json_decode(file_get_contents("php://input"));

        if ($this->autoresponderService->checkFields($data) == true){

            $arrayWithFields = $this->autoresponderService->setArrayWithFields($data);

            $this->messageService->saveMessages($arrayWithFields);

            if (Auth::check()) {
                $conexaoApiGoogleService    = new ConexaoApiGoogleService(Auth::user()->credentials_file);
                $file_credential            = $this->credentialFile->findFile(Auth::user()->credentials_file);
                $file_credential_decoded    = json_decode($file_credential);
            } else {
                $file_credential            = $this->credentialFile->findFile('murillo_silva_dos_santos/20220628_182818_62bb7272d8277_murillo_silva_dos_santos.json');
                $file_credential_decoded    = json_decode($file_credential);

                $usuario    = 'murillo_silva_dos_santos';
                $nome       = '20220628_182818_62bb7272d8277_murillo_silva_dos_santos.json';
                $caminho    = route('api.arquivo-credencial', [$usuario, $nome]);

                $conexaoApiGoogleService = new ConexaoApiGoogleService('../storage/app/credentials_files/' . $usuario . '/' . $nome);
            }

            $responseApi = $conexaoApiGoogleService->getResponse($file_credential_decoded->project_id, uniqid(), $arrayWithFields['message']);

            http_response_code(200);

            echo json_encode(
                array("replies" => array(
                    array("message" => $responseApi),
            )));
        } else {
            http_response_code(400);

            echo json_encode(
                array("replies" => array(
                    array("message" => "Error ❌"),
                    array("message" => "JSON data is incomplete. Was the request sent by AutoResponder?")
            )));
        }

    }

}
