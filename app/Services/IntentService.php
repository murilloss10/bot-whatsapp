<?php
/**
 * Service responsável por gerenciar as Intents.
 * Created by PhpStorm
 * Name: Murillo
 * Date: 16/05/2022
 * Time: 17:30
 */

namespace App\Services;

use Google\Cloud\Dialogflow\V2\Context;
use Google\Cloud\Dialogflow\V2\Intent;
use Google\Cloud\Dialogflow\V2\IntentsClient;
use Google\Cloud\Dialogflow\V2\IntentView;
use Google\Cloud\Dialogflow\V2\Intent\Message\Text;
use http\Message;

class IntentService
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
     * @param $credentials
     */
    public function __construct($credentials)
    {
        $this->credentials = array('credentials' => $credentials);
    }

    /**
     * Cria uma Intent.
     *
     * @param $projectId
     * @param $request
     */
    public function createIntent($projectId, $request)
    {
        $webhook_state      = $request->webhook_state == 'on' ? 1 : 0;
        $is_fallback        = $request->is_fallback == 'on' ? true : false;
        $end_interaction    = $request->end_interaction == 'on' ? true : false;
        //$input_context_names = $request->input_context_names;//fazer uma lista com todos os contexts de saída

        //$training_phrases;
        //$output_contexts = $request->output_contexts;//registrar contexts de saída
        $intentsClient      = new IntentsClient($this->credentials);

        try {
            $formattedParent    = $intentsClient->agentName($projectId);
            $intent             = new Intent(array(
                                    'display_name'      => $request->display_name,
                                    'webhook_state'     => $webhook_state,
                                    'is_fallback'       => $is_fallback,
                                    'end_interaction'   => $end_interaction,
                                    'output_contexts'   => $this->createOutputContext($request, $projectId),
                        ));
            $response           = $intentsClient->createIntent($formattedParent, $intent);

            return [
                'data' => [
                    'success'   => true,
                    'message'   => 'Intent criada com sucesso.',
                    'intent'    => $response->serializeToJsonString(),
                    'projectId' => $projectId,
                ]
            ];

        } catch (\Exception $e) {
            $intentsClient->close();

            return [
                'data' => [
                    'success'   => false,
                    'message'   => 'Erro ao criar Intent: ' . $e->getMessage(),
                    'intent'    => null,
                    'projectId' => $projectId,
                ]
            ];
        }
    }

    /**
     * Monta o objeto Parameters.
     *
     * @param $request
     * @return array
     */
    public function mountObjectParameters($request)
    {
        //remover os espaços e caracteres especiais
        //permitido: O `ContextID` é sempre convertido em minúsculas, pode conter apenas caracteres em a-zA-Z0-9_-% e pode ter no máximo 250 bytes.
        //adicionar os dados na hora de construir o name
        //campo de nome unico

        $parameters = [
            'display_name'              => $request->display_name_parameters,
            'value'                     => '$' . $request->display_name_parameters,
            'entity_type_display_name'  => '@sys.any',//temporariamente com esse valor, fazer um select com os principais métodos com o adicional das entidades
            'mandatory'                 => $request->mandatory_parameters == 'on' ? true : false,
            'prompts'                   => [
                $request->prompts_parameters//ajustar para adicionar vários arrays de strings
            ]
        ];
        return $parameters;
    }

    /**
     * Monta o objeto OutputContext.
     *
     * @param $request
     * @param $projectId
     * @return array
     */
    public function mountObjectOutputContext($request, $projectId)
    {
        return $output_contexts = [
            'name'              => 'projects/' . $projectId . '/agent/sessions/-/contexts/' . $request->output_context_name,//falta tratar este campo
            'lifespan_count'    => (int) $request->output_context_lifespan_count,
        ];
    }

    /**
     * Cria o OutputContext de acordo com os parâmetros passados.
     *
     * @param $request
     * @param $projectId
     * @return Context
     */
    public function createOutputContext($request, $projectId)
    {
        $output_contexts = new Context($this->mountObjectOutputContext($request, $projectId));
        return array($output_contexts);
    }


    public function getIntent($projeto, $id_intent)
    {
        $intentsClient = new IntentsClient($this->credentials);
        try {
            $formattedName = $intentsClient->intentName($projeto, $id_intent);
            $response = $intentsClient->getIntent($formattedName, array('intentView' => IntentView::INTENT_VIEW_FULL));
            return $response;
//            $todasMensagens = [];
//
//            foreach ($response->getMessages() as $key => $message) {
////                print_r(json_decode($message->serializeToJsonString()));
////                print_r('<br>');
//                $todasMensagens[$key] = [
//                    json_decode($message->serializeToJsonString())
//                ];
////                $todasMensagens[$key] = [$message['text']];
//            }
////            dd($todasMensagens[0][0]->text->text);
//            dd($response);
            //pegar a quantidade de itens no objetos pra percorrer especificamente por cada pra pegar os textos de cada
        } finally {
            $intentsClient->close();
        }

    }

    public function getIntents($projectId)
    {
        $intentsClient = new IntentsClient($this->credentials);
        try {
            $formattedParent = $intentsClient->agentName($projectId);
            // Iterate over pages of elements
            $pagedResponse = $intentsClient->listIntents($formattedParent, [
                'intentView' => IntentView::INTENT_VIEW_FULL
            ]);
            //dd($pagedResponse);
//            foreach ($pagedResponse->iteratePages() as $page) {
//                foreach ($page as $element) {
//                     doSomethingWith($element);
//                    echo $element;
//                }
//            }
//            dd($pagedResponse);
            foreach($pagedResponse->iterateAllElements() as $element) {
//                dd($element);
                foreach ($element->getTrainingPhrases() as $phrase) {
                    print_r(json_decode($phrase->serializeToJsonString()));
                    print_r('<br>');
                }
            }

            // Alternatively:

//            // Iterate through all elements
//            $pagedResponse = $intentsClient->listIntents($formattedParent);
//            foreach ($pagedResponse->iterateAllElements() as $element) {
//                // doSomethingWith($element);
//            }
        } finally {
            $intentsClient->close();
        }

    }


    /**
     * Retorna uma lista de Intents do Projeto.
     *
     * @param $projectId
     * @return array
     */
    public function listIntents($projectId)
    {
        $intentsClient = new IntentsClient($this->credentials);
        try {
            $formattedParent    = $intentsClient->agentName($projectId);
            $pagedResponse      = $intentsClient->listIntents($formattedParent);
            $allIntents         = [];
            $objectIntents      = [];
            $intentNameProject  = 'projects/' . $projectId . '/agent/intents/';

            foreach ($pagedResponse->iterateAllElements() as $key => $element) {
                $objectIntents[$key] = [
                    json_decode($element->serializeToJsonString())
                ];
            }

            for ($i = 0; $i < sizeof($objectIntents); $i++) {
                $allIntents[$i] = $objectIntents[$i][0];
            }

//            dd([$allIntents, $pagedResponse]);

            foreach ($allIntents as $key => $intent) {
                if (substr_compare($intent->name, $intentNameProject, 0, strlen($intentNameProject)) == 0) {
                    $allIntents[$key]->id_intent = substr($intent->name, strlen($intentNameProject), strlen($intent->name));
                }
            }

            return $allIntents;

        } finally {
            $intentsClient->close();
        }
    }


    public function getMessages()
    {
        $message = new Text();
        $message->setText();
        new Intent\Message();
    }



}
