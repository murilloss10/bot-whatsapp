<?php
/**
 * Service responsável por gerenciar ações de Agentes do DialogFlow.
 * Created by PhpStorm
 * User: Murillo
 * Date: 12/05/2022
 * Time: 13:03
 */

namespace App\Services;

use Google\Cloud\Dialogflow\V2\Agent;
use Google\Cloud\Dialogflow\V2\AgentsClient;

class AgenteService
{

    /**
     * Variável Array para receber a localização do arquivo credencial JSON.
     *
     * @var string
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
     * Retorna o Agente do projeto.
     *
     * @param string $projectId
     * @return Agent
     */
    public function getAgent($projectId)
    {
        $agentsClient = new AgentsClient($this->credentials);

        try {
            $formattedParent = $agentsClient->projectName($projectId);
            $response = $agentsClient->getAgent($formattedParent);
            return $response;
        } finally {
            $agentsClient->close();
        }

    }

    /**
     * Cria um Agente no projeto ou atualiza se já existir Agente no projeto.
     *
     * @param string $parent
     *      Mais precisamente o link do projeto. Ex.: 'projects/teste-jwyo'.
     * @param string $display_name
     *      O nome a ser atribuído ao Agente.
     * @param string $description
     *      Opcional. Descrição do Agente.
     * @param string $avatar_uri
     *      Opcional. Link para o avatar do Agente.
     */
    public function setAgent($parent, $display_name, $description = '', $avatar_uri = '')
    {
        $agentsClient = new AgentsClient($this->credentials);
        try {
            $agent = new Agent(array('parent' => $parent,
                                    'display_name' => $display_name,
                                    'default_language_code' => 'pt-br',
                                    'supported_language_codes' => [],
                                    'time_zone' => 'America/Buenos_Aires',
                                    'description' => $description,
                                    'avatar_uri' => $avatar_uri,
                                    'enable_logging' => true,
                                    'match_mode' => 1,
                                    'classification_threshold' => 0.30000001192093,
                                    'api_version' => 3,
                                    'tier' => 1));

            $response = $agentsClient->setAgent($agent);
            return $response;

        } finally {
            $agentsClient->close();
        }
    }

    /**
     * Deleta o Agente do projeto_id passado por parâmetro.
     *
     * @param $projectId
     * @return Agent
     */
    public function deleteAgent($projectId)
    {
        $agentsClient = new AgentsClient($this->credentials);
        try {
            $formattedParent    = $agentsClient->projectName($projectId);
            $response           = $agentsClient->getAgent($formattedParent);

            $agentsClient->deleteAgent($formattedParent);
            return $response;

        } finally {
            $agentsClient->close();
        }
    }

}
