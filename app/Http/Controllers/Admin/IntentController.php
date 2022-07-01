<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\IntentService;
use Illuminate\Http\Request;

class IntentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Retorna a view para cadastro de nova Intent.
     *
     * @param $projeto
     * @return \Illuminate\Contracts\View\View
     */
    public function viewNovaIntent($projeto)
    {
        return view('intents.nova_intent')->with('projeto', $projeto);
    }

    public function criaNovaIntent($projeto, Request $request)
    {
        try {
            //fazer tratamento do request e depois fazer um objeto pra enviar pro service
            $response   = new IntentService('../teste-jwyo-aed37d258822.json');
            $intent     = $response->createIntent($projeto, $request);
//            return redirect()->back();
            return $intent;
            //add flash de sessão de mensagem
            //return para pagina com listagem de todas as intents

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Abre página com a lista de Intents.
     *
     * @param $projeto
     */
    public function listaTodasIntents($projeto)
    {
        $response   = new IntentService('../teste-jwyo-aed37d258822.json');
        $intents    = $response->listIntents($projeto);

        return view('intents.index')->with('projeto', $projeto)->with('intents', $intents);
    }

    public function viewEditaIntent($projeto, $id_intent)
    {
        $response   = new IntentService('../teste-jwyo-aed37d258822.json');
        $intent     = $response->getIntent($projeto, $id_intent);
        dd($intent);
        return view('intents.edita_intent')->with('projeto', $projeto)->with('intent', $intent);
    }
}
