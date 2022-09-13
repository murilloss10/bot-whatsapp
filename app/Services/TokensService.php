<?php
/**
 * Faz o gerenciamento de Tokens.
 * Created by PhpStorm
 * User: Murillo
 * Date: 05/08/2022
 * Time: 19:50
 */

namespace App\Services;


use App\Repositories\PersonalAccessTokenRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;


class TokensService
{
    /**
     * @var
     */
    private $personalAccessToken;

    /**
     * @var
     */
    private $userRepository;

    /**
     * Construtor.
     */
    public function __construct(PersonalAccessTokenRepository $personalAccessTokenRepository, UserRepository $userRepository)
    {
        $this->personalAccessToken  = $personalAccessTokenRepository;
        $this->userRepository       = $userRepository;
    }

    /**
     * Retorna um array com todos os tokens.
     */
    public function listAllTokens()
    {
        $tokens = $this->personalAccessToken->all();
        $tokens_array = $tokens->toArray();
        return $tokens_array;
    }

    /**
     * Retorna um array com todos os tokens do usuário passado por parâmetro.
     *
     * @param $user_id
     */
    public function listTokensForUser($user_id)
    {
        try {
            $tokens = $this->personalAccessToken->findWhere(['tokenable_id' => $user_id]);
            $tokens_array = $tokens->toArray();
            return $tokens_array;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove o token de acordo com o id e o usuário.
     *
     * @param $id
     * @param $user_id
     */
    public function removeToken($id, $user_id)
    {
        try {
            $this->personalAccessToken->delete($id);
            return response()->json([
                'sucess' => 'Token removido com sucesso.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao remover token.'
            ], 500);
        }
    }

    /**
     * Cria um novo token para o usuário logado.
     *
     * @param $data
     * @param $user_id
     */
    public function createToken($data, $user_id)
    {
        try {
            $user = $this->userRepository->find($user_id);

            if ( Hash::check($data['password'], $user->password) ){
                $token = $user->createToken('tokenId' . $user->id)->plainTextToken;
                return $token;
            }

        } catch(\Exception $e) {
            return response([
                'message' => 'Senha incorreta'
            ], 401);
        }

    }

}
