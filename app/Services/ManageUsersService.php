<?php
/**
 * Service responsável por gerenciar usuários.
 * Created by PhpStorm
 * User: Murillo
 * Date: 03/08/2022
 * Time: 15:28
 */

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use App\Entities\User;

class ManageUsersService
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Lista todos os usuários.
     */
    public function listUsers()
    {
        $users = User::withTrashed()->get();
        return $users;
    }

    /**
     * Busca e retorna o usuário pelo id.
     *
     * @param $id
     */
    public function findUser($id)
    {
        $user = $this->userRepository->find($id);
        return $user;
    }

    /**
     * Salva as atualizações do usuário.
     *
     * @param $data
     * @param $id
     */
    public function editUser($data, $id)
    {
        $user = $this->userRepository->update($data, $id);
        return $user;
    }

    /**
     * Resetar senha do usuário para '12345678'.
     *
     * @param $id
     */
    public function resetPass($id)
    {
        $user = $this->userRepository->update(array(
            'password' => bcrypt('12345678')
        ), $id);
        return $user;
    }

    /**
     * Deleta/desativa o usuário.
     *
     * @param $id
     */
    public function deleteUser($id)
    {
        $user = $this->userRepository->find($id);
        $user->delete();
        return $user;
    }

    /**
     * Restaura/re-ativa o usuário.
     *
     * @param $id
     */
    public function restoreUser($id)
    {
        $user = User::withTrashed()->where('id', $id)->restore();
        return $user;
    }

}
