<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\AuthController;
use App\Services\TokensService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokensController extends Controller
{
    /**
     * @var TokensService
     */
    protected $tokensService;

    /**
     * @var AuthController
     */
    protected $authController;

    /**
     * Construtor.
     *
     * @param TokensService $tokensService
     */
    public function __construct(TokensService $tokensService, AuthController $authController)
    {
        $this->tokensService    = $tokensService;
        $this->authController   = $authController;
    }

    /**
     * Retorna todos os tokens, independente do usuário.
     */
    public function list_tokens(Request $request)
    {
        try {
            $tokens     = $this->tokensService->listAllTokens();
            $rm_token   = $request->session()->get('remocao_token');

            $request->session()->remove('remocao_token');

            return view('tokens.index', compact('tokens', 'rm_token'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Lista todos os tokens do usuário logado.
     *
     * @param Request $request
     */
    public function list_tokens_for_user(Request $request)
    {
        try {
            $user       = Auth::user();
            $user_id    = Auth::id();
            $tokens     = $this->tokensService->listTokensForUser($user_id);
            $token      = $request->session()->get('token');
            $rm_token   = $request->session()->get('remocao_token');

            $request->session()->remove('token');
            $request->session()->remove('remocao_token');

            return view('tokens.my-tokens', compact('user', 'tokens', 'token', 'rm_token'));
        } catch (\Exception $e) {
            $user       = Auth::user();
            $user_id    = Auth::id();
            $tokens     = $this->tokensService->listTokensForUser($user_id);
            $erro       = $request->session()->get('erro');

            $request->session()->remove('erro');

            return view('tokens.my-tokens', compact('user', 'tokens', 'erro'));
        }

    }

    /**
     * Exclui o token de acordo com id do token e o usuário.
     *
     * @param $id
     * @param $user_id
     */
    public function remove_token($id, $user_id, Request $request)
    {
        try {
            $data = $this->tokensService->removeToken($id, $user_id);

            $request->session()->put('remocao_token', 'Token removido com sucesso.');

            return redirect()->back()->with('data', $data);
        } catch(\Exception $e) {
            $request->session()->put('remocao_token', 'Não foi possível remover o token.');
            return redirect()->back();
        }

    }

    /**
     * Gera um novo token para o usuário logado.
     *
     * @param Request $request
     */
    public function new_token(Request $request)
    {
        try {
            $request->validate([
                'password'  => 'required|string'
            ]);

            $user_id    = Auth::id();
            $token      = $this->tokensService->createToken($request->all(), $user_id);

            $request->session()->put('token', $token);

            return redirect()->back();
        } catch(\Exception $e) {
            $request->session()->put('erro', 'Não foi possível criar seu novo token.');
            return redirect()->back();
        }
    }
}
