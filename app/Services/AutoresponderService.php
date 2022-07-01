<?php
/**
 * Service responsável por conectar mensagens recebidas com as definidas no DialogFlow.
 * Created by PhpStorm
 * User: Murillo
 * Date: 30/06/2022
 * Time: 11:40
 */

namespace App\Services;

use stdClass;

class AutoresponderService
{
    /**
     * Contrutor.
     */
    public function __construct()
    {
    }

    /**
     * Verifica se os principais campos estão vazios.
     *
     * @param $data
     * @return bool
     */
    public function checkFields($data)
    {
        if( !empty($data->query) && !empty($data->appPackageName) && !empty($data->messengerPackageName) &&
            !empty($data->query->sender) && !empty($data->query->message) ){
            return true;
        }
    }

    /**
     * Cria array com os campos.
     *
     * @param $data {
     *     Required.
     *
     *     @type string $appPackageName
     *           Nome do pacote do AutoResponder para detectar de qual AutoResponder a mensagem vem.
     *     @type string $messengerPackageName
     *           Nome do pacote do messenger para detectar de qual mensageiro a mensagem vem.
     *     @type string $sender
     *           Nome/número do remetente da mensagem (como mostrado na notificação do Android).
     *     @type string $message
     *           Texto da mensagem recebida.
     *     @type bool $isGroup
     *           O remetente é um grupo? verdadeiro ou falso.
     *     @type string $groupParticipant
     *           Nome/número do participante do grupo que enviou a mensagem se ela foi enviada em um grupo, caso contrário vazio.
     *     @type int $ruleId
     *           Id da regra AutoResponder que enviou a solicitação do servidor web.
     *     @type bool $isTestMessage
     *           Esta é uma mensagem de teste do AutoResponder? verdadeiro ou falso.
     * }
     * @return array
     */
    public function setArrayWithFields($data)
    {
        $appPackageName         = $data->appPackageName;
        $messengerPackageName   = $data->messengerPackageName;
        $sender                 = $data->query->sender;
        $message                = $data->query->message;
        $isGroup                = $data->query->isGroup;
        $groupParticipant       = $data->query->groupParticipant;
        $ruleId                 = $data->query->ruleId;
        $isTestMessage          = $data->query->isTestMessage;

        return array(
            'appPackageName'        => $appPackageName,
            'messengerPackageName'  => $messengerPackageName,
            'sender'                => $sender,
            'message'               => $message,
            'isGroup'               => $isGroup,
            'groupParticipant'      => $groupParticipant,
            'ruleId'                => $ruleId,
            'isTestMessage'         => $isTestMessage,
        );
    }

}
