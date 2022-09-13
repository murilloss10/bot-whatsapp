<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ManageUsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageUsersController extends Controller
{
    /**
     * @var ManageUsersService
     */
    protected $manageUsers;

    /**
     * @param ManageUsersService $manageUsers
     */
    public function __construct(ManageUsersService $manageUsers)
    {
        $this->manageUsers = $manageUsers;
    }

    /**
     * Retorna a view de gerenciamento de Usuários.
     */
    public function index(Request $request)
    {
        if (Auth::user()->type == 'admin') {
            $users      = $this->manageUsers->listUsers();
            $success    = $request->session()->get('success');
            $error      = $request->session()->get('error');

            $request->session()->remove('success');
            $request->session()->remove('error');

            return view('manage-users.index', compact('users', 'success', 'error'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Reseta senha do usuário.
     *
     * @param Request $request
     * @param $id
     */
    public function reset_pass($id, Request $request)
    {
        try {
            $user = $this->manageUsers->resetPass($id);

            $request->session()->put('success', 'Senha alterada.');

            return redirect()->back();
        } catch (\Exception $e) {
            $request->session()->put('error', 'A senha não pôde ser alterada.');
            return $e->getMessage();
        }
    }

    /**
     * Edita informações do usuário.
     *
     * @param Request $request
     * @param $id
     */
    public function edit_user(Request $request, $id)
    {
        try {
            $data = array(
                'name'  => $request->name,
                'email' => $request->email
            );

            $user = $this->manageUsers->editUser($data, $id);

            $request->session()->put('success', 'Dados do usuário foram alterados.');

            return redirect()->back();
        } catch (\Exception $e) {
            $request->session()->put('error', 'As alterações não foram salvas.');
            return $e->getMessage();
        }
    }

    /**
     * Ativa o usuário.
     *
     * @param $id
     */
    public function activate_user($id, Request $request)
    {
        try {
            $user = $this->manageUsers->restoreUser($id);

            $request->session()->put('success', 'Usuário ativado.');

            return redirect()->back();
        } catch (\Exception $e) {
            $request->session()->put('error', 'Não foi possível ativar o usuário.');
            return $e->getMessage();
        }
    }

    /**
     * Desativa o usuário.
     *
     * @param $id
     */
    public function disable_user($id, Request $request)
    {
        try {
            $user = $this->manageUsers->deleteUser($id);

            $request->session()->put('success', 'Usuário desativado.');

            return redirect()->back();
        } catch (\Exception $e) {
            $request->session()->put('error', 'Não foi possível desativar o usuário.');
            return $e->getMessage();
        }
    }


}
