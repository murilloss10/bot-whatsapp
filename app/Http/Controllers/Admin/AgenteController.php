<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AgenteService;
use Illuminate\Http\Request;

class AgenteController extends Controller
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
     * Retorna a tela principal de Agentes do projeto.
     *
     * @param string $projeto
     */
    public function viewAgente($projeto)
    {
        $response   = new AgenteService('../teste-jwyo-aed37d258822.json');
        $agente     = $response->getAgent($projeto);

        $agente_nome = $agente->getDisplayName();

        return view('agentes.index')
            ->with('projeto', $projeto)
            ->with('agente_nome', $agente_nome);
    }

    /**
     * Retorna a tela de criação de novo Agente.
     *
     * @param string $projeto
     */
    public function viewNovoAgente($projeto)
    {

        $response   = new AgenteService('../teste-jwyo-aed37d258822.json');
        $agente     = $response->getAgent($projeto);

        if( isset($agente) ) {

            $project_name       = $projeto;
            $agente_name        = $agente->getDisplayName();
            $agente_parent      = $agente->getParent();
            $agente_description = $agente->getDescription();
            $agente_avatar_uri  = $agente->getAvatarUri();

            return view('agentes.novo_agente')
                ->with('project_name', $project_name)
                ->with('agente_name', $agente_name)
                ->with('agente_parent', $agente_parent)
                ->with('agente_description', $agente_description)
                ->with('agente_avatar_uri', $agente_avatar_uri);

        } else {
            return view('agentes.novo_agente');
        }

    }

    /**
     * Cria ou atualiza um Agente já existente.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function criaNovoAgente($projeto, Request $request)
    {
        //fazer o tratamento destes campos vindos do formulario
        $parent         = $request->parent;
        $display_name   = $request->display_name;
        $description    = $request->description;
        $avatar_uri     = $request->avatar_uri;

        try {

            $response   = new AgenteService('../teste-jwyo-aed37d258822.json');
            $agente     = $response->setAgent($parent, $display_name, $description, $avatar_uri);

            //adicionar um flash message

            return redirect()->route('agente.index', $projeto);

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    /**
     * Deleta o Agente passado por parâmetro.
     *
     * @param $projeto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletaAgente($projeto){
        //por enquanto sem permissão para excluir
        try{
            $response = new AgenteService('../teste-jwyo-aed37d258822.json');
            $agente = $response->deleteAgent($projeto);
            return redirect()->route('agente.index', 'teste-jwyo');

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

}
