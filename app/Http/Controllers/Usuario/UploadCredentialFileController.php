<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Services\UploadCredentialFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadCredentialFileController extends Controller
{
    /**
     * Página de submissão de credencial do DialogFlow.
     */
    public function index()
    {
        $upload = new UploadCredentialFile();

        if (Auth::check())
            $file_uploaded = json_decode( $upload->findFile(Auth::user()->credentials_file) );

        if ($file_uploaded != NULL || isset($file_uploaded) )
            return view('profile.submit-credentials-file-form')->with('file_uploaded', $file_uploaded);
        else
            return view('profile.submit-credentials-file-form');
    }

    /**
     * Função para salvar o arquivo JSON de credencimento do Google.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file-credential') && $request->file('file-credential')->isValid()) {
            $upload = new UploadCredentialFile();
            $upload->saveData($request->file('file-credential'));
        }

        return redirect()->back();
    }

    public function findFile($usuario, $nome)
    {
        if (Auth::check()) {
            $upload = new UploadCredentialFile();
            $file_uploaded = json_decode( $upload->findFile(Auth::user()->credentials_file) );
//            return $file_uploaded;
            return "Olá";
        } else {
            $upload = new UploadCredentialFile();
            $caminho = $usuario . '/' . $nome;
//            dd($caminho);
//            $file_uploaded = json_decode( $upload->findFile('murillo_silva_dos_santos/20220628_182818_62bb7272d8277_murillo_silva_dos_santos.json') );
            $file_uploaded = json_decode( $upload->findFile($caminho) );
            return $file_uploaded;
        }

    }

}
