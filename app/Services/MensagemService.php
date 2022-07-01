<?php
/**
 * Service responsável por gerenciar mensagens.
 * Created by PhpStorm
 * User: Murillo
 * Date: 28/06/2022
 * Time: 13:03
 */

namespace App\Services;

use App\Repositories\SaveMessageRepository;
use Ramsey\Uuid\Uuid;

class MensagemService
{

    /**
     * @var SaveMessageRepository
     */
    private $saveMessage;

    /**
     * @param $saveMessage
     */
    public function __construct(SaveMessageRepository $saveMessage)
    {
        $this->saveMessage = $saveMessage;
    }

    public function saveMessages($data)
    {
        $message = $this->saveMessage->create(array(
            'id'                    => (string) Uuid::uuid4(),
            'appPackageName'        => $data['appPackageName'],
            'messengerPackageName'  => $data['messengerPackageName'],
            'sender'                => $data['sender'],
            'message'               => $data['message'],
            'ruleId'                => $data['ruleId'],
            'isTestMessage'         => $data['isTestMessage'],
            'for_user_id'           => 1,//alterar para o id do usuário logado
        ));

        return $message;
    }

}
