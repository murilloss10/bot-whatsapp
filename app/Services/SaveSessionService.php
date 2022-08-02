<?php
/**
 * Gerencia as sessões de cada conversa do cliente com o usuário.
 * Created by PhpStorm
 * User: Murillo
 * Date: 28/07/2022
 * Time: 21:19
 */

namespace App\Services;

use App\Repositories\SaveSessionRepository;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class SaveSessionService
{

    /**
     * @var SaveSessionRepository
     */
    private $saveSession;

    /**
     * Construtor.
     */
    public function __construct(SaveSessionRepository $saveSession)
    {
        $this->saveSession = $saveSession;
    }

    /**
     * Salva a session da conversa no banco de dados.
     *
     * @param $sender
     */
    public function save($sender)
    {
        try {
            $user           = Auth::user();
            $session_name   = uniqid(date('Ymd_His_'));

            $session = $this->saveSession->create(array(
                'id'            => (string) Uuid::uuid4(),
                'user_id'       => $user->id,
                'sender'        => $sender,
                'session_name'  => $session_name,
                'is_active'     => true,
            ));

            return $session;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Busca uma sessão de acordo com o usuário autenticado e o sender.
     *
     * @param $sender
     */
    public function findSession($sender)
    {
        try{
            $session = $this->saveSession->findWhere([
                'user_id'   => Auth::id(),
                'sender'    => $sender,
                'is_active' => true
            ])->first();

            return $session;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }


}
