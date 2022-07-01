<?php
/**
 * Faz a autenticação com a API Google.
 * Created by PhpStorm
 * User: Murillo
 * Date: 10/05/2022
 * Time: 13:02
 */

namespace App\Services;

use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;

class ConexaoApiGoogleService
{

    /**
     * Variável Array para receber a localização do arquivo credencial JSON.
     */
    private $credentials;

    /**
     * Construtor que recebe como parâmetro uma string com a localização do arquivo JSON.
     *
     * @param string $credentials
     */
    public function __construct($credentials)
    {
        $this->credentials = array('credentials' => $credentials);
    }

    /**
     * Cria sessão de cliente de acordo com as credenciais do arquivo JSON.
     *
     * @return SessionsClient
     */
    public function connectionBySession()
    {
        //criando sessão
        $sessionsClient = new SessionsClient($this->credentials);//alterar para receber por parâmetro da função
        return $sessionsClient;
    }

    /**
     * Pega o nome/caminho da sessão criada.
     *
     * @param string $projectId
     * @param string $sessionId
     * @return string $session
     */
    public function sessionName($projectId, $sessionId)
    {
        $sessionsClient = $this->connectionBySession();
        $sessionName = $sessionsClient->sessionName($projectId, $sessionId);
        return $sessionName;
    }

    /**
     * Monta o texto enviado pelo usuário.
     *
     * @param string $text
     * @param string $languageCode
     * @return TextInput
     */
    public function setTextInput($text, $languageCode = 'pt-BR')
    {
        //criando texto input
        $textInput = new TextInput();
        $textInput->setText($text);
        $textInput->setLanguageCode($languageCode);
        return $textInput;
    }

    /**
     * Monta a query com o texto criado.
     *
     * @param string $text
     * @param string $languageCode
     * @return QueryInput
     */
    public function queryInput($text, $languageCode = 'pt-BR')
    {
        //criando query input
        $queryInput = new QueryInput();
        $queryInput->setText($this->setTextInput($text));
        return $queryInput;
    }

    /**
     * Manda todas as configurações e recebe a resposta do DialogFlow.
     *
     * @param string $projectId
     * @param string $sessionId
     * @param string $text
     * @param string $languageCode
     * @return string $fulfilmentText
     */
    public function getResponse($projectId, $sessionId, $text, $languageCode = 'pt-BR')
    {
        $sessionsClient = $this->connectionBySession();
        $session = $this->sessionName($projectId, $sessionId);
        $queryInput = $this->queryInput($text, $languageCode);

        $response = $sessionsClient->detectIntent($session, $queryInput);
        $queryResult = $response->getQueryResult();
        $fulfilmentText = $queryResult->getFulfillmentText();
        return $fulfilmentText;
    }


}




