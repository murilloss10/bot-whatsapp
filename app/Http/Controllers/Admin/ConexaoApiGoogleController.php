<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AgenteService;
use App\Services\ConexaoApiGoogleService;
use Illuminate\Http\Request;

class ConexaoApiGoogleController extends Controller
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
     * Retorna página de teste de resposta do chat.
     */
    public function screenMessage()
    {
        $projectId = 'teste-jwyo';
        $sessionId = '12345678';
        $mensagem = '';
        $text = '';
        return view('chat.chat')->with('projectId', $projectId)->with('sessionId', $sessionId)->with('mensagem', $mensagem)->with('text', $text);
    }

    /**
     * Envia as mensagens para a API e retorna as respostas na página.
     */
    public function sendMessage(Request $request)
    {
        $projectId = $request->projectId;
        $sessionId = $request->sessionId;
        $response = new ConexaoApiGoogleService('../teste-jwyo-aed37d258822.json');
        $mensagem = $response->getResponse($request->projectId, $request->sessionId, $request->text);
        $text = $request->text;
        return view('chat.chat')->with('projectId', $projectId)->with('sessionId', $sessionId)->with('mensagem', $mensagem)->with('text', $text);
//        return redirect()->route('mensagem.tela')->with('projectId', $projectId)->with('sessionId', $sessionId)->with('mensagem', $mensagem)->with('text', $text);
    }

    /**
     * Busca e retorna o Agente do projeto passado por parâmetro.
     *
     * @param string $projeto
     */
    public function getAgent($projeto)
    {
        $response = new AgenteService('../teste-jwyo-aed37d258822.json');
        $agente = $response->getAgent($projeto);
        return $agente->getDisplayName();
    }
}
