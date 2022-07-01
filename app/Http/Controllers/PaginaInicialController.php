<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaInicialController extends Controller
{

    /**
     * Função que retorna a view da página inicial.
     */
    public function home()
    {
        return view('livewire.autoresponder.index');
    }

    public function teste(Request $request)
    {
        return view('teste');
    }

}
