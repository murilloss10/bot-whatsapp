<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AutoresponderService;
use App\Services\ConexaoApiGoogleService;
use App\Services\MensagemService;
use App\Services\SaveSessionService;
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
     * @var SaveSessionService
     */
    protected $saveSessionService;

    /**
     * Construtor.
     *
     * @param AutoresponderService $autoresponderService
     * @param MensagemService $messageService
     * @param UploadCredentialFile $credentialFile
     */
    public function __construct(AutoresponderService $autoresponderService, MensagemService $messageService,
                                UploadCredentialFile $credentialFile, SaveSessionService $saveSessionService)
    {
        try {
            $this->autoresponderService = $autoresponderService;
            $this->messageService       = $messageService;
            $this->credentialFile       = $credentialFile;
            $this->saveSessionService   = $saveSessionService;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Conecta as requisições de mensagem com as respostas do DialogFlow.
     */
    public function connect()
    {

        $data = json_decode(file_get_contents("php://input"));

        if ($this->autoresponderService->checkFields($data) == true){

            $arrayWithFields = $this->autoresponderService->setArrayWithFields($data);

            $this->messageService->saveMessages($arrayWithFields);

            $conexaoApiGoogleService    = new ConexaoApiGoogleService('../storage/app/credentials_files/' . Auth::user()->credentials_file);
            $file_credential            = $this->credentialFile->findFile(Auth::user()->credentials_file);
            $file_credential_decoded    = json_decode($file_credential);

            $sessionId = $this->saveSessionService->findSession($arrayWithFields['sender']);

            if ( $sessionId == '' || $sessionId == NULL )
                $sessionId = $this->saveSessionService->save($arrayWithFields['sender']);

            $responseApi = $conexaoApiGoogleService->getResponse($file_credential_decoded->project_id, $sessionId->session_name, $arrayWithFields['message']);

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
