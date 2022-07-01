<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Services\UploadCredentialFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadCredentialFileController extends Controller
{
    public function index()
    {
        $upload = new UploadCredentialFile();
        $file_uploaded = json_decode( $upload->findFile(Auth::user()->credentials_file) );

        if ($file_uploaded != NULL)
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

}
