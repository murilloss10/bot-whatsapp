<?php
/**
 * Faz o upload dos arquivos de credenciamento do Google.
 * Created by PhpStorm
 * User: Murillo
 * Date: 27/06/2022
 * Time: 17:00
 */

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadCredentialFile
{
    /**
     * Nome do cliente logado, formatado, retirando os espaços e substituindo por underline.
     *
     * @var string
     */
    private $nameClientFormatted;

    /**
     * Construtor. Definindo variável $nameClientFormatted.
     */
    public function __construct()
    {
        if (Auth::check()){
            $this->nameClientFormatted = strtolower( str_replace(' ', '_', Auth::user()->name) );
        }
        $this->nameClientFormatted = 'nome_padrao';
    }

    /**
     * Recebe por parâmetro um arquivo submetido pelo usuário.
     *
     * @param $file
     */
    private function storeFile($file)
    {
        $request_file = $file;

        //nome arquivo
        $name           = uniqid(date('Ymd_His_')) . '_' . $this->nameClientFormatted;
        $extension      = $request_file->extension();
        $name_completed = $name . '.' . $extension;

        //salva o arquivo
        $upload_file = $request_file->storeAs($this->nameClientFormatted, $name_completed, 'local_credentials');

        return $upload_file;
    }

    /**
     * Salva o arquivo e o seu caminho no próprio registro de User.
     *
     * @param $file
     *  Recebe como parâmetro o arquivo.
     */
    public function saveData($file)
    {
        try {
            $upload_file = $this->storeFile($file);

            $user_id    = Auth::id();
            $user       = User::find($user_id);

            $user->credentials_file = $upload_file;
            $user->save();

            return [
                'data' => $user,
                'message' => 'Arquivo submetido com sucesso.'
            ];

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Busca o arquivo de credenciamento.
     *
     * @param $name_file
     */
    public function findFile($name_file)
    {
        $file = Storage::disk('local_credentials')->get($name_file);
        return $file;
    }

}
