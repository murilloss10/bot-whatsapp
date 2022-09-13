<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AutoresponderService;
use App\Services\ConexaoApiGoogleService;
use App\Services\MensagemService;
use App\Services\SaveSessionService;
use App\Services\TimeSettingsService;
use App\Services\UploadCredentialFile;
use DateTime;
use DateTimeZone;
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
     * @var TimeSettingsService
     */
    protected $timeSettingsService;

    /**
     * Construtor.
     *
     * @param AutoresponderService $autoresponderService
     * @param MensagemService $messageService
     * @param UploadCredentialFile $credentialFile
     */
    public function __construct(AutoresponderService $autoresponderService, MensagemService $messageService,
                                UploadCredentialFile $credentialFile, SaveSessionService $saveSessionService,
                                TimeSettingsService $timeSettingsService)
    {
        try {
            $this->autoresponderService = $autoresponderService;
            $this->messageService       = $messageService;
            $this->credentialFile       = $credentialFile;
            $this->saveSessionService   = $saveSessionService;
            $this->timeSettingsService  = $timeSettingsService;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Conecta as requisições de mensagem com as respostas do DialogFlow.
     */
    public function connect()
    {
        $date               = explode('-', date('l - H:i', time()));
        $date_week_number   = $this->autoresponderService->getDayOfTheWeekForNumber(trim($date[0]));
        $data               = json_decode(file_get_contents("php://input"));
        $setting            = $this->timeSettingsService->checkIfExistsSetting(Auth::id(), $date_week_number)->first();

        //add tabela de mensagens padrões, incluindo as mensagens padrões para estabelecimento fechado, então verificar se há mensagem padrão para o estabelecimento fechado
        //mensagens padrões devem ter tipos, como o tipo "is_closed"
        //mensagem - por a possibilidade de ter mensagem filha

        if ($setting != null || $setting != [] || $setting != ''){
            $check = $this->autoresponderService->checkDaysAndTime( Auth::id(), trim($date[0]), trim($date[1]) );

            if ( $check['check'] ) {

                $this->call_functions($data);

            } else {
                http_response_code(400);

                echo json_encode(
                    array("replies" => array(
                        array("message" => "Desculpe, no momento não estamos atendendo."),
                        array("message" => "Nosso horário hoje é das " . date_format(new DateTime($check['start_hour']), 'H:i') . "h às " . date_format(new DateTime($check['end_hour']), 'H:i') . "h.")
                    )));
            }
        } else {
            http_response_code(400);

            echo json_encode(
                array("replies" => array(
                    array("message" => "Olá, não estamos funcionando hoje.")
                )));
        }

    }

    /**
     * Faz a chamada das funções dos Services recebendo os dados enviados pela API.
     *
     * @param $data
     */
    public function call_functions($data)
    {
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
