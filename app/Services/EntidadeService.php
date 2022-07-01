<?php
/**
 * Service responsável por gerenciar ações de Entidades do DialogFlow.
 * Created by PhpStorm
 * User: Murillo
 * Date: 13/05/2022
 * Time: 15:34
 */

namespace App\Services;


class EntidadeService
{

    /**
     * Variável Array para receber a localização do arquivo credencial JSON.
     *
     * @var string
     */
    private $credentials;

    /**
     * Construtor que recebe como parâmetro uma string com a localização do arquivo JSON.
     *
     * @param string $credentials
     */
    public function __construct($credentials)
    {
        $this->credentials = array('credentials' => $credentials);
    }

    public function getEntityType()
    {
        
    }

}
