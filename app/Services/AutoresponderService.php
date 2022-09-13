<?php
/**
 * Service responsável por conectar mensagens recebidas com as definidas no DialogFlow.
 * Created by PhpStorm
 * User: Murillo
 * Date: 30/06/2022
 * Time: 11:40
 */

namespace App\Services;

use DateTimeZone;
use DateTime;
use stdClass;
use App\Services\TimeSettingsService;

class AutoresponderService
{
    /**
     * @var TimeSettingsService
     */
    protected $timeSettingsService;

    /**
     * Contrutor.
     *
     * @param TimeSettingsService $timeSettingsService
     */
    public function __construct(TimeSettingsService $timeSettingsService)
    {
        $this->timeSettingsService  = $timeSettingsService;
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

    /**
     * @param $user_id
     * @param $day_name
     * @param $current_time
     * @return array
     */
    public function checkDaysAndTime($user_id, $day_name, $current_time)
    {
        $day_week   = $this->getDayOfTheWeek($day_name);
        $check      = $this->timeSettingsService->checkIfTheDateIsCorrect($user_id, $day_week, $current_time);

        return $check;
    }

    /**
     * Altera o dia da semana de inglês para português.
     *
     * @param $date
     * @return string
     */
    public function getDayOfTheWeek($date)
    {
        if ($date == 'Sunday'){
            $day = 'Domingo';
        } elseif ($date == 'Monday'){
            $day = 'Segunda-Feira';
        } elseif ($date == 'Tuesday'){
            $day = 'Terça-Feira';
        } elseif ($date == 'Wednesday'){
            $day = 'Quarta-Feira';
        } elseif ($date == 'Thursday'){
            $day = 'Quinta-Feira';
        } elseif ($date == 'Friday'){
            $day = 'Sexta-Feira';
        } elseif ($date == 'Saturday'){
            $day = 'Sábado';
        }

        return $day;
    }

    /**
     * Altera o dia da semana de inglês para número.
     *
     * @param $date
     * @return string
     */
    public function getDayOfTheWeekForNumber($date)
    {
        if ($date == 'Sunday'){
            $day = 1;
        } elseif ($date == 'Monday'){
            $day = 2;
        } elseif ($date == 'Tuesday'){
            $day = 3;
        } elseif ($date == 'Wednesday'){
            $day = 4;
        } elseif ($date == 'Thursday'){
            $day = 5;
        } elseif ($date == 'Friday'){
            $day = 6;
        } elseif ($date == 'Saturday'){
            $day = 7;
        }

        return $day;
    }

}
